<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Memo;
use App\Pr;
use App\Po;
use App\Spb;

class MonitoringController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->user()->hasRole('admin')){
            $memo = Memo::all();
            return view('monitoring.index',compact('memo'));
        }else if ($request->user()->hasRole('viewer')){
            $memo = Memo::all();
            return view('monitoring.indexviewer',compact('memo'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request->user()->authorizeRoles('admin');
        return view('monitoring.memo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('scan_memo'))
         {
            $file = $request->file('scan_memo');
            $extension = $file->getClientOriginalExtension();
            $filename=time().$file->getClientOriginalName(). '.' .$extension;
            $file->move(public_path().'/images/memo', $filename);
            $request->scan_memo='images/memo/'. $filename;
         }

        $date=date_create($request->get('tanggal_memo'));
        $format = date_format($date,"Y-m-d");
        $request->tanggal_memo = strtotime($format);

        $memo = Memo::create([
            'no_memo' => $request->no_memo,
            'spesifikasi' => $request->spesifikasi,     
            'scan_memo' => $request->scan_memo,
            'tanggal_memo' => $request->tanggal_memo,
            'status' => 'Sedang Proses PR',

        ]);

        $memo->save();
    
        $pr=Pr::create([
            'memo_id' => $memo->id,
        ]);
        $pr->save();

        $po=Po::create([
            'pr_id' => $pr->id,
        ]);
        $po->save();

        $spb=Spb::create([
            'po_id' => $po->id,
        ]);
        $spb->save();

        return redirect('monitoring')
            ->with('success','Input Memo Berhasil');         
    }

    public function createpr($id)
    {   
        $request->user()->authorizeRoles('admin');
        $pr=Pr::find($id);
        return view('monitoring.pr.create',compact('pr'));
    }

    public function storepr(Request $request,Pr $pr,$id)
    {       
        $pr = Pr::find($id);

        if($request->hasfile('scan_pr'))
         {
            $file = $request->file('scan_pr');
            $extension = $file->getClientOriginalExtension();
            $filename=time().$file->getClientOriginalName(). '.' .$extension;
            $file->move(public_path().'/images/pr', $filename);
            $request->scan_pr='images/pr/'. $filename;
         }

        $date=date_create($request->get('tanggal_pr'));
        $format = date_format($date,"Y-m-d");
        $request->tanggal_pr = strtotime($format);


        Pr::find($id)->update([
            'no_pr' => $request->no_pr,
            'scan_pr' => $request->scan_pr,
            'tanggal_pr' => $request->tanggal_pr,
        ]);
        
        if($pr->memo->status ='Sedang Proses PR'){
        Memo::find($pr->memo->id)->update(['status'=>'Proses Pembuatan PO']);
        }   
         return redirect()->route('monitoring.index')
                        ->with('success','PR berhasil di tambah');   
    }

    public function createpo($id)
    {   
        $request->user()->authorizeRoles('admin');
        $po=Po::find($id);
        return view('monitoring.po.create',compact('po'));
    }

    public function storepo(Request $request,Pr $pr,$id)
    {
        $po = Po::find($id);

        if($request->hasfile('scan_po'))
         {
            $file = $request->file('scan_po');
            $extension = $file->getClientOriginalExtension();
            $filename=time().$file->getClientOriginalName(). '.' .$extension;
            $file->move(public_path().'/images/po', $filename);
            $request->scan_po='images/po/'. $filename;
         }

        $date=date_create($request->get('tanggal_po'));
        $format = date_format($date,"Y-m-d");
        $request->tanggal_po = strtotime($format);

        Po::find($id)->update([
            'no_po' => $request->no_po,
            'scan_po' => $request->scan_po,
            'tanggal_po' => $request->tanggal_po,
        ]);

        if($po->pr->memo->status ='Proses Pembuatan PO'){
        Memo::find($po->pr->memo->id)->update(['status'=>'Sedang Menunggu SPB']);
        }
         return redirect()->route('monitoring.index')
                        ->with('success','PO berhasil di tambah');  
    }
    
    public function createspb($id)
    {
        $request->user()->authorizeRoles('admin');
        $spb=Spb::find($id);
        return view('monitoring.spb.create',compact('spb'));
    }

    public function storespb(Request $request,Pr $spb,$id)
    {
        $spb = Spb::find($id);

        if($request->hasfile('scan_spb'))
         {
            $file = $request->file('scan_spb');
            $extension = $file->getClientOriginalExtension();
            $filename=time().$file->getClientOriginalName(). '.' .$extension;
            $file->move(public_path().'/images/spb', $filename);
            $request->scan_spb='images/spb/'. $filename;
         }

        $date=date_create($request->get('tanggal_spb'));
        $format = date_format($date,"Y-m-d");
        $request->tanggal_spb = strtotime($format);

        Spb::find($id)->update([
            'no_spb' => $request->no_spb,
            'scan_spb' => $request->scan_spb,
            'tanggal_spb' => $request->tanggal_spb,
        ]);

        if($spb->po->pr->memo->status ='Sedang Menunggu SPB'){
        Memo::find($spb->po->pr->memo->id)->update(['status'=>'Barang sudah Sampai, mohon cek di gudang']);
        }else{

        }

         return redirect()->route('monitoring.index')
                        ->with('success','SPB berhasil di tambah');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $memo = Memo::find($id);

        return view('monitoring.memo.show',compact('memo'));
    }

        public function showpr($id)
    {
        $pr = Pr::find($id);

        return view('monitoring.pr.show',compact('pr'));
    }

        public function showpo($id)
    {
        $po = Po::find($id);

        return view('monitoring.po.show',compact('po'));
    }

        public function showspb($id)
    {
        $spb = Spb::find($id);

        return view('monitoring.spb.show',compact('spb'));
    }

    public function datatables(Request $request){
    

     if($request->user()->hasRole('admin')){
        $memo = Memo::get()->all();
        $data=array();
        $l=array();
        $i=0;
        foreach ($memo as $value) {

            $date=date('d-m-Y', $value['tanggal_memo']);
            $l[0] = $i+1;
            $l[1] ="
                    <a href='".route('monitoring.show',$value->id)."'>".$value->no_memo."</a>
                   ";
            $l[2] = $date;
            $l[3] = $value->spesifikasi;
            $l[4] ="
                     <a href='".route('showpr',$value->pr->id)."'>".$value->pr->no_pr."</a>
                   "; 
            $l[5] ="
                     <a href='".route('showpo',$value->pr->po->id)."'>".$value->pr->po->no_po."</a>
                   ";
            $l[6] ="
                     <a href='".route('showspb',$value->pr->po->spb->id)."'>".$value->pr->po->spb->no_spb."</a>
                   ";
            $l[7] = $value->status;
            $l[8] = " 
                <a class='btn btn-danger' href='".route('monitoring.destroy',$value->id)."' data-method = 'DELETE' data-confirm='Yakin untuk menghapus data?' >Hapus</a>
                ";

            $data[$i]=$l;
            $i++;
        }
        
        $return['data'] = $data;
        return response()->json($return);   
      }

     if($request->user()->hasRole('viewer')){
        $memo = Memo::get()->all();
        $data=array();
        $l=array();
        $i=0;
        foreach ($memo as $value) {

            $date=date('d-m-Y', $value['tanggal_memo']);
            $l[0] = $i+1;
            $l[1] ="
                    <a href='".route('monitoring.show',$value->id)."'>".$value->no_memo."</a>
                   ";
            $l[2] = $date;
            $l[3] = $value->spesifikasi;
            $l[4] ="
                     <a href='".route('showpr',$value->pr->id)."'>".$value->pr->no_pr."</a>
                   "; 
            $l[5] ="
                     <a href='".route('showpo',$value->pr->po->id)."'>".$value->pr->po->no_po."</a>
                   ";
            $l[6] ="
                     <a href='".route('showspb',$value->pr->po->spb->id)."'>".$value->pr->po->spb->no_spb."</a>
                   ";
            $l[7] = $value->status;
           

            $data[$i]=$l;
            $i++;
        }
        
        $return['data'] = $data;
        return response()->json($return);   
      } 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request->user()->authorizeRoles('admin');
        $memo=Memo::find($id);
        return view('monitoring.memo.edit',compact('memo'));
    }

    public function editpr($id)
    {
        $request->user()->authorizeRoles('admin');
        $pr=Pr::find($id);
        return view('monitoring.pr.edit',compact('pr'));
    }

    public function editpo($id)
    {
        $request->user()->authorizeRoles('admin');
        $po=Po::find($id);
        return view('monitoring.po.edit',compact('po'));
    }

    public function editspb($id)
    {
        $request->user()->authorizeRoles('admin');
        $spb=Spb::find($id);
        return view('monitoring.spb.edit',compact('spb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $memo = Memo::find($id);

        if($request->hasfile('scan_memo'))
         {
            $file = $request->file('scan_memo');
            $extension = $file->getClientOriginalExtension();
            $filename=time().$file->getClientOriginalName(). '.' .$extension;
            $file->move(public_path().'/images/memo', $filename);
            $request->scan_memo='images/memo/'. $filename;
         }

        $date=date_create($request->get('tanggal_memo'));
        $format = date_format($date,"d-m-Y");
        $request->tanggal_memo = strtotime($format);

        Memo::find($id)->update([
            'no_memo' => $request->no_memo,
            'scan_memo' => $request->scan_memo,
            'tanggal_memo' => $request->tanggal_memo,
            'spesifikasi' => $request->spesifikasi,
            'status' => $request->status,
        ]);

        return redirect()->route('monitoring.index')
                        ->with('success','Memo berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $request->user()->authorizeRoles('admin');
        Memo::find($id)->delete();
        return redirect()->route('monitoring.index')
                        ->with('success','Memo berhasil dihapus');
    }
}
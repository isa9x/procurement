<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Datatables;
use App\Memo;
use App\Barang;
use App\Pr;
use App\Po;
use App\Spb;

class MonitoringController extends Controller
{
  //   public function __construct()
  // {
  //   $this->middleware('auth');
  // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->user()->hasRole('admin')){
        //     $memo = Memo::all();
        //     return view('monitoring.index',compact('memo'));
        // }else if ($request->user()->hasRole('viewer')){
        //     $memo = Memo::all();
        //     return view('monitoring.indexviewer',compact('memo'));
        // }

        $barang = Barang::latest()->paginate(10);

        return view('monitoring.index2',compact('barang'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$request->user()->authorizeRoles('admin');
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

        // $date=date_create($request->get('tanggal_memo'));
        // $format = date_format($date,"Y-m-d");
        //$request->tanggal_memo = strtotime($format);
        //Carbon::parse($value)->format('d/m/Y');
        //dd(Carbon::parse($request->tanggal_memo)->format('d/m/Y'));
                    
            $memo = Memo::create([
            'nomor' => $request->nomor,
            'tanggal_memo' => Carbon::parse($request->tanggal_memo),     
            'tanggal_terima' => Carbon::parse($request->tanggal_terima)
        ]);
        
        $idmemo=$memo->id;

        $jumlah=@count($request['nama']);
        for($i=0;$i < $jumlah; ++$i){
                $barang=new Barang;
                $barang->memo_id=$idmemo;
                $barang->nama=$request['nama'][$i];
                $barang->spesifikasi=$request['spesifikasi'][$i];
                $barang->jumlah=$request['jumlah'][$i];
                $barang->satuan=$request['satuan'][$i];
                $barang->keterangan=$request['keterangan'][$i];
                $barang->status_pi=$request['status_pi'][$i];

                $barang->save();
        }

        $memo->save();

        return redirect('monitoring')
            ->with('success','Input Memo Berhasil');         
    }

    public function createpr($id)
    {   
        //$request->user()->authorizeRoles('admin');
        //$idbarang = $id;
        $barang=Barang::find($id);
        return view('monitoring.pr.create')->with('barang',$barang);
    }

    public function storepr(Request $request)
    {       
        
        // if($pr->memo->status ='Sedang Proses PR'){
        // Memo::find($pr->memo->id)->update(['status'=>'Proses Pembuatan PO']);
        // }   
        // 
        $pr = Pr::create([
            'barang_id' => $request->barang_id,
            'nomor' => $request->nomor,     
            'tanggal_ttd_manager' => Carbon::parse($request->tanggal_ttd_manager),
            'tanggal_ttd_dirops' => Carbon::parse($request->tanggal_ttd_dirops)
        ]);

        return redirect()->route('monitoring.index')
                        ->with('success','PR berhasil di tambah');   
    }

    public function createpo($id)
    {   
        $barang=Barang::find($id);
        return view('monitoring.po.create')->with('barang',$barang);
    }

    public function storepo(Request $request)
    {
        $po = Po::create([
            'barang_id' => $request->barang_id,
            'nomor' => $request->nomor,     
            'tanggal_ttd_manager' => Carbon::parse($request->tanggal_ttd_manager),
            'tanggal_ttd_dirops' => Carbon::parse($request->tanggal_ttd_dirops)
        ]);

         return redirect()->route('monitoring.index')
                        ->with('success','PO berhasil di tambah');  
    }
    
    public function createspb(Request $request,$id)
    {
        $request->user()->authorizeRoles('admin');
        $spb=Spb::find($id);
        return view('monitoring.spb.create',compact('spb'));
    }

    public function storespb(Request $request,Pr $spb,$id)
    {
        $spb = Spb::find($id);

        $date=date_create($request->get('tanggal_spb'));
        $format = date_format($date,"Y-m-d");
        $request->tanggal_spb = strtotime($format);

        Spb::find($id)->update([
            'no_spb' => $request->no_spb,
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
    
        // $l[4] ="
        //          <a href='".route('showpr',$value->pr->id)."'>".$value->pr->no_pr."</a>
        //        "; 
        $barang = Barang::get()->all();
        $data=array();
        $l=array();
        $i=0;

        foreach ($barang as $value) {

            $l[0] = $i+1;
            $l[1] ="
                    <a href='".route('monitoring.show',$value->id)."'>".$value->nama."</a>
                   ";
            $l[2] = $value->spesifikasi;
            $l[3] = $value->memo->nomor;
            $l[4] = $value->pr->nomor;
            $l[5] = '$value->po->nomor';
            $l[6] = $value->status;
            $l[7] = " 
                <form action='".route('monitoring.destroy',$value->id)."' method='post'>
                ".csrf_field()."
                <input name='_method' type='hidden' value='DELETE'>
                <button class='btn btn-danger' type='submit' data-confirm='Yakin untuk menghapus data?' >Hapus</button>
                </form>
                ";

            $data[$i]=$l;
            $i++;
        }
        
        $return['data'] = $data;
        return response()->json($return);   
      

     // if($request->user()->hasRole('viewer')){
     //    $memo = Memo::get()->all();
     //    $data=array();
     //    $l=array();
     //    $i=0;
     //    foreach ($memo as $value) {

     //        $date=date('d-m-Y', $value['tanggal_memo']);
     //        $l[0] = $i+1;
     //        $l[1] ="
     //                <a href='".route('monitoring.show',$value->id)."'>".$value->no_memo."</a>
     //               ";
     //        $l[2] = $date;
     //        $l[3] = $value->spesifikasi;
     //        $l[4] ="
     //                 <a href='".route('showpr',$value->pr->id)."'>".$value->pr->no_pr."</a>
     //               "; 
     //        $l[5] ="
     //                 <a href='".route('showpo',$value->pr->po->id)."'>".$value->pr->po->no_po."</a>
     //               ";
     //        $l[6] ="
     //                 <a href='".route('showspb',$value->pr->po->spb->id)."'>".$value->pr->po->spb->no_spb."</a>
     //               ";
     //        $l[7] = $value->status;
           

     //        $data[$i]=$l;
     //        $i++;
     //    }
        
     //    $return['data'] = $data;
     //    return response()->json($return);   
     //  } 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $request->user()->authorizeRoles('admin');
        $memo=Memo::find($id);
        return view('monitoring.memo.edit',compact('memo'));
    }

    public function editpr(Request $request,$id)
    {
        $request->user()->authorizeRoles('admin');
        $pr=Pr::find($id);
        return view('monitoring.pr.edit',compact('pr'));
    }

    public function editpo(Request $request,$id)
    {
        $request->user()->authorizeRoles('admin');
        $po=Po::find($id);
        return view('monitoring.po.edit',compact('po'));
    }

    public function editspb(Request $request,$id)
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
    
    public function destroy(Request $request,$id)
    {
        //$request->user()->authorizeRoles('admin');
        Barang::find($id)->delete();
        return redirect()->route('monitoring.index')
                        ->with('success','Memo berhasil dihapus');
    }
}
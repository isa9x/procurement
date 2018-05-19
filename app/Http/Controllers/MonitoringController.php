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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $memo = Memo::latest()->paginate(5);
        return view('monitoring.index',compact('memo'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        
        // $memo = Memo::all();
        // return view('monitoring.index',compact('memo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        Memo::find($pr->memo->id)->update(['status'=>'Proses Pembuatan PO']);

         return redirect()->route('monitoring.index')
                        ->with('success','PR berhasil di tambah');   
    }

    public function createpo($id)
    {
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

        Memo::find($po->pr->memo->id)->update(['status'=>'Sedang Menunggu SPB']);

         return redirect()->route('monitoring.index')
                        ->with('success','PO berhasil di tambah');  
    }
    
    public function createspb($id)
    {
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

        Memo::find($spb->po->pr->memo->id)->update(['status'=>'Barang sudah Sampai, mohon cek di gudang']);

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
        //
    }

    public function datatables(){
        $memo = Memo::all();
        $data=array();
        $l=array();
        $i=0;
        foreach ($memo as $value) {
            $l[0] = $i+1;
            $l[1] = $memo->no_memo;
            $l[2] = $memo->tanggal_memo;
            $l[3] = $memo->spesifikasi;
            $l[4] = $memo->pr->no_pr;
            $l[5] = $memo->pr->po->no_po;
            $l[6] = $memo->pr->po->spb->no_spb;
            $l[7] = $memo->status;
            $l[8] = "
                @empty($memo1->pr->no_pr)
                       <a class='btn btn-info' href='{{ route('".inputpr."',$memo1->pr->id) }}'>Input PR</a>
                    @endempty
                    
                    @isset($memo1->pr->no_pr)
                        @empty($memo1->pr->po->no_po)
                           <a class='btn btn-primary' href='{{ route('".inputpo."',$memo1->pr->po->id) }}'>Input PO</a>
                        @endempty
                    @endisset
                    
                    @isset($memo1->pr->po->no_po)
                        @empty($memo1->pr->po->spb->no_spb)
                            <a class='btn btn-primary' href='{{ route('".inputspb."',$memo1->pr->po->spb->id) }}'>Input SPB</a>
                        @endempty
                    @endisset

                {!! Form::open(['method' => 'DELETE','route' => ['monitoring.destroy', $memo1->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}";

            $data[$i]=$l;
            $i++;
        }
        $return['data'] = $data;
        return response()->json($return);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        Memo::find($id)->delete();
        return redirect()->route('monitoring.index')
                        ->with('success','Memo berhasil dihapus');
    }
}
Route::get(
	'proyek/datatables',
	['as'=>'proyek.datatables',
	'uses'=>'ProyekController@datatables']);

public function datatables(){
		$proyek = Proyek::all();
		$data=array();
		$l=array();
		$i=0;
		foreach ($proyek as $value) {
			$l[0] = $value->id;
			$l[1] = $value->nama;
			$l[2] = $value->kecamatan->nama;
			$l[3] = $value->kontraktor->nama;
			$l[4] = $value->mulai;
			$l[5] = $value->akhir;
			$l[6] = $value->nilai;
			$l[7] = "
				<a href='".route('proyek.edit',$value->id)."'>Edit</a> | 
				<a href='".route('proyek.destroy',$value->id)."' data-method = 'DELETE' data-confirm='Yakin untuk menghapus data?' >Hapus</a> |
				<a href='".url('proyek/create?id='.$value->id)."'>Teruskan</a>
			";
			$data[$i]=$l;
			$i++;
		}
		$return['data'] = $data;
		return response()->json($return);
	}


@extends('gishome')

@section('content')
@include('flash::message')
<h1>Proyek</h1>
 <a class="btn btn-primary pull-right" id="sign"  href="{!! route('proyek.create') !!}"><i class="icon-g-circle-plus"></i>Tambah</a>
 <a class="btn btn-warning btn-sm pull-left" id="request"  href="{!! URL::to('laporan') !!}"><i class="icon-g-circle-plus"></i>Request Data Rekapitulasi Proyek</a>
    <table class='table' id='datatables'>
        <thead>
        <tr>
          <th>Id</th>
          <th>Nama</th>
          <th>Kecamatan</th>
          <th>Kontraktor</th>
           <th>Mulai</th>
          <th>Akhir</th>
           <th>Nilai</th>
          <th>#</th>
        </tr>
        </thead>
        <tbody>
          
        </tbody>
    </table>
@stop

@section('footer')

 {!!Html::script("assets/Laravel/laravel.methodHandler.js")!!}
    
 <script type="text/javascript">    
    $(document).ready(function(){
          $("#datatables").dataTable({
              "ajax" : "{!! route('proyek.datatables') !!}"}).on('draw.dt',function(){
                   $('a[data-method]').click(function(e){
                      handleMethod(e,$(this));
                      e.preventDefault();
                   });
            }); 
    });
   
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);  
 </script>
 @stop


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
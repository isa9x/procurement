@extends('layouts.dashboard')
@section('page_heading','Monitoring')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Input Nomor Purchase Order (PO)')
                @section ('pane2_panel_body')
                                   
                    <label for="name">Nama Barang:</label>
                    <input type="text" class="form-control" name="name" value="{{$barang->nama}}" disabled>           

                    <form action="{{ route('storepo') }}" method="post">
                        {{ Form::hidden('barang_id', $barang->id) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label('nomor', 'Nomor PO') !!}<br>
                            {!! Form::text('nomor', null, array('placeholder' => 'Masukkan Nomor PO','class' => 'form-control')) !!}
                        </div>

                         <div class="form-group">
                            {!! Form::label('tanggal', 'Tanggal TTD Manager') !!}
                            {!! Form::date('tanggal_ttd_manager', \Carbon\Carbon::now(),array('class' => 'form-control')) !!}
                         </div>

                         <div class="form-group">
                            {!! Form::label('tanggal', 'Tanggal TTD Dirops') !!}
                            {!! Form::date('tanggal_ttd_dirops', \Carbon\Carbon::now(),array('class' => 'form-control')) !!}
                         </div>

                         <button type="submit" class="btn btn-success">Simpan</button>

                    </form>
                    <!-- /.panel -->
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
                </div>
      </div>
    

@stop
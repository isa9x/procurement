@extends('layouts.dashboard')
@section('page_heading','Monitoring')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Input Nomor Purchase Requestion (PR)')
                @section ('pane2_panel_body')
                    
                    {{-- {!! Form::model($pr, ['method' =>'PATCH','route' => ['updatepr', $pr->id],'files'=>true]) !!}

                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_pr', 'Nomor PR') !!}
                                        {!! Form::text('no_pr', null, array('placeholder' => 'Nomor PR','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('scan_pr', 'Scan PR') !!}
                                        {!! Form::file('scan_pr'); !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                  <div class="col-xs-5 col-sm-5 col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('tanggal_pr', 'Tanggal PR') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_pr">
                                    </div>
                                 </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {!! Form::submit('Simpan',array('class'=>'btn btn-success')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}     --}}                   
                    <label for="name">Nama Barang:</label>
                    <input type="text" class="form-control" name="name" value="{{$barang->nama}}" disabled>           

                    <form action="{{ route('storepr') }}" method="post">
                        {{ Form::hidden('barang_id', $barang->id) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label('nomor', 'Nomor PR') !!}<br>
                            {!! Form::text('nomor', null, array('placeholder' => 'Masukkan Nomor PR','class' => 'form-control')) !!}
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
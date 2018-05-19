@extends('layouts.dashboard')
@section('page_heading','Monitoring')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Input Memo Baru')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                    {!! Form::open(array('route' =>'monitoring.store','method'=>'POST','files' => true)) !!}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_memo', 'Nomor Memo') !!}
                                        {!! Form::text('no_memo', null, array('placeholder' => 'Nomor Memo','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('scan_memo', 'Scan Memo') !!}
                                        {!! Form::file('scan_memo'); !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">            
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('spesifikasi', 'Spesifikasi Barang') !!}
                                        {!! Form::textarea('spesifikasi', null, array('placeholder' => 'Spesifikasi Barang','class' => 'form-control','style'=>'height:150px')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                  <div class="col-xs-5 col-sm-5 col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('tanggal_memo', 'Tanggal Memo') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_memo">
                                    </div>
                                 </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {!! Form::submit('Simpan',array('class'=>'btn btn-success')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}    
                    <!-- /.panel -->
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>

@stop
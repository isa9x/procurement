@extends('layouts.dashboard')
@section('page_heading','Monitoring')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Input Nomor Purchase Order (PO)')
                @section ('pane2_panel_body')
                    
                    {!! Form::model($po, ['method' =>'PATCH','route' => ['updatepo', $po->id],'files'=>true]) !!}

                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_po', 'Nomor PO') !!}
                                        {!! Form::text('no_po', null, array('placeholder' => 'Nomor PO','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('scan_po', 'Scan PO') !!}
                                        {!! Form::file('scan_po'); !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                  <div class="col-xs-5 col-sm-5 col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('tanggal_po', 'Tanggal PO') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_po">
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
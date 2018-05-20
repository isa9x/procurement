@extends('layouts.dashboard')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'PO')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        @empty($po->scan_po)
                                            @php
                                                $po->scan_po='images/no_image.svg';
                                            @endphp
                                         @endempty
                                       {!! Form::label('scan_po', 'Scan PO') !!}<br>
                                       <img height="250px" width="100%" src="{{ asset('/' . $po->scan_po) }}" />
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_po', 'Nomor PO') !!}
                                        {!! Form::text('no_po', $po->no_po, array('placeholder' => 'Nomor PO','class' => 'form-control', 'disabled')) !!}
                                    </div>
                                </div>
                                
                                @php
                                $date=date('d-m-Y', $po['tanggal_po']);
                                @endphp    
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('tanggal_po', 'Tanggal PO') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_po" value="{{ $date }}" disabled>
                                    </div>
                                 </div>

                                 <div class="col-xs-4 col-sm-4 col-md-4">
                                    <br>

                                        @empty($po->spb->no_spb)
                                            <a class='btn btn-primary' href='{{ route('inputspb',$po->spb->id) }}'>Input SPB</a>
                                        @endempty

                                    @isset($po->spb->no_spb)
                                            <a class='btn btn-primary' href='{{ route('editpo',$po->id) }}'>Edit PO</a>
                                    @endisset
                                </div>
                                
                            </div>    
              
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>
@stop
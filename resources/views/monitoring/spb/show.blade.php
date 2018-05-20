@extends('layouts.dashboard')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'SPB')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                         @empty($spb->scan_spb)
                                            @php
                                                $spb->scan_spb='images/no_image.svg';
                                            @endphp
                                         @endempty
                                       {!! Form::label('scan_spb', 'Scan SPB') !!}<br>
                                       <img height="250px" width="100%" src="{{ asset('/' . $spb->scan_spb) }}" />
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_spb', 'Nomor SPB') !!}
                                        {!! Form::text('no_spb', $spb->no_spb, array('placeholder' => 'Nomor SPB','class' => 'form-control', 'disabled')) !!}
                                    </div>
                                </div>
                                
                                @php
                                $date=date('d-m-Y', $spb['tanggal_spb']);
                                @endphp    
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('tanggal_spb', 'Tanggal PO') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_pr" value="{{ $date }}" disabled>
                                    </div>
                                 </div>

                                 <div class="col-xs-4 col-sm-4 col-md-4">
                                    <br>
                                    @isset($spb->no_spb)
                                            <a class='btn btn-primary' href='{{ route('editspb',$spb->id) }}'>Edit SPB</a>
                                    @endisset
                                </div>
                                
                            </div>    
              
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>
@stop
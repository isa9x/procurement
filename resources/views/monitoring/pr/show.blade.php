@extends('layouts.dashboard')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'PR')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        @empty($pr->scan_po)
                                            @php
                                                $pr->scan_pr='images/no_image.svg';
                                            @endphp
                                         @endempty
                                       {!! Form::label('scan_pr', 'Scan PR') !!}<br>
                                       <img height="250px" width="100%" src="{{ asset('/' . $pr->scan_pr) }}" />
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_pr', 'Nomor PR') !!}
                                        {!! Form::text('no_pr', $pr->no_pr, array('placeholder' => 'Nomor PR','class' => 'form-control', 'disabled')) !!}
                                    </div>
                                </div>
                                
                                @php
                                $date=date('d-m-Y', $pr['tanggal_pr']);
                                @endphp    
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('tanggal_pr', 'Tanggal PR') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_pr" value="{{ $date }}" disabled>
                                    </div>
                                 </div>

                                 <div class="col-xs-4 col-sm-4 col-md-4">
                                    <br>
                                        @empty($pr->po->no_po)
                                           <a class='btn btn-primary' href='{{ route('inputpo',$pr->po->id) }}'>Input PO</a>
                                        @endempty
                        
                                    @isset($pr->po->spb->bo_spb)
                                        @empty($pr->po->spb->no_spb)
                                            <a class='btn btn-primary' href='{{ route('inputspb',$pr->po->spb->id) }}'>Input SPB</a>
                                        @endempty
                                    @endisset

                                    @isset($pr->po->spb->no_spb)
                                            <a class='btn btn-primary' href='{{ route('editpr',$pr->id) }}'>Edit PR</a>
                                    @endisset
                                </div>
                                
                            </div>    
              
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>
@stop
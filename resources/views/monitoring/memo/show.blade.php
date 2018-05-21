@extends('layouts.dashboard')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Memo')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group scanmemo">
                                        @empty($memo->scan_memo)
                                            @php
                                                $memo->scan_memo='images/no_image.svg';
                                            @endphp
                                         @endempty
                                       {!! Form::label('scan_memo', 'Scan Memo') !!}<br>
                                       <img height="250px" width="100%" src="{{ asset('/' . $memo->scan_memo) }}" />
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_memo', 'Nomor Memo') !!}
                                        {!! Form::text('no_memo', $memo->no_memo, array('placeholder' => 'Nomor Memo','class' => 'form-control', 'disabled')) !!}
                                    </div>
                                </div>
                                
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('spesifikasi', 'Spesifikasi Barang') !!}
                                        {!! Form::textarea('spesifikasi', $memo->spesifikasi, array('placeholder' => 'Spesifikasi Barang','class' => 'form-control','style'=>'height:150px', 'disabled')) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12">            
                        
                            </div>
                                
                            @php
                            $date=date('d-m-Y', $memo['tanggal_memo']);
                            @endphp    
                        
                            <div class="col-lg-12">
                                  <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('tanggal_memo', 'Tanggal Memo') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_memo" value="{{ $date }}" disabled>
                                    </div>
                                 </div>
                                
                                @if(Auth::user()->hasRole('admin'))
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <br>
                                    @empty($memo->pr->no_pr)
                                       <a class='btn btn-info' href='{{ route('inputpr',$memo->pr->id) }}'>Input PR</a>
                                    @endempty
                                    
                                    @isset($memo->pr->no_pr)
                                        @empty($memo->pr->po->no_po)
                                           <a class='btn btn-primary' href='{{ route('inputpo',$memo->pr->po->id) }}'>Input PO</a>
                                        @endempty
                                    @endisset
                                    
                                    @isset($memo->pr->po->no_po)
                                        @empty($memo->pr->po->spb->no_spb)
                                            <a class='btn btn-primary' href='{{ route('inputspb',$memo->pr->po->spb->id) }}'>Input SPB</a>
                                        @endempty
                                    @endisset

                                    @isset($memo->pr->po->spb->no_spb)
                                            <a class='btn btn-primary' href='{{ route('monitoring.edit',$memo->id) }}'>Edit Memo</a>
                                    @endisset
                                </div>
                                @endif

                            </div>
                    {!! Form::close() !!}    
                    <!-- /.panel -->
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>
@stop
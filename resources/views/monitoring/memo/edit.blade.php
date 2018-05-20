@extends('layouts.dashboard')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Edit Memo')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                   {{--  {!! Form::open(array('route' =>'monitoring.store','method'=>'POST','files' => true)) !!} --}}
                    {!! Form::model($memo, ['method' =>'PATCH','route' => ['monitoring.update', $memo->id],'files'=>true]) !!}

                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_memo', 'Nomor Memo') !!}
                                        {!! Form::text('no_memo', $memo->no_memo, array('placeholder' => 'Nomor Memo','class' => 'form-control')) !!}
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
                                        {!! Form::textarea('spesifikasi', $memo->spesifikasi, array('placeholder' => 'Spesifikasi Barang','class' => 'form-control','style'=>'height:150px')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">            
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('status', 'Status Barang') !!}
                                        {!! Form::textarea('status', $memo->status, array('placeholder' => 'Spesifikasi Barang','class' => 'form-control','style'=>'height:50px')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                  <div class="col-xs-5 col-sm-5 col-md-5">
                                    <div class="form-group">
                                            @php
                                            $date=date('d-m-Y', $memo['tanggal_memo']);
                                            @endphp   
                                        {!! Form::label('tanggal_memo', 'Tanggal Memo') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_memo" value="{{ $date }}">
                                    </div>
                                 </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {!! Form::submit('Update',array('class'=>'btn btn-success')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}    
                    <!-- /.panel -->
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>

@stop
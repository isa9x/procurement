@extends('layouts.dashboard')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Edit PR')
                @section ('pane2_panel_body')
                    
                    {!! Form::model($pr, ['method' =>'PATCH','route' => ['updatepr', $pr->id],'files'=>true]) !!}
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('no_pr', 'Nomor PR') !!}
                                        {!! Form::text('no_pr', $pr->no_pr, array('placeholder' => 'Nomor PR','class' => 'form-control')) !!}
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
                                        @php
                                        $date=date('d-m-Y', $pr['tanggal_pr']);
                                        @endphp
                                        {!! Form::label('tanggal_pr', 'Tanggal PR') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_pr" value="{{ $date }}">
                                    </div>
                                 </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {!! Form::submit('Edit',array('class'=>'btn btn-success')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}    
                    <!-- /.panel -->
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>

@stop
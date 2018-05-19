@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('section')
           
            <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Monitoring PR / PO')
                @section ('pane2_panel_body')
                    
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('monitoring.create') }}">Tambah Memo Baru</a>
                    </div>
                </div>

                {{-- @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif --}}
                
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Nomor Memo</th>
                            <th width="200px">Spesifikasi</th>
                            <th>Nomor PR</th>
                            <th>Nomor PO</th>
                            <th>Nomor SPB</th>
                            <th width="200px">Status</th>
                            <th width="350px">Operation</th>
                        </tr>
                    
                        @foreach ($memo as $memo1)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $memo1->no_memo}}</td>
                                <td>{{ $memo1->spesifikasi}}</td>
                                <td>{{ $memo1->pr->no_pr}}</td>
                                <td>{{ $memo1->pr->po->no_po}}</td>
                                <td>{{ $memo1->pr->po->spb->no_spb}}</td>
                                <td>{{ $memo1->status}}</td>
                                <td>
                                    {{-- @php
                                        $date=date('Y-m-d', $memo1['tanggal_memo']);
                                    @endphp

                                    {{ $date }} --}}
                                @empty($memo1->pr->no_pr)
                                   <a class="btn btn-info" href="{{ route('inputpr',$memo1->pr->id) }}">Input PR</a>
                                @endempty
                                @empty($memo1->pr->po->no_po)
                                   <a class="btn btn-primary" href="{{ route('inputpo',$memo1->pr->po->id)}}">Input PO</a>
                                @endempty
                                @empty($memo1->pr->po->spb->no_spb)
                                    <a class="btn btn-primary" href="{{ route('inputspb',$memo1->pr->po->spb->id) }}">Input SPB</a>
                                @endempty
                                    {!! Form::open(['method' => 'DELETE','route' => ['monitoring.destroy', $memo1->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    
                    {!! $memo->render() !!}

                @endsection
                </div>
            </div>
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
                </div>
			</div>
@stop

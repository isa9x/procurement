@extends('layouts.dashboard'){{-- 
@section('page_heading','Dashboard') --}}
@section('section')
    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Monitoring PR / PO')
                @section ('pane2_panel_body')
                    

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

            <div class="row">
                <div class="col-lg-12" id="memo_container">
                    <table class="table table-bordered" id ="datatables">
                       <thead>
                        <tr>
                                <th>No</th>
                                <th>Nomor Memo</th>
                                <th>Tanggal Memo</th>
                                <th width="200px">Barang & Spesifikasi</th>
                                <th>Nomor PR</th>
                                <th>Nomor PO</th>
                                <th>Nomor SPB</th>
                                <th width="150px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
            </table>
        </div>
            <script src="{{asset('js/laravel.methodHandler.js')}}" type="text/javascript"></script>
            <script src="{{asset('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
            <script type="text/javascript">    
                $(document).ready(function() {
                    $('#datatables').DataTable( {
                        "ajax": {
                            "url": "{!! route('monitoring.datatables') !!}",
                            "dataSrc": 'data'
                        }
                    } );
                } ); 
             </script>

                @endsection
                </div>
            </div>
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
                </div>
    </div>

@stop
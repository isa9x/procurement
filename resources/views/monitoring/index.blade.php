@extends('layouts.dashboard')
@section('page_heading','Dashboard')
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
                    
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('monitoring.create') }}">Tambah Memo Baru</a>
                        </div>
                    </div>

                    <table class="table table-bordered" id ="datatables">
                       <thead>
                        <tr>
                                <th>No</th>
                                <th>Nomor Memo</th>
                                <th>Tanggal Memo</th>
                                <th width="250px">Barang & Spesifikasi</th>
                                <th>Nomor PR</th>
                                <th>Nomor PO</th>
                                <th>Nomor SPB</th>
                                <th width="200px">Status</th>
                                @if(Auth::User()->hasRole('admin'))
                                <th width="180px">Operation</th>
                                @endif
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
            </table>

            <script type="text/javascript">    
                $(document).ready(function(){
                      $("#datatables").DataTable({
                          "ajax" : "{!! route('monitoring.datatables') !!}"}).on('draw.dt',function(){
                               $('a[data-method]').click(function(e){
                                  handleMethod(e,$(this));
                                  e.preventDefault();
                               });
                        }); 
                }); 
             </script>

                @endsection
                </div>
            </div>
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
                </div>
    </div>

@stop
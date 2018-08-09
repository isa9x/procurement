@extends('layouts.dashboard')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Input Memo Baru')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->

         <div class="row-fluid">
            <div class="span6">

                {{-- {!! Form::open(array('route' =>'monitoring.store','method'=>'POST')) !!} --}}
                <form name="add_memo" id="add_memo">

                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        {!! Form::label('no_memo', 'Nomor Memo') !!}
                        {!! Form::text('nomor', null, array('placeholder' => 'Masukkan Nomor Memo','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        {!! Form::label('tanggal_memo', 'Tanggal Memo') !!}
                        {!! Form::date('tanggal_memo', \Carbon\Carbon::now(),array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        {!! Form::label('tanggal_terima', 'Tanggal Terima Memo') !!}
                        {!! Form::date('tanggal_terima', \Carbon\Carbon::now(),array('class' => 'form-control')) !!}
                    </div>
                </div>
                               
                   {{--  <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th><center>Nama Barang</center></th>
                                <th><center>Spesifikasi</center></th>
                                <th width="100px"><center>Jumlah</center></th>
                                <th width="100px"><center>Satuan</center></th>
                                <th><center>Keterangan</center></th>
                                 <th width="100px"><center>PI</center></th>
                                <th width="200px"></th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td>{{ Form::text('nama[]', null, array('class'=>'form-control')) }}</td>
                                <td>{{ Form::text('spesifikasi[]', null, array('class'=>'form-control')) }}</td>
                                <td>{{ Form::text('jumlah[]', null, array('class'=>'form-control')) }}</td>
                                <td>{{ Form::text('satuan[]', null, array('class'=>'form-control')) }}</td>
                                <td>{{ Form::text('keterangan[]', null, array('class'=>'form-control')) }}</td>
                                <td>{{ Form::select('status_pi[]', ['Iya' => 'iya', 'Tidak' => 'Tidak'], 'Tidak',array('class'=>'form-control')) }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-success" onclick="additem(); return false">TAMBAH</button>
                                    <button name="submit" class="btn btn-small btn-primary">SIMPAN</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table> --}}
    
                        <table class="table table-condensed" id="dynamic_field"> 
                            <thead>
                            <tr>
                                <th><center>Nama Barang</center></th>
                                <th><center>Spesifikasi</center></th>
                                <th width="100px"><center>Jumlah</center></th>
                                <th width="100px"><center>Satuan</center></th>
                                <th><center>Keterangan</center></th>
                                 <th width="100px"><center>PI</center></th>
                                <th width="200px">Action</th>
                            </tr>
                        </thead>
                            <tr>  
                                <td><input type="text" name="nama[]" placeholder="Nama Barang" class="form-control" /></td>
                                <td><input type="text" name="spesifikasi[]" placeholder="Spesifikasi Barang" class="form-control" /></td>
                                <td><input type="text" name="jumlah[]" placeholder="Jumlah" class="form-control" /></td>
                                <td><input type="text" name="satuan[]" placeholder="Jenis" class="form-control" /></td>
                                <td><input type="text" name="keterangan[]" placeholder="Keterangan Tambahan" class="form-control" /></td>
                                <td><select name="status_pi[]" class="form-control">
                                      <option value="iya">Iya</option>
                                      <option selected="selected" value="tidak">Tidak</option>
                                    </select>
                                </td>
                                <td></td>  
                            </tr>  
                        </table>  
                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                        <button name="submit" class="btn btn-small btn-primary">SIMPAN</button>  
                
                {{-- {!! Form::close() !!} --}}
            </form>
 
 
            </div>
        </div>

              <!-- /.panel -->
   
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>

@section('footer')

<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "<?php echo url('monitoring'); ?>";
      var i=1;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="nama[]" placeholder="Nama Barang" class="form-control" /></td><td><input type="text" name="spesifikasi[]" placeholder="Spesifikasi Barang" class="form-control" /></td><td><input type="text" name="jumlah[]" placeholder="Jumlah" class="form-control" /></td><td><input type="text" name="satuan[]" placeholder="Jenis" class="form-control" /></td><td><input type="text" name="keterangan[]" placeholder="Keterangan Tambahan" class="form-control" /></td><td><select name="status_pi[]" class="form-control"><option value="iya">Iya</option><option selected="selected" value="tidak">Tidak</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


$('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_memo').serialize(),
                type:'json',
                success:function(data)  
                {
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_memo')[0].reset();        
                }  
           });  
      });  
});    

</script>
@endsection

@stop
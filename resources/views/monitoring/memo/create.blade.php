@extends('layouts.dashboard')
@section('section')

    <div class="row">
                <div class="col-lg-12">
                
                @section ('pane2_panel_title', 'Input Memo Baru')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                    {{-- {!! Form::open(array('route' =>'monitoring.store','method'=>'POST','files' => true)) !!}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group"> 
                                        {!! Form::label('no_memo', 'Nomor Memo') !!}
                                        {!! Form::text('no_memo', null, array('placeholder' => 'Nomor Memo','class' => 'form-control')) !!}
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
                                        {!! Form::textarea('spesifikasi', null, array('placeholder' => 'Spesifikasi Barang','class' => 'form-control','style'=>'height:150px')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                  <div class="col-xs-5 col-sm-5 col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('tanggal_memo', 'Tanggal Memo') !!}
                                        <input class="date form-control"  type="text" id="datepicker" name="tanggal_memo">
                                    </div>
                                 </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {!! Form::submit('Simpan',array('class'=>'btn btn-success')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}     --}}

         <div class="row-fluid">
            <div class="span6">
                {!! Form::open(array('route' =>'monitoring.store','method'=>'POST')) !!}
        
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        {!! Form::label('nomor', 'Nomor Memo') !!}
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
                               
                    <table class="table table-condensed">
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
                                <td>{{ Form::select('status_pi[]', ['Iya' => 'Iya', 'Tidak' => 'Tidak'], 'Tidak',array('class'=>'form-control')) }}</td>
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
                    </table>
                {!! Form::close() !!}
 
 
            </div>
                    <?php
                        if (isset($_POST['submit'])) {
                            //$nomor = $_POST['nomor'];
                            //$tanggal_memo = $_POST['tanggal_memo'];
                            //$tanggal_terima = $_POST['tanggal_terima'];
                            $nama = $_POST['nama'];
                            $spesifikasi = $_POST['spesifikasi'];
                            $jumlah = $_POST['jumlah'];
                            $satuan = $_POST['satuan'];
                            $keterangan = $_POST['keterangan'];
                            $status_pi = $_POST['status_pi'];    
                        }
                    ?>
        </div>

              <!-- /.panel -->
   
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))

                </div>
      </div>

@section('footer')
        <script>
            var i = 1;
            function additem() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist');
                
//                membuat element
                var row = document.createElement('tr');
                var n = document.createElement('td');
                var s = document.createElement('td');
                var j = document.createElement('td');
                var sa = document.createElement('td');
                var k = document.createElement('td');
                var pi = document.createElement('td');
                var aksi = document.createElement('td');
 
//                meng append element
                itemlist.appendChild(row);
                row.appendChild(n);
                row.appendChild(s);
                row.appendChild(j);
                row.appendChild(sa);
                row.appendChild(k);
                row.appendChild(pi);
                row.appendChild(aksi);
 
//                membuat element input
                var nama = document.createElement('input');
                nama.setAttribute('name', 'nama[' + i + ']');
                nama.setAttribute('class', 'form-control');
 
                var spesifikasi = document.createElement('input');
                spesifikasi.setAttribute('name', 'spesifikasi[' + i + ']');
                spesifikasi.setAttribute('class', 'form-control');

                var jumlah = document.createElement('input');
                jumlah.setAttribute('name', 'jumlah[' + i + ']');
                jumlah.setAttribute('class', 'form-control');

                var satuan = document.createElement('input');
                satuan.setAttribute('name', 'satuan[' + i + ']');
                satuan.setAttribute('class', 'form-control');

                var keterangan = document.createElement('input');
                keterangan.setAttribute('name', 'keterangan[' + i + ']');
                keterangan.setAttribute('class', 'form-control');

                var status_pi = document.createElement('select');
                status_pi.setAttribute('name', 'status_pi[' + i + ']');
                status_pi.setAttribute('class', 'form-control');

                var opt = document.createElement('option');
                opt.value = 'Iya';
                opt.innerHTML = 'Iya';
                status_pi.appendChild(opt);

                var opt = document.createElement('option');
                opt.value = 'Tidak';
                opt.innerHTML = 'Tidak';
                status_pi.appendChild(opt);
                

                var hapus = document.createElement('span');
 
//                meng append element input
                n.appendChild(nama);
                s.appendChild(spesifikasi);
                j.appendChild(jumlah);
                sa.appendChild(satuan);
                k.appendChild(keterangan);
                pi.appendChild(status_pi);
                aksi.appendChild(hapus);
 
                hapus.innerHTML = '<button class="btn btn-danger">HAPUS</button>';
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                    i=i-1;
                }; 
                i++;
            }
        </script>
@endsection

@stop
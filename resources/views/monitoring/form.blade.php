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
                {!! Form::label('gambar_memo', 'Scan Memo') !!}
                {!! Form::file('gambar_memo'); !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                {!! Form::label('no_pr', 'Nomor Purchase Requestion (PR)') !!}
                {!! Form::text('no_pr', null, array('placeholder' => 'Nomor Purchase Requestion (PR)','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                {!! Form::label('gambar_pr', 'Scan Purchase Requestion (PR)') !!}
                {!! Form::file('gambar_pr'); !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                {!! Form::label('no_po', 'Nomor Purchase Order (PO)') !!}
                {!! Form::text('no_po', null, array('placeholder' => 'Nomor Purchase Order (PO)','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                {!! Form::label('gambar_po', 'Scan Nomor Purchase Order (PO)') !!}
                {!! Form::file('gambar_po'); !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                {!! Form::label('no_spb', 'Nomor SPB') !!}
                {!! Form::text('no_spb', null, array('placeholder' => 'Nomor SPB','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                {!! Form::label('gambar_spb', 'Scan SPB') !!}
                {!! Form::file('gambar_spb'); !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {!! Form::label('status', 'Status / Keterangan') !!}
                {!! Form::textarea('status', null, array('placeholder' => 'Status / Keterangan','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        {!! Form::submit('Simpan',array('class'=>'btn btn-success')) !!}
    </div>
    
    {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div> --}}
</div>
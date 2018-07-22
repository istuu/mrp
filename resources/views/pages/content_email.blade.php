{{ csrf_field() }}
<input type="hidden" name="mrp_id" value="{{ $mrp->id }}">
<input type="hidden" name="email" value="{{ $mrp->pegawai->email }}">
<input type="hidden" name="nama" value="{{ $mrp->pegawai->nama_pegawai }}">

<!-- tahun sk -->
<div class="row">
    <div class="form-group">
        <div class="col-md-12 col-sm-12">
            <label>Nama</label>
            <input type="text" value="{{ $mrp->pegawai->nama_pegawai }}"  class="form-control" disabled>
        </div>
        <div class="col-md-12 col-sm-12">
            <br/>
        </div>
        <div class="col-md-12 col-sm-12">
            <label>Email</label>
            <input type="text" value="{{ $mrp->pegawai->email }}"  class="form-control" disabled>
        </div>
        <div class="col-md-12 col-sm-12">
            <br/>
        </div>
        <div class="col-md-12 col-sm-12">
            <label>Tipe</label>
            <select name="type" class="form-control">
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 col-sm-12">
            <br/>
        </div>
        <div class="col-md-12 col-sm-12">
            <label>CC</label>
            <select class="form-control" multiple>
                @foreach($pegawais as $pegawai)
                    <option value="{{ $pegawai->email }}">
                        {{ $pegawai->nama_pegawai.' ('.$pegawai->nama_panjang_posisi.') ' }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">

    </div>
</div>

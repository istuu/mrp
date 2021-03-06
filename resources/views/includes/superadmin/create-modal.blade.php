<div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="approveModalLabel">Create Legacy Code</h4>
        </div>

        <!-- Modal Body -->
        <form action="{{ url('formations/legacy/store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">

                <div class="form-group">
                    <h4>Legacy Code Induk</h4>
                    <input type="text" value="{{ $legacy }}" class="form-control" required="" disabled>
                    <input type="hidden" name="legacy_code_induk" value="{{ $legacy }}">
                </div>

                <div class="form-group">
                    <h4>Legacy Code</h4>
                    <input type="text" class="form-control" name="legacy_code" required="">
                </div>

                <div class="form-group">
                    <h4>Nama Panjang</h4>
                    <input type="text" class="form-control" name="nama_panjang" required="">
                </div>

                <div class="form-group">
                    <h4>Nama Singkat</h4>
                    <input type="text" class="form-control" name="nama_singkat" required="">
                </div>

            </div>


            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                {{-- <button type="button" class="btn btn-primary toastr-notify" data-progressBar="true" data-position="top-right" data-notifyType="success" data-message="Berhasil disimpan dan Dikirim" data-dismiss="modal">Simpan</button> --}}
            </div>
        </form>
    </div>
</div>

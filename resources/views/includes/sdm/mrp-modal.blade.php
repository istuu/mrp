<div id="approveModal" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="approveModalLabel">Approve <a href="" class="btn btn-primary edit_link" target="_blank">Edit data transaksi</a></h4>
            </div>

            <!-- Modal Body -->
            <form action="/dashboard/approve_mutasi" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input class="mrp_id" type="hidden" name="id" value="">
                <div class="modal-body">

                    <div class="row form-group">
                        <div class="col-md-12 col-sm-12">
                            <label class="switch switch" data-toggle="collapse" data-target="#rekom_group">
                                <input type="checkbox" name="rekom_checkbox" id="rekom_checkbox" value="0" autocomplete="off">
                                <span class="switch-label" data-on="YES" data-off="NO"></span>
                                <span> Ubah Formasi Jabatan Mutasi? </span>
                            </label>
                        </div>
                    </div>

                    <div class="collapse" id="rekom_group">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control select2" id="rekom_unit" style="width: 100%" disabled onchange="getFormasi(this)">
                                    <option>--- Pilih Unit ---</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 col-sm-6">
                                <select class="form-control" id="rekom_formasi" disabled onchange="getJabatan(this)">
                                    <option>--- Formasi ---</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <select class="form-control" name="kode_olah" id="rekom_jabatan" disabled>
                                    <option>--- Jabatan ---</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <h4>Perintah Cetak SK *</h4>
                        <input class="custom-file-upload" type="file" id="file" name="dokumen_mutasi" id="contact:attachment" data-btn-text="Select a File" required="" />
                        <small class="text-muted block">Max file size: 10Mb (pdf)</small>
                    </div>

                    <div class="form-group">
                        <h4>No. Dokumen *</h4>
                        <input type="text" class="form-control" name="no_dokumen_respon_sdm" required="">
                    </div>

                    <div class="form-group">
                        <h4>Tindak Lanjut *</h4>
                        <!-- select -->
                        <div class="fancy-form fancy-form-select">
                            <select class="form-control" name="tindak_lanjut" required="">
                                <option>--- PILIH ---</option>
                                <option value="Cetak SK Definitif">Cetak SK Definitif</option>
                                <option value="Cetak SK Fungsional">Cetak SK Fungsional</option>
                                <option value="Cetak SK Fungsional & Surat Tugas PLT">Cetak SK Fungsional & Surat Tugas PLT</option>
                                <option value="Cetak SK Fungsional Pembatalan SK Lama">Cetak SK Fungsional Pembatalan SK Lama</option>
                                <option value="Cetak SK Ijin di Luar Tanggungan">Cetak SK Ijin di Luar Tanggungan</option>
                                <option value="Cetak Surat Tugas PLT">Cetak Surat Tugas PLT</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <i class="fancy-arrow"></i>
                        </div>
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
</div>

<div id="approveReqJabatan" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="approveReqJabatanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="approveReqJabatanLabel">Approve <a href="" class="btn btn-primary edit_link" target="_blank">Edit data transaksi</a></h4>
            </div>

            <!-- Modal Body -->
            <form action="/dashboard/approve_mutasi" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input class="mrp_id" type="hidden" name="id" value="">
                <div class="modal-body">

                    <div class="form-group">
                        <h4>NIP Penerima Mutasi *</h4>
                        <input type="text" class="form-control" style="text-transform: uppercase" name="nip" required="">
                    </div>

                    <div class="form-group">
                        <h4>Perintah Cetak *</h4>
                        <input class="custom-file-upload" type="file" id="file" name="dokumen_mutasi" id="contact:attachment" data-btn-text="Select a File" required="" />
                        <small class="text-muted block">Max file size: 10Mb (pdf)</small>
                    </div>

                    <div class="form-group">
                        <h4>No. Dokumen *</h4>
                        <input type="text" class="form-control" name="no_dokumen_respon_sdm" required="">
                    </div>

                    <div class="form-group">
                        <h4>Tindak Lanjut *</h4>
                        <!-- select -->
                        <div class="fancy-form fancy-form-select">
                            <select class="form-control" name="tindak_lanjut" required="">
                                <option>--- PILIH ---</option>
                                <option value="Cetak SK Definitif">Cetak SK Definitif</option>
                                <option value="Cetak SK Fungsional">Cetak SK Fungsional</option>
                                <option value="Cetak SK Fungsional & Surat Tugas PLT">Cetak SK Fungsional & Surat Tugas PLT</option>
                                <option value="Cetak SK Fungsional Pembatalan SK Lama">Cetak SK Fungsional Pembatalan SK Lama</option>
                                <option value="Cetak SK Ijin di Luar Tanggungan">Cetak SK Ijin di Luar Tanggungan</option>
                                <option value="Cetak Surat Tugas PLT">Cetak Surat Tugas PLT</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <i class="fancy-arrow"></i>
                        </div>
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
</div>

<div id="rejectModal" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="rejectModalLabel">Reject <a href="" class="btn btn-primary edit_link" target="_blank">Edit data transaksi</a></h4>
            </div>

            <!-- Modal Body -->
            <form action="/dashboard/reject_mutasi" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input class="mrp_id" type="hidden" name="id" value="">
                <div class="modal-body">

                    <div class="form-group">
                        <h4>Surat Penolakan *</h4>
                        <input class="custom-file-upload" type="file" name="dokumen_mutasi" id="file" id="contact:attachment" data-btn-text="Select a File" required />
                        <small class="text-muted block">Max file size: 10Mb (pdf)</small>
                    </div>

                    <div class="form-group">
                        <h4>No. Dokumen *</h4>
                        <input type="text" class="form-control" name="no_dokumen_respon_sdm" required>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

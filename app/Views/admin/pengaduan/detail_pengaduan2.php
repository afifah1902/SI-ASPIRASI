<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if (session()->getFlashdata('msg')) : ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <div class="card shadow card-detail">
                <div class="card-header">
                    <h3 class="mb-0 text-gray-900"><?= $title; ?></h3>
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col">
                            <?php if ($data['status_aspirasi'] == 3) : ?>
                                <button type="button" class="btn btn-sm btn-primary disabled"><i class="fas fa-info-circle"></i> Aspirasi Disetujui Pemdes</button>
                            <?php elseif ($data['status_aspirasi'] == 2)  : ?>
                                <button type="button" data-toggle="modal" data-target="#approval2" class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Setuju</button>
                                <button type="button" data-toggle="modal" data-target="#rejected2" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i>  Tolak</button>
                               
                                <?php else :?>
                                <button type="button" class="btn btn-sm btn-danger disabled"><i class="fas fa-info-circle"></i> Aspirasi Ditolak Pemdes</button>
                            <?php endif; ?>
                            </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Nama Pengirim</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $data['nama_pengirim']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Status Aspirasi</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= ($data['status_aspirasi'] == 1 ? 'Proses RT' :  ($data['status_aspirasi'] == 2 ? 'Sedang Diproses PEMDES' : 
                            ($data['status_aspirasi'] == 3 ? 'Disetujui' : ($data['status_aspirasi'] == 4 ? 'Ditolak RT' :'Ditolak Pemdes')))) ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Keterangan</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <span class="text-justify"><?= $data['keterangan']; ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Tanggal Aspirasi</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= date('d M Y', strtotime($data['created_at'])); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Perihal</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $data['judul_aspirasi']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Rincian</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <span class="text-justify"><?= $data['isi_aspirasi']; ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Lokasi</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <span class="text-justify">RT <?= $data['lokasi']; ?></span>
                        </div>
                    </div>
                   
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Foto Bukti</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <a href="/uploads/<?= $bukti['img_satu'] ?>" target="_blank"><img src="/uploads/<?= $bukti['img_satu'] ?>" class="img-fluid img-thumbnail" width="100"></a>
                            <?php if ($bukti['img_dua'] != null) : ?>
                                <a href="/uploads/<?= $bukti['img_dua'] ?>" target="_blank"><img src="/uploads/<?= $bukti['img_dua'] ?>" class="img-fluid img-thumbnail" width="100"></a>
                            <?php endif; ?>
                            <?php if ($bukti['img_tiga'] != null) : ?>
                                <a href="/uploads/<?= $bukti['img_tiga'] ?>" target="_blank"><img src="/uploads/<?= $bukti['img_tiga'] ?>" class="img-fluid img-thumbnail" width="100"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="approval2" tabindex="-1" role="dialog" aria-labelledby="approvalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?= form_open('/admin/pengaduan/' . $data['id'], ['class' => 'd-inline', 'id' => 'formApprovePengaduan2']); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="approvalLabel">Yakin ingin mengubah status aspirasi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="text-gray-900">Klik tombol "Yakin" untuk mengubah status aspirasi.</span>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="status_aspirasi" value="<?= $data['status_aspirasi']; ?>">
                    <input type="hidden" name="keterangan" value="<?= $data['keterangan']; ?>">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-yakin">Yakin</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejected2" tabindex="-1" role="dialog" aria-labelledby="reject2Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?= form_open('/admin/pengaduan/rejected2/' . $data['id'], ['class' => 'd-inline', 'id' => 'formRejected2Pengaduan']); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="rejected2Label">Yakin ingin menolak aspirasi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="text-gray-900">Klik tombol "Yakin" untuk mengubah status aspirasi.</span>

                    <div class="form-group">
                        <label for="keterangan">Alasan Menolak:</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div> 

                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="status_aspirasi" value="<?= $data['status_aspirasi']; ?>">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-yakin">Yakin</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('additional-js'); ?>
<script>
    $(document).ready(function() {
        $("#formApprovePengaduan2").submit(function(e) {
            e.preventDefault()

            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function(res) {
                    $('.btn-yakin').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                success: function(res) {
                    $.toast({
                        heading: res.msg,
                        position: 'top-right',
                        icon: 'success'
                    })

                    $("#approval2").modal("toggle")

                    setTimeout(function() {
                        location.reload()
                    }, 3000)
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('additional-js'); ?>
<script>
    $(document).ready(function() {
        $("#formRejected2Pengaduan").submit(function(e) {
            e.preventDefault()

            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function(res) {
                    $('.btn-yakin').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                success: function(res) {
                    $.toast({
                        heading: res.msg,
                        position: 'top-right',
                        icon: 'success'
                    })

                    $("#rejected2").modal("toggle")

                    setTimeout(function() {
                        location.reload()
                    }, 3000)
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>
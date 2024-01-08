<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-900"><?= $title; ?></h1>

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

            <div class="card shadow">
                <div class="card-header">
                    <a href="/pengaduan">&laquo; Kembali ke daftar aspirasi</a>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('/pengaduan/ubah_pengaduan'); ?>
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <input type="hidden" name="id" value="<?= $data['id']; ?>">

                            <div class="form-group">
                                <label for="judul">Perihal</label>
                                <input type="text" name="judul_aspirasi" id="judul" class="form-control <?= $validation->hasError('judul_aspirasi') ? 'is-invalid' : ''; ?>" value="<?= old('judul_aspirasi') ? old('judul_aspirasi') : $data['judul_aspirasi']; ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('judul_aspirasi'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="isi">Jelaskan lebih rinci</label>
                                <textarea name="isi_aspirasi" id="isi" cols="30" rows="13" class="form-control <?= $validation->hasError('isi_aspirasi') ? 'is-invalid' : ''; ?>"><?= old('isi_aspirasi') ? old('isi_aspirasi') : $data['isi_aspirasi']; ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('isi_aspirasi'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Pengirim</label>
                                <div class="form-check">
                                    <input class="form-check-input anonym" type="radio" name="nama_pengirim" id="nama_pengirim1" value="anonym" <?= $data['nama_pengirim'] == 'anonym' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="nama_pengirim1">
                                        <span class="text-gray-800">Samarkan (anonym)</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="nama_pengirim" id="nama_pengirim2" value="<?= $user['nama']; ?>" <?= $data['nama_pengirim'] == $user['nama'] ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="nama_pengirim2">
                                        <span class="text-gray-800">Gunakan nama sendiri</span>
                                    </label>
                                </div>
                                <input type="text" class="form-control pengirim" value="<?= $user['nama']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Upload foto bukti</label>
                                <div class="mb-3">
                                    <p class="mb-0 text-info">Aturan: wajib upload 1 gambar, maksimal ukuran sebesar 1 MB.</p>
                                </div>
                                <hr>

                                <input type="hidden" name="bukti_id" value="<?= $bukti['id']; ?>">
                                <input type="file" name="images[]" id="images" class="p-1 form-control <?= $validation->hasError('images') ? 'is-invalid' : ''; ?>" multiple>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('images'); ?>
                                </div>
                                <?= session()->getFlashdata('err-files'); ?>
                            </div>
                        </div>
                        <button class="btn btn-block btn-primary">Ubah Data</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('additional-js'); ?>
<script>
    $('.pengirim').hide();
    $('input[type=radio]').click(function() {
        if ($(this).hasClass('anonym')) {
            $('.pengirim').hide()
        } else {
            $('.pengirim').show()
        }
    })
</script>
<?= $this->endSection(); ?>
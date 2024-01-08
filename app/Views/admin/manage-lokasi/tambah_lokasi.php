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
                    <a href="/admin/manage-lokasi">&laquo; Kembali ke daftar lokasi</a>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('/lokasi/tambah_lokasi'); ?>
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nama">Nama RT</label>
                                <input type="text" name="nama" id="nama" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : ''; ?>" value="<?= old('nama'); ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nama_ketua_rt">Nama Ketua RT</label>
                                <input type="text" name="nama_ketua_rt" id="nama_ketua_rt" class="form-control <?= $validation->hasError('nama_ketua_rt') ? 'is-invalid' : ''; ?>" value="<?= old('nama_ketua_rt'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_ketua_rt'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    </div>
                 </div>

                 <button class="btn btn-block btn-primary">Tambah Data</button>
                    </div>
    </div>
    </div>
    
<!-- /.container-fluid -->
<?= $this->endSection(); ?>


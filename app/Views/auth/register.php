<?= $this->extend('auth/template'); ?>

<?= $this->section('content'); ?>
<!-- Sign up form -->
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title" style="text-align: center;">Pendaftaran</h2>

                <?= form_open_multipart('auth/validasi_register', ['class' => 'register-form', 'id' => 'register-form']); ?>
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="nama"><i class="zmdi zmdi-account material-icons-name"></i></label>
                    <input type="text" name="nama" id="nama" value="<?= old('nama'); ?>" placeholder="Nama Lengkap" />
                    <small class="text-danger"><?= $validation->getError('nama'); ?></small>
                </div>
                <div class="form-group">
                    <input type="text" name="username" id="username" value="<?= old('username'); ?>" placeholder="Username" />
                    <small class="text-danger"><?= $validation->getError('username'); ?></small>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Alamat Email" value="<?= old('email'); ?>">
                    <small class="text-danger"><?= $validation->getError('email'); ?></small>
                </div>
                <div class="form-group">
                <a> Daftar Sebagai : </a>  
                <label for="user_level"></label>
                    <select name="user_level" id="user_level">
                        <option value="" selected disabled>Pilih Jenis</option>
                        <option value="1">Petugas</option>
                        <option value="2">Ketua RT</option>
                        <option value="4">Kepala Desa</option>
                        <option value="3">Masyarakat</option>
                      
                    </select>
                <small class="text-danger"><?= $validation->getError('user_level'); ?></small>
                </div>
                <div class="form-group">
                <a> Domisili RT:  </a>           
                            <label for="lokasi"></label>
                                <select name="lokasi" id="lokasi">
                                       <option value="" selected disabled>Pilih RT </option>
                                          <?php foreach ($lokasi as $lokasi) : ?>
                                     <option value="<?= $lokasi['id'] ?>"><?= $lokasi['nama'] ?></option>
                             <?php endforeach; ?>
                             </select>
                             <small class="text-danger"><?= $validation->getError('lokasi'); ?></small>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <input type="password" name="password" placeholder="Password" value="<?= old('password'); ?>">
                        <small class="text-danger"><?= $validation->getError('password'); ?></small>
                    </div>
                    <div class="col-sm-7">
                        <input type="password" name="confirm_password" placeholder="Konfirmasi password" value="<?= old('confirm_password'); ?>">
                        <small class="text-danger"><?= $validation->getError('confirm_password'); ?></small>
                    </div>
                </div>
                
                <div class="form-group">
                    <input type="file" class="p-1" name="user_ktp" id="file_ktp">
                    <?php if ($validation->getError('user_ktp')) : ?>
                        <small class="text-danger"><?= $validation->getError('user_ktp'); ?></small>
                    <?php else : ?>
                        <small for="file_ktp" class="text-info">Upload Foto KTP format JPG, PNG, atau JPEG| Maksimal 512 Kb. </small>
                    <?php endif; ?>
                </div>
                        
                <div class="form-group form-button text-center">
                    <button type="submit" name="btn-submit" id="signup" class="btn form-submit" />Daftar</button>
                </div>

                <?= form_close(); ?>
                
                <a href="/auth" class="signup-image-link">Sudah punya akun? Login</a>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection(); ?>
<?= $this->extend('auth/template'); ?>

<?= $this->section('content'); ?>
<!-- Sing in  Form -->
<section class="sign-in">
    <div class="container">

        <?php if (session()->getFlashdata('msg-auth')) : ?>
            <div class="alert alert-success m-0" role="alert">
                <?= session()->getFlashdata('msg-auth'); ?>
            </div>
        <?php elseif (session()->getFlashdata('msg-failed')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('msg-failed'); ?>
            </div>
        <?php endif; ?>

        <div class="signin-content">
          

            <?= form_open('/auth/validasi_login', ['class' => 'signin-form']); ?>
            <a class="logo" style="display: flex; justify-content: center; align-items: center;"> <img src="<?php echo base_url () ?>/assets/img/portfolio/logo_pml.png" style="max-width: 100px; max-height: 200px; height: auto;"> </a>
            <h2 class="form-title" style="text-align: center;">Selamat Datang</h2>
            <?= csrf_field(); ?>
            <div class="form-group">
                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                <input type="text" name="email" id="email" value="<?= old('email'); ?>" placeholder="Email atau username" />
                <small class="text-danger"><?= $validation->getError('email'); ?></small>
            </div>
            <div class="form-group">
                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                <input type="password" name="password" id="password" placeholder="Password" />
                <small class="text-danger"><?= $validation->getError('password'); ?></small>
            </div>
            <div class="form-group form-button text-center">
                <button type="submit" name="btn-submit" id="signin" class="btn form-submit" />Login</button>
            </div>
            <a href="/auth/register" class="signup-image-link">Belum punya akun? Daftar</a>
            <a href="/app/Views/front/landing.php" class="signup-image-link">Kembali Ke Beranda? Tekan Disini</a>
            <?= form_close(); ?>
        </div>
    </div>
    </div>
</section>
<?= $this->endSection(); ?>
<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card">
        <form action="<?= base_url(); ?>/SuperAdmin/update/<?= $menu['id']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3 m-4">
                <label for="title" class="form-label">Menu</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $menu['title']; ?>" disabled>
            </div>
            <div class="custom-control custom-switch m-4">
                <input type="checkbox" class="custom-control-input" id="is_active" <?= ($menu['is_active'] == '1') ? 'checked' : ''; ?> name="is_active" value="1">
                <label class="custom-control-label" for="is_active"><?= ($menu['is_active'] == 1) ? 'Enable' : 'Disable' ?></label>
            </div>
            <div class="custom-control">
                <?php if ($menu['id'] == '2') : ?>
                    <table class="table">
                        <tr>
                            <td> Keterangan</td>
                            <td>
                                Sub menu untuk mengatur aktivasi akun.
                            </td>
                        </tr>
                    </table>
                    <img id="img" src="<?= base_url('img/management_account.png'); ?>" class="img-fluid" alt="Management akun">
                <?php elseif ($menu['id'] == '3') : ?>
                    <table class="table">
                        <tr>
                            <td> Keterangan</td>
                            <td>
                                Sub menu untuk menampilkan informasi data diri (akun).
                            </td>
                        </tr>
                    </table>
                    <img id="img" src="<?= base_url('img/my_profile.png'); ?>" class="img-fluid" alt="Management akun">
                <?php elseif ($menu['id'] == '4') : ?>
                    <table class="table">
                        <tr>
                            <td> Keterangan</td>
                            <td>
                                Sub menu untuk merubah / mengupdate informasi data diri (akun).
                            </td>
                        </tr>
                    </table>
                    <img id="img" src="<?= base_url('img/edit_profile.png'); ?>" class="img-fluid" alt="Management akun">
                <?php elseif ($menu['id'] == '5') : ?>
                    <table class="table">
                        <tr>
                            <td> Keterangan</td>
                            <td>
                                Sub menu agar akun dengan role Administrator dan User dapat mengirim document (surat).
                            </td>
                        </tr>
                    </table>
                    <img id="img" src="<?= base_url('img/upload_berkas.png'); ?>" class="img-fluid" alt="Management akun">
                <?php elseif ($menu['id'] == '8') : ?>
                    <table class="table">
                        <tr>
                            <td> Keterangan</td>
                            <td>
                                Sub menu yang hanya bisa diakses oleh Administrator yang berfungsi memberi persetujuan kepada document yang diajukan User.
                                juga berfungsi untuk mengelola document yang diajukan
                            </td>
                        </tr>
                    </table>
                    <img id="img" src="<?= base_url('img/berkas.png'); ?>" class="img-fluid" alt="Management akun">
                <?php elseif ($menu['id'] == '10') : ?>
                    <table class="table">
                        <tr>
                            <td> Keterangan</td>
                            <td>
                                Sub menu yang berfungsi untuk mengganti password akun
                            </td>
                        </tr>
                    </table>
                    <img id="img" src="<?= base_url('img/change_password.png'); ?>" class="img-fluid" alt="Management akun">
                <?php endif; ?>
            </div>
            <div class="text-center my-3">
                <button type="submit" class="btn text-white mb-3" style="background: linear-gradient(blue,black);">Save Change</button>
            </div>
        </form>
    </div>
</div>



<?= $this->endSection(); ?>
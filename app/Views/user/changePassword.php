<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card row">
        <div class="col-lg-6"></div>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('User/updatePassword'); ?>" method="post" class="m-5">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current password</label>
                <input type="password" class="form-control <?= ($validation->hasError('currentPassword')) ? 'is-invalid' : ''; ?>" id="currentPassword" name="currentPassword">
                <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                    <?= $validation->getError('currentPassword'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="newPassword1" class="form-label">New password</label>
                <input type="password" class="form-control <?= ($validation->hasError('newPassword1')) ? 'is-invalid' : ''; ?>" id="newPassword1" name="newPassword1">
                <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                    <?= $validation->getError('newPassword1'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="newPassword2" class="form-label">Repeat new password</label>
                <input type="password" class="form-control <?= ($validation->hasError('newPassword2')) ? 'is-invalid' : ''; ?>" id="newPassword2" name="newPassword2">
                <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                    <?= $validation->getError('newPassword2'); ?>
                </div>
            </div>
            <div class="text-right my-3">
                <button type="submit" class="btn text-white" style="background: linear-gradient(blue,black);">Change Password</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forgot Password</h1>
                                </div>
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('logout')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('logout'); ?>
                                    </div>
                                <?php endif; ?>
                                <hr>
                                <form class="user" action="<?= base_url('Auth/forgot/' . $nim); ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" placeholder="New Password" name="password">
                                            <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                <?= $validation->getError('password'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password2" placeholder="Repeat New Password" name="password2">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user <?= ($validation->hasError('pin')) ? 'is-invalid' : ''; ?>" id="pin" placeholder="PIN" name="pin" autofocus value="<?= old('pin'); ?>" onkeypress="return event.charCode >= 48 && event.charCode <=57" maxlength="6">
                                        <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                            <?= $validation->getError('pin'); ?>
                                        </div>
                                    </div>
                                    <button class="btn btn-user btn-block text-white" style="background: linear-gradient(blue,black);">
                                        Save
                                    </button>
                                    <a class="btn btn-user btn-block text-white my-2" style="background: linear-gradient(grey,black);" href="<?= base_url('auth'); ?>">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
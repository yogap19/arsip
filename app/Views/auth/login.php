<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container" style="opacity: .9;">
    <?php $rol = (random_int(1, 3)); ?>
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
                                    <img class="rounded-circle" src="<?= base_url('/img/icon/logo_' . $rol . 'b.png'); ?>" alt="" width="100px" height="100px">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('logout')) : ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('logout'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <form class="user" action="<?= base_url('Auth/login'); ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <input type="nim" class="form-control form-control-user <?= ($validation->hasError('nim')) ? 'is-invalid' : ''; ?>" id="nim" placeholder="NIM" name="nim" autofocus value="<?= old('nim'); ?>" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                        <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                            <?= $validation->getError('nim'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password1" placeholder="Password" name="password">
                                        <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-user btn-block text-white" style="background: linear-gradient(blue,black);">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#" data-toggle="modal" data-target="#frogotModal">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url(); ?>/auth/register">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- forgot Modal-->
<div class="modal fade" id="frogotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insret your NIM!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Auth/forgotPassword'); ?>" method="post">
                    <div class="form-group">
                        <input type="nim" class="form-control form-control-user <?= ($validation->hasError('nim')) ? 'is-invalid' : ''; ?>" id="nim" placeholder="NIM" name="nim" autofocus value="<?= old('nim'); ?>" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                        <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                            <?= $validation->getError('nim'); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-user text-white" style="background: linear-gradient(blue,black);">Next</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
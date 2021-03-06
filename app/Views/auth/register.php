<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container" style="opacity: .94;">
    <div class="row justify-content-center">
        <div class="card o-hidden border-0">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="px-5 pb-5 pt-2">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="<?= base_url('Auth/save'); ?>">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user <?= ($validation->hasError('nim')) ? 'is-invalid' : ''; ?>" id="nim" placeholder="NIM" name="nim" autofocus value="<?= old('nim'); ?>" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                            <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                <?= $validation->getError('nim'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="Nama" name="nama" value="<?= old('nama'); ?>">
                                            <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                <?= $validation->getError('nama'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user <?= ($validation->hasError('telepon')) ? 'is-invalid' : ''; ?>" id="telepon" placeholder="No Telepon" name="telepon" value="<?= old('telepon'); ?>" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                            <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                <?= $validation->getError('telepon'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4 text-center">
                                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="1" checked>
                                                <label class="form-check-label" for="gender1">
                                                    Laki - laki
                                                </label>
                                            </div>
                                            <div class="col-4 text-center">
                                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                                                <label class="form-check-label" for="gender2">
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group border border-light">
                                            <p class="fs-6">Tempat tanggal lahir</p>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user <?= ($validation->hasError('tmptLahir')) ? 'is-invalid' : ''; ?>" id="tmptLahir" placeholder="Tempat Lahir" name="tmptLahir" value="<?= old('tmptLahir'); ?>">
                                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                        <?= $validation->getError('tmptLahir'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control form-control-user <?= ($validation->hasError('tglLahir')) ? 'is-invalid' : ''; ?>" id="tglLahir" name="tglLahir" value="<?= old('tglLahir'); ?>">
                                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                        <?= $validation->getError('tglLahir'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="Email Address" name="email" value="<?= old('email'); ?>">
                                            <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                <?= $validation->getError('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group ml-3">
                                            <p>Alamat</p>
                                        </div>
                                        <div class="form-group row mx-2 border border-light">
                                            <div class="form-group row">
                                                <div class="col-sm-6 my-1  mb-sm-0">
                                                    <input type="text" class="form-control form-control-user <?= ($validation->hasError('rtrw')) ? 'is-invalid' : ''; ?>" id="rtrw" placeholder="Rt/Rw (Contoh : 0109)" name="rtrw" value="<?= old('rtrw'); ?>" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                        <?= $validation->getError('rtrw'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 my-1  mb-sm-0">
                                                    <input type="text" class="form-control form-control-user <?= ($validation->hasError('desa')) ? 'is-invalid' : ''; ?>" id="desa" placeholder="Kel/Desa" name="desa" value="<?= old('desa'); ?>">
                                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                        <?= $validation->getError('desa'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 my-1  mb-sm-0">
                                                    <input type="text" class="form-control form-control-user <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" placeholder="Kecamatan" name="kecamatan" value="<?= old('kecamatan'); ?>">
                                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                        <?= $validation->getError('kecamatan'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 my-1  mb-sm-0">
                                                    <input type="text" class="form-control form-control-user <?= ($validation->hasError('kota')) ? 'is-invalid' : ''; ?>" id="kota" placeholder="Kota" name="kota" value="<?= old('kota'); ?>">
                                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                        <?= $validation->getError('kota'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" name="password">
                                                <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                    <?= $validation->getError('password'); ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password2" placeholder="Repeat Password" name="password2">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user <?= ($validation->hasError('pin')) ? 'is-invalid' : ''; ?>" id="pin" placeholder="PIN" name="pin" maxlength="6" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                                <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                                    <?= $validation->getError('pin'); ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="pin2" placeholder="Repeat PIN" name="pin2" maxlength="6" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <!-- <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div> -->
                            <div class="text-center">
                                <a class="small" href="<?= base_url(); ?>/Auth">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
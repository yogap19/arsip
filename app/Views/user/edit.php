<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <?php
    if (session()->get('role_id') == 1) {
        $btn = 'blue';
    } elseif (session()->get('role_id') == 2) {
        $btn = 'red';
    } else {
        $btn = 'black';
    }; ?>
    <!-- Page Heading -->
    <div class="card">
        <div class="row">
            <div class="col">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('User/editProfile'); ?>" method="post" class="m-5" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <!-- left -->
                        <div class="col-4">
                            <!-- preview -->
                            <?php if ($user['image'] == 'default.svg') : ?>
                                <img src="<?= base_url('img'); ?>/<?= ($user['gender'] == '1') ? 'boy.svg' : 'girl.svg'; ?>" alt="<?= $user['image']; ?>" class="img-thumbnail img_preview">
                            <?php else : ?>
                                <img src="<?= base_url('img'); ?>/<?= $user['image']; ?>" alt="<?= $user['image']; ?>" class="img-thumbnail img_preview">
                            <?php endif; ?>
                        </div>
                        <!-- right -->
                        <div class="col-8">
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="id" value="<?= $user['id']; ?>">
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama" value="<?= $user['nama']; ?>">
                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="telepon" class="col-sm-3 col-form-label">No telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : ''; ?>" id="telepon" name="telepon" placeholder="No telepon" value="<?= $user['telepon']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                        <?= $validation->getError('telepon'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="E-mail" value="<?= $user['email']; ?>">
                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="rtrw" class="col-sm-3 col-form-label">Alamat</label>
                            </div>
                            <div class="row mx-3 mb-3">
                                <div class=" col-3">
                                    <label for="rtrw" class="form-label">Rt/Rw</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('rtrw')) ? 'is-invalid' : ''; ?>" id="rtrw" name="rtrw" placeholder="rt/rw" value="<?= $user['rtrw']; ?>" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                        <?= $validation->getError('rtrw'); ?>
                                    </div>
                                </div>
                                <div class=" col-3">
                                    <label for="desa" class="form-label">Desa</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('desa')) ? 'is-invalid' : ''; ?>" id="desa" name="desa" placeholder="Desa" value="<?= $user['desa']; ?>">
                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                        <?= $validation->getError('desa'); ?>
                                    </div>
                                </div>
                                <div class=" col-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" name="kecamatan" placeholder="Kecamatan" value="<?= $user['kecamatan']; ?>">
                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                        <?= $validation->getError('kecamatan'); ?>
                                    </div>
                                </div>
                                <div class=" col-3">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('kota')) ? 'is-invalid' : ''; ?>" id="kota" name="kota" placeholder="Kota" value="<?= $user['kota']; ?>">
                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                        <?= $validation->getError('kota'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-3">
                                <input type="hidden" id="oldImage" name="oldImage" value="<?= $user['image']; ?>">
                                <div class="col-3">
                                    <label for="image" class="form-label">Upload</label>
                                </div>
                                <div class="col-9">
                                    <div class="custom-file">
                                        <input class="custom-file-input <?= ($validation->hasError('image')) ? 'is-invalid' : ''; ?>" type="file" id="image" name="image" onchange="preview()">
                                        <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                            <?= $validation->getError('image'); ?>
                                        </div>
                                        <label for="image" class="col-12 custom-file-label"><?= $user['image']; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn text-white" style="background: linear-gradient(<?= $btn; ?>,black);">Edit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
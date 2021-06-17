<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card">
        <div class="row">
            <div class="col">
                <!-- isi -->
                <div class="tab-pane active" id="index" role="tabpanel" active>
                    <!-- header -->
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="col-lg-6"></div>
                            <form action="<?= base_url('Admin/approve/' . $berkas['id']); ?>" method="post" class="m-5" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3 row">
                                    <table class="table col-6">
                                        <tr>
                                            <td> <label for="keterangan" class="custom-control">Pengirim</label> </td>
                                            <!-- <td> <label for="keterangan" class="custom-control">:</label> </td> -->
                                            <td> <label for="keterangan" class="custom-control"><?= $berkas['nim']; ?></label> </td>
                                        </tr>
                                        <tr>
                                            <td> <label for="keterangan" class="custom-control">Judul surat</label> </td>
                                            <td> <label for="keterangan" class="custom-control"><?= $berkas['title']; ?></label> </td>
                                        </tr>
                                        <tr>
                                            <td> <label for="keterangan" class="custom-control">Status</label> </td>
                                            <td>
                                                <div class="custom-control custom-switch ml-4">
                                                    <input type="checkbox" class="custom-control-input" id="approved_admin" <?= ($berkas['approved_admin'] == '1') ? 'checked' : ''; ?> name="approved_admin" value="1">
                                                    <label class="custom-control-label" for="approved_admin"><?= ($berkas['approved_admin'] == 1) ? 'Enable' : 'Disable' ?></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan">
                                    <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                        <?= $validation->getError('keterangan'); ?>
                                    </div>
                                </div>
                                <!-- button -->
                                <div class="text-right my-3">
                                    <button type="submit" class="btn text-white" style="background: linear-gradient(blue,black);">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end service 1 -->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
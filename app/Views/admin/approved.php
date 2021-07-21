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
                            <div class="col"></div>
                            <form action="<?= base_url('Admin/approve/' . $berkas['id']); ?>" method="post" class="m-5" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3 row">
                                    <table class="table col-6">
                                        <tr>
                                            <td> <label for="keterangan" class="custom-control">Pengirim</label> </td>
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
                                                    <label class="custom-control-label" for="approved_admin"><?= ($berkas['approved_admin'] == 1) ? 'Confirmed' : 'Rejected' ?></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="keterangan" class="custom-control">Action</label></td>
                                            <td>
                                                <a href="<?= base_url('Admin/download/' . $berkas['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
                                                <a href="#" class="btn-circle" style="background: linear-gradient(red,black);" data-toggle="modal" data-target="#delete"><i class="fas fa-trash" style="color: white;"></i></a>
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
                                    <button type="submit" class="btn text-white" style="background: linear-gradient(red,black);">Kirim</button>
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


<!-- Delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda yakin ingin menghapus berkas dengan nama <?= $berkas['title']; ?>.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="<?= base_url(); ?>/Admin/delete/<?= $berkas['id']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
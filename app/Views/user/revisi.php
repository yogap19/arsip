<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="tab-pane active" id="upload" role="tabpanel" active>
        <!-- header -->
        <div class="card shadow mb-4">
            <!-- isi -->
            <div class="card">
                <div class="col-lg-6"></div>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('danger')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('danger'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('User/revisiUpload/' . $berkas['id']); ?>" method="post" class="m-5" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <table class="table-hover table">
                        <tr>
                            <td><label for="nama" class="form-label">Nama file</label></td>
                            <td><a href="<?= base_url('User/download/' . $berkas['id']); ?>" target="_blank" rel="noopener noreferrer"><?= $berkas['title']; ?></a></td>
                        </tr>
                        <tr>
                            <?php if ($berkas['type'] == 1) {
                                $type = 'Proposal kegiatan';
                            } elseif ($berkas['type'] == 2) {
                                $type = 'Laporan kegiatan';
                            } elseif ($berkas['type'] == 3) {
                                $type = 'Beasiswa bawaku';
                            } elseif ($berkas['type'] == 4) {
                                $type = 'Document lain';
                            } ?>
                            <td><label for="type" class="form-label">Type file</label></td>
                            <td><label for="type" class="form-label"><?= $type; ?></label></td>
                        </tr>
                        <?php if ($berkas['approved_Sadmin'] == 1 || $berkas['approved_Sadmin'] == 3) : ?>
                            <tr class="<?= ($berkas['approved_Sadmin'] == 1) ? 'bg-success text-white' : 'bg-danger text-white'; ?>">
                                <td><label for="type" class="form-label">Keterangan Kemahasiswaan</label></td>
                                <td><label for="type" class="form-label"><?= $berkas['keteranganS']; ?></label></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($berkas['approved_admin'] == 1 || $berkas['approved_admin'] == 3) : ?>
                            <tr class="<?= ($berkas['approved_admin'] == 1) ? 'bg-success text-white' : 'bg-danger text-white'; ?>">
                                <td><label for="type" class="form-label">Keterangan Administrator</label></td>
                                <td><label for="type" class="form-label"><?= $berkas['keteranganA']; ?></label></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" value="<?= old('keterangan'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                            <?= $validation->getError('keterangan'); ?>
                        </div>
                    </div>
                    <!-- upload -->
                    <div class="row py-3">
                        <div class="col-3">
                            <label for="title" class="">Upload</label>
                        </div>
                        <div class="col-9">
                            <div class="custom-file">
                                <input class="custom-file-input <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" type="file" id="title" name="title" onchange="label()">
                                <div id="validationServer03Feedback" class="invalid-feedback mx-3">
                                    <?= $validation->getError('title'); ?>
                                </div>
                                <label for="title" class="col-12 custom-file-label"></label>
                            </div>
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


<?= $this->endSection(); ?>
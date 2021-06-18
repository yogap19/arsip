<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-md-12 mb-12">
        <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#upload" role="tab" aria-controls="Profile"><i class="fas fa-upload"> Upload </i></a>
                </li>
                <li class="nav-item">
                    <?php $a = count($requested) ?>
                    <?php $b = count($requestedB) ?>
                    <a class="nav-link" data-toggle="tab" href="#waiting" role="tab" aria-controls="Profile"><i class="fas fa-list-ol"> Waiting list <?= $a + $b ?></i></i></a>
                </li>
                <li class="nav-item">
                    <?php $c = count($rejectedA) ?>
                    <?php $d = count($rejectedS) ?>
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"><i class="far fa-times-circle" style="color: red;"> Rejected <?= $c + $d; ?></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#confirmed" role="tab" aria-controls="profile"><i class="fas fa-check" style="color: green;"> Confirmed <?= count($confirmed); ?></i></a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Upload -->
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
                            <form action="<?= base_url('User/doc'); ?>" method="post" class="m-5" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3 row">
                                </div>
                                <div class="col my-3">
                                    <div class="row">
                                        <div class="form-check col-3">
                                            <input class="form-check-input" type="radio" name="type" id="type_1" value="1" checked>
                                            <label class="form-check-label" for="type_1">
                                                Proposal Kegiatan
                                            </label>
                                        </div>
                                        <div class="form-check col-3">
                                            <input class="form-check-input" type="radio" name="type" id="type_2" value="2">
                                            <label class="form-check-label" for="type_2">
                                                Laporan Kegiatan
                                            </label>
                                        </div>
                                        <div class="form-check col-3">
                                            <input class="form-check-input" type="radio" name="type" id="type_3" value="3">
                                            <label class="form-check-label" for="type_3">
                                                Beasiswa BAWAKU
                                            </label>
                                        </div>
                                        <div class="form-check col-3">
                                            <input class="form-check-input" type="radio" name="type" id="type_4" value="4">
                                            <label class="form-check-label" for="type_4">
                                                Dokument Lain-lain
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan">
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
                <!-- Waiting List -->
                <div class="tab-pane" id="waiting" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="table-responsive">
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
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th class="text-center">NO</th>
                                        <th class="text-center">Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th>kemahasiswaan</th>
                                        <th>Administrator</th>
                                        <th>Keterangan</th>
                                        <th>Keterangan kemahasiswaan</th>
                                        <th>Keterangan Administrator</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($requested as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td class="text-center" style="width: 150px;"><?= $u['title']; ?></td>
                                            <!-- cek type surat -->
                                            <?php if ($u['type'] == '1') {
                                                $type = 'Proposal kegiatan';
                                            } elseif ($u['type'] == '2') {
                                                $type = 'Laporan kegiatan';
                                            } elseif ($u['type'] == '3') {
                                                $type = 'Surat Beasiswa';
                                            } elseif ($u['type'] == '4') {
                                                $type = 'Document lain';
                                            } ?>
                                            <td><?= $type; ?></td>
                                            <!-- cek status approved super Administrator -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <!-- cek status approved Administrator -->
                                            <?php if ($u['approved_admin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td>
                                                <a href="<?= base_url('User/revisi/') . '/' . $u['id']; ?>" style="background: linear-gradient(green,black);" class="btn-circle">
                                                    <i class="fas fa-fw fa-cog text-white"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($requestedB as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><?= $u['title']; ?></td>
                                            <!-- cek type surat -->
                                            <?php if ($u['type'] == '1') {
                                                $type = 'Proposal kegiatan';
                                            } elseif ($u['type'] == '2') {
                                                $type = 'Laporan kegiatan';
                                            } elseif ($u['type'] == '3') {
                                                $type = 'Surat Beasiswa';
                                            } elseif ($u['type'] == '4') {
                                                $type = 'Document lain';
                                            } ?>
                                            <td><?= $type; ?></td>
                                            <!-- cek status approved super Administrator -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <!-- cek status approved Administrator -->
                                            <?php if ($u['approved_admin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td>
                                                <a href="<?= base_url('User/revisi/') . '/' . $u['id']; ?>" style="background: linear-gradient(green,black);" class="btn-circle">
                                                    <i class="fas fa-fw fa-cog text-white"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Rejected -->
                <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="table-responsive">
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
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th>NO</th>
                                        <th class="text-center">Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th>kemahasiswaan</th>
                                        <th>Administrator</th>
                                        <th>Keterangan</th>
                                        <th>Keterangan Administrator</th>
                                        <th>Keterangan kemahasiswaan</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rejectedA as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><?= $u['title']; ?></td>
                                            <!-- cek type surat -->
                                            <?php if ($u['type'] == '1') {
                                                $type = 'Proposal kegiatan';
                                            } elseif ($u['type'] == '2') {
                                                $type = 'Laporan kegiatan';
                                            } elseif ($u['type'] == '3') {
                                                $type = 'Surat Beasiswa';
                                            } elseif ($u['type'] == '4') {
                                                $type = 'Document lain';
                                            } ?>
                                            <td><?= $type; ?></td>
                                            <!-- cek status approved super Administrator -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <!-- cek status approved Administrator -->
                                            <?php if ($u['approved_admin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td>
                                                <a href="<?= base_url('User/revisi/') . '/' . $u['id']; ?>" style="background: linear-gradient(green,black);" class="btn-circle">
                                                    <i class="fas fa-fw fa-cog text-white"></i>
                                                </a>
                                                <a href="#" class="btn-circle" style="background: linear-gradient(red,black);" data-toggle="modal" data-target="#delete"><i class="fas fa-trash" style="color: white;"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($rejectedS as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><?= $u['title']; ?></td>
                                            <!-- cek type surat -->
                                            <?php if ($u['type'] == '1') {
                                                $type = 'Proposal kegiatan';
                                            } elseif ($u['type'] == '2') {
                                                $type = 'Laporan kegiatan';
                                            } elseif ($u['type'] == '3') {
                                                $type = 'Surat Beasiswa';
                                            } elseif ($u['type'] == '4') {
                                                $type = 'Document lain';
                                            } ?>
                                            <td><?= $type; ?></td>
                                            <!-- cek status approved super Administrator -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <!-- cek status approved Administrator -->
                                            <?php if ($u['approved_admin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td>
                                                <a href="<?= base_url('User/revisi/') . '/' . $u['id']; ?>" style="background: linear-gradient(green,black);" class="btn-circle">
                                                    <i class="fas fa-fw fa-cog text-white"></i>
                                                </a>
                                                <a href="#" style="background: linear-gradient(red,black);" class="btn-circle" data-toggle="modal" data-target="#delete">
                                                    <i class="fas fa-fw fa-trash text-white"></i>
                                                </a>
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
                                                            <div class="modal-body">Anda yakin ingin menghapus berkas dengan nama <?= $u['title']; ?>.</div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <form action="<?= base_url(); ?>/User/delete/<?= $u['id']; ?>" method="post" class="d-inline">
                                                                    <?= csrf_field(); ?>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                            <!-- session alert -->

                            <!-- <div class="text-center">
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Confirmed -->
                <div class="tab-pane" id="confirmed" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="table-responsive">
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
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th>NO</th>
                                        <th class="text-center">Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th>kemahasiswaan</th>
                                        <th>Administrator</th>
                                        <th>Keterangan</th>
                                        <th>Keterangan Administrator</th>
                                        <th>Keterangan kemahasiswaan</th>
                                        <th>download</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($confirmed as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><a href="<?= base_url('User/download/' . $u['id']); ?>"><?= $u['title']; ?></a></td>
                                            <!-- cek type surat -->
                                            <?php if ($u['type'] == '1') {
                                                $type = 'Proposal kegiatan';
                                            } elseif ($u['type'] == '2') {
                                                $type = 'Laporan kegiatan';
                                            } elseif ($u['type'] == '3') {
                                                $type = 'Surat Beasiswa';
                                            } elseif ($u['type'] == '4') {
                                                $type = 'Document lain';
                                            } ?>
                                            <td><?= $type; ?></td>
                                            <!-- cek status approved super Administrator -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <!-- cek status approved Administrator -->
                                            <?php if ($u['approved_admin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td class="text-center"><a href="<?= base_url('User/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download text-white"></i></a></td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end table navigasi -->
    </div>
</div>




<?= $this->endSection(); ?>
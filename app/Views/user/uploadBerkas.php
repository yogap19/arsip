<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-md-12 mb-12">
        <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#index" role="tab" aria-controls="Profile"><i class="fas fa-upload"> Upload </i></a>
                </li>
                <li class="nav-item">
                    <?php $a = count($requested) ?>
                    <?php $b = count($requestedB) ?>
                    <a class="nav-link" data-toggle="tab" href="#service" role="tab" aria-controls="Profile"><i class="fas fa-list-ol"> Waiting list <?= $a + $b ?></i></i></a>
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
                <!-- service 1 -->
                <div class="tab-pane active" id="index" role="tabpanel" active>
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
                <!-- service2 -->
                <div class="tab-pane" id="service" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="m-3">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th>NO</th>
                                        <th>NIM</th>
                                        <th>Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th>kemahasiswaan</th>
                                        <th>Administrator</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($requested as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><?= $u['nim']; ?></td>
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
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($requestedB as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><?= $u['nim']; ?></td>
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
                <!-- service3 -->
                <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="m-3">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th>NO</th>
                                        <th>NIM</th>
                                        <th>Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th>kemahasiswaan</th>
                                        <th>Administrator</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rejectedA as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><?= $u['nim']; ?></td>
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
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($rejectedS as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><?= $u['nim']; ?></td>
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
                <!-- service4 -->
                <div class="tab-pane" id="confirmed" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="m-3">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th>NO</th>
                                        <th>NIM</th>
                                        <th>Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th>kemahasiswaan</th>
                                        <th>Administrator</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($confirmed as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><?= $u['nim']; ?></td>
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
            </div>
        </div>
        <!-- end table navigasi -->
    </div>
</div>


<?= $this->endSection(); ?>
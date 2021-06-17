<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-md-12 mb-12">
        <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <?php $a = count($requested) ?>
                    <a class="nav-link" data-toggle="tab" href="#requested" role="tab" aria-controls="Profile"><i class="fas fa-list-ol"> Waiting list <?= $a  ?></i></i></a>
                </li>
                <li class="nav-item">
                    <?php $c = count($rejected) ?>
                    <a class="nav-link" data-toggle="tab" href="#rejected" role="tab" aria-controls="profile"><i class="far fa-times-circle" style="color: red;"> Rejected <?= $c; ?></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#confirmed" role="tab" aria-controls="profile"><i class="fas fa-check" style="color: green;"> Confirmed <?= count($confirmed); ?></i></a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- requested -->
                <div class="tab-pane active" id="requested" role="tabpanel">
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
                                        <th class="text-center">NIM</th>
                                        <th>Nama surat</th>
                                        <th>Jenis surat</th>
                                        <th>Administrator</th>
                                        <th class="text-center">Keterangan</th>
                                        <th>Action</th>
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
                                            <!-- cek status approved Administrator -->
                                            <?php if ($u['approved_admin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td>
                                                <a href="<?= base_url('Admin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                                <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
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
                <!-- rejected -->
                <div class="tab-pane" id="rejected" role="tabpanel">
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
                                        <th class="text-center">NIM</th>
                                        <th>Nama surat</th>
                                        <th>Jenis surat</th>
                                        <th>Administrator</th>
                                        <th class="text-center">Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rejected as $key => $u) : ?>
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
                                            <!-- cek status approved Administrator -->
                                            <?php if ($u['approved_admin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_admin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td>
                                                <a href="<?= base_url('Admin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                                <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
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
                <!-- confirmed -->
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
                                        <th class="text-center">NIM</th>
                                        <th>Nama surat</th>
                                        <th>Jenis surat</th>
                                        <th>kemahasiswaan</th>
                                        <th>Administrator</th>
                                        <th class="text-center">Keterangan</th>
                                        <th>action</th>
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
                                            <td style="width: 100px;"><?= $type; ?></td>
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
                                            <td>
                                                <textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('Admin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                                <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
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
            </div>
        </div>
        <!-- end table navigasi -->
    </div>
</div>
<?= $this->endSection(); ?>
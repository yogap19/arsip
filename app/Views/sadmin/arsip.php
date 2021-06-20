<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-md-12 mb-12">
        <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs">
                <?php $a = count($requested) ?>
                <li class="nav-item active">
                    <a class="nav-link active" data-toggle="tab" href="#requested" role="tab" aria-controls="Profile"><i class="fas fa-list-ol"> Waiting list <?= $a;  ?></i></i></a>
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
                        <div class="card m-3">
                            <div class="table-responsive rounded">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
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
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th class="text-center">kemahasiswaan</th>
                                        <th class="text-center">Keterangan Administrator</th>
                                        <th class="text-center">Keterangan User</th>
                                        <th class="text-center">Option</th>
                                        <th class="text-center">Download</th>
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
                                            <!-- cek status approved kemahasiswaan -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('SuperAdmin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- rejected -->
                <div class="tab-pane" id="rejected" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card m-3">
                            <div class="table-responsive rounded">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th class="text-center">kemahasiswaan</th>
                                        <th class="text-center">Keterangan Administrator</th>
                                        <th class="text-center">Keterangan User</th>
                                        <th class="text-center">Option</th>
                                        <th class="text-center">Download</th>
                                        <th class="text-center">Delete</th>
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
                                            <!-- cek status approved kemahasiswaan -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('SuperAdmin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
                                            </td>
                                            <td class="text-center">
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
                        </div>
                    </div>
                </div>
                <!-- confirmed -->
                <div class="tab-pane" id="confirmed" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card m-3">
                            <div class="table-responsive rounded">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama surat</th>
                                        <th class="text-center">Jenis surat</th>
                                        <th class="text-center">kemahasiswaan</th>
                                        <th class="text-center">Keterangan Kemahasiswaan</th>
                                        <th class="text-center">Keterangan Administrator</th>
                                        <th class="text-center">Keterangan User</th>
                                        <th class="text-center">Option</th>
                                        <th class="text-center">Download</th>
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
                                            <!-- cek status approved super kemahasiswaan -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td>
                                                <textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea>
                                            </td>
                                            <td>
                                                <textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea>
                                            </td>
                                            <td>
                                                <textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('SuperAdmin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                            </td>
                                            <td class="text-center">
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
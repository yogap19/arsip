<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="tab-pane" id="confirmed" role="tabpanel">
        <div class="card shadow mb-4">
            <!-- isi -->
            <div class="card">
                <div class="">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table class="table table-hover">
                        <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                            <td>NO</td>
                            <td class="text-center">NIM</td>
                            <td>Nama surat</td>
                            <td>Jenis surat</td>
                            <td class="text-center">kemahasiswaan</td>
                            <td>Administrator</td>
                            <td class="text-center">Keterangan</td>
                            <td class="text-center">Keterangan Admin</td>
                            <td class="text-center">Keterangan Super Admin</td>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ($berkas as $key => $u) : ?>
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
                                <!-- cek status approved administrator -->
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
                                    <textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea>
                                </td>
                                <td>
                                    <textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
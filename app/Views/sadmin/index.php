<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- option control -->
    <div class="card border-bottom-primary border-left-primary">
        <table class="m-3">
            <form action="<?= base_url('SuperAdmin/index'); ?>" method="post">
                <!-- label -->
                <tr class="text-center">
                    <th colspan="5">Filter By</th>
                </tr>
                <!-- by type  -->
                <tr>
                    <td>
                        <input type="radio" name="type1" id="type_1" value="0" <?= ($type == 0) ? 'checked' : ''; ?>>
                        <label for="type_1">
                            All
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type1" id="type_2" value="1" <?= ($type == 1) ? 'checked' : ''; ?>>
                        <label for="type_2">
                            Proposal Kegiatan
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type1" id="type_3" value="2" <?= ($type == 2) ? 'checked' : ''; ?>>
                        <label for="type_3">
                            Laporan Kegiatan
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type1" id="type_4" value="3" <?= ($type == 3) ? 'checked' : ''; ?>>
                        <label for="type_4">
                            Beasiswa BAWAKU
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type1" id="type_5" value="4" <?= ($type == 4) ? 'checked' : ''; ?>>
                        <label for="type_5">
                            Dokument Lain-lain
                        </label>
                    </td>
                </tr>
                <!-- by jurusan -->
                <tr>
                    <td>
                        <input type="radio" name="type2" id="type1" value="0" <?= ($jurusan == 0) ? 'checked' : ''; ?>>
                        <label for="type1">
                            All
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type2" id="type2" value="1" <?= ($jurusan == 1) ? 'checked' : ''; ?>>
                        <label for="type2">
                            Sistem Informasi
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type2" id="type3" value="2" <?= ($jurusan == 2) ? 'checked' : ''; ?>>
                        <label for="type3">
                            Teknik Informatika
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type2" id="type4" value="3" <?= ($jurusan == 3) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="type4">
                            Akuntansi
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type2" id="type5" value="4" <?= ($jurusan == 4) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="type5">
                            Manajemen
                        </label>
                    </td>
                </tr>
                <!-- by Acepted & rejected -->
                <tr>
                    <td>
                        <input type="radio" name="type3" id="type-1" value="0" <?= ($acepted == 0) ? 'checked' : ''; ?>>
                        <label for="type-1">
                            All
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type3" id="type-2" value="1" <?= ($acepted == 1) ? 'checked' : ''; ?>>
                        <label for="type-2">
                            Acepted
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type3" id="type-3" value="3" <?= ($acepted == 3) ? 'checked' : ''; ?>>
                        <label for="type-3">
                            Rejected
                        </label>
                    </td>
                    <td>
                        <input type="radio" name="type3" id="type-4" value="2" <?= ($acepted == 2) ? 'checked' : ''; ?>>
                        <label for="type-4">
                            Requested
                        </label>
                    </td>
                </tr>
                <tr class="text-center">
                    <td colspan="5"><button type="submit" class="btn-circle text-white my-2" style="background: linear-gradient(blue,black);"><i class="fas fa-check"></i></button></td>
                </tr>
            </form>
        </table>
    </div>
    <br>
    <!-- isi -->
    <div class="card">
        <div class="table-responsive">
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
                    <th class="text-center">Administrator</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Keterangan Admin</th>
                    <th class="text-center">Keterangan Super Admin</th>
                </tr>
                <?php $i = 1; ?>
                <?php ($berkasNim == null) ? $hasil = $berkasHasil : $hasil = $berkasNim ?>
                <?php foreach ($hasil as $key => $u) : ?>
                    <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td><a href="<?= base_url('Admin/detail/' . $u['id']); ?>"><?= $u['nim']; ?></a></td>
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
<?= $this->endSection(); ?>
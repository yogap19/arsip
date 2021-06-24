<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-current="true" href="#">Berkas Tahun <?= date('Y'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#berkasLama" role="tab" aria-controls="berkasLama">Berkas Lama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#beasiswa" role="tab" aria-controls="beasiswa">Beasiswa</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content m-2">
                <!-- Page 1 -->
                <div class="tab-pane active" id="dashboard" role="tabpanel">
                    <!-- Isi dari Dashboard -->
                    <?php
                    $proposal = [];
                    $laporan = [];
                    $beasiswa = [];
                    $dll = [];
                    foreach ($allBerkas as $key => $value) {
                        # code...
                        if (substr($value['updated_at'], 0, 4) == date('Y') && $value['type'] == 1) {
                            array_push($proposal, $value);
                        }
                        if (substr($value['updated_at'], 0, 4) == date('Y') && $value['type'] == 2) {
                            array_push($laporan, $value);
                        }
                        if (substr($value['updated_at'], 0, 4) == date('Y') && $value['type'] == 3) {
                            array_push($beasiswa, $value);
                        }
                        if (substr($value['updated_at'], 0, 4) == date('Y') && $value['type'] == 4) {
                            array_push($dll, $value);
                        }
                    }
                    ?>
                    <!-- Card Information -->
                    <div class="">
                        <div class="row">
                            <!-- card 1  -->
                            <div class="col-3">
                                <div class="card shadow h-100 py-2" style="background: linear-gradient(blue,black);">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2 text-center">
                                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Proposal Tahun <?= date('Y'); ?></div>
                                                <div class="h5 mb-0 font-weight-bold text-white"><?= count($proposal); ?></div>
                                            </div>
                                            <!-- <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card 2  -->
                            <div class="col-3">
                                <div class="card shadow h-100 py-2" style="background: linear-gradient(red,black);">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2 text-center">
                                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Laporan Tahun <?= date('Y'); ?></div>
                                                <div class="h5 mb-0 font-weight-bold text-white"><?= count($laporan); ?></div>
                                            </div>
                                            <!-- <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card 3  -->
                            <div class="col-3">
                                <div class="card shadow h-100 py-2" style="background: linear-gradient(green,black);">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2 text-center">
                                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Beasiswa Tahun <?= date('Y'); ?></div>
                                                <div class="h5 mb-0 font-weight-bold text-white"><?= count($beasiswa); ?></div>
                                            </div>
                                            <!-- <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-white-300"></i>
                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card 4  -->
                            <div class="col-3">
                                <div class="card shadow h-100 py-2" style="background: linear-gradient(purple,black);">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2 text-center">
                                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Document Lain-Lain Tahun <?= date('Y'); ?></div>
                                                <div class="h5 mb-0 font-weight-bold text-white"><?= count($dll); ?></div>
                                            </div>
                                            <!-- <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- isi -->
                    <div class="row">
                        <!-- left -->
                        <div class="col-12">
                            <div class="card">
                                <!-- Collapsable Card Example -->
                                <div class="card shadow mx-1 mt-1">
                                    <!-- Card Header - Accordion -->
                                    <a href="#collapseCardExample" style="background: linear-gradient(blue,black);" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                        <h6 class="font-weight-bold text-white text-center">Filter by</h6>
                                    </a>
                                    <!-- Card Content - Collapse -->
                                    <div class="collapse" id="collapseCardExample">
                                        <div class="card-body">
                                            <form action="<?= base_url('SuperAdmin/index'); ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <!-- type     -->
                                                <div class="row">
                                                    <div class="col-1">
                                                        <input type="radio" name="type1" id="type_1" value="0" <?= ($type == 0) ? 'checked' : ''; ?>>
                                                        <label for="type_1">
                                                            All
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <!-- type -->
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input type="radio" name="type1" id="type_2" value="1" <?= ($type == 1) ? 'checked' : ''; ?>>
                                                                <label for="type_2">
                                                                    Proposal Kegiatan
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type1" id="type_3" value="2" <?= ($type == 2) ? 'checked' : ''; ?>>
                                                                <label for="type_3">
                                                                    Laporan Kegiatan
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type1" id="type_4" value="3" <?= ($type == 3) ? 'checked' : ''; ?>>
                                                                <label for="type_4">
                                                                    Beasiswa
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type1" id="type_5" value="4" <?= ($type == 4) ? 'checked' : ''; ?>>
                                                                <label for="type_5">
                                                                    Dokument Lain
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Jurusan S1 -->
                                                <div class="row">
                                                    <div class="col-1">
                                                        <input type="radio" name="type2" id="type1" value="0" <?= ($jurusan == 0) ? 'checked' : ''; ?>>
                                                        <label for="type1">
                                                            All
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type2" value="1" <?= ($jurusan == 1) ? 'checked' : ''; ?>>
                                                                <label for="type2">
                                                                    Sistem Informasi
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type3" value="2" <?= ($jurusan == 2) ? 'checked' : ''; ?>>
                                                                <label for="type3">
                                                                    Teknik Informatika
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type4" value="3" <?= ($jurusan == 3) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="type4">
                                                                    Akuntansi
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type5" value="4" <?= ($jurusan == 4) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="type5">
                                                                    Manajemen
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Jurusan D3 -->
                                                <div class="row">
                                                    <div class="col-1">
                                                    </div>
                                                    <div class="col-11">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type6" value="5" <?= ($jurusan == 5) ? 'checked' : ''; ?>>
                                                                <label for="type6">
                                                                    Manajemen Informasi
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type7" value="6" <?= ($jurusan == 6) ? 'checked' : ''; ?>>
                                                                <label for="type7">
                                                                    Teknik Informatika D-3
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type8" value="7" <?= ($jurusan == 7) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="type8">
                                                                    Akuntansi D-3
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type9" value="8" <?= ($jurusan == 8) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="type9">
                                                                    Manajemen D-3
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Status approved -->
                                                <div class="row">
                                                    <div class="col-1">
                                                        <input type="radio" name="type3" id="type-1" value="0" <?= ($acepted == 0) ? 'checked' : ''; ?>>
                                                        <label for="type-1">
                                                            All
                                                        </label>
                                                    </div>
                                                    <div class="col-11">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input type="radio" name="type3" id="type-2" value="1" <?= ($acepted == 1) ? 'checked' : ''; ?>>
                                                                <label for="type-2">
                                                                    Acepted
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type3" id="type-3" value="3" <?= ($acepted == 3) ? 'checked' : ''; ?>>
                                                                <label for="type-3">
                                                                    Rejected
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type3" id="type-4" value="2" <?= ($acepted == 2) ? 'checked' : ''; ?>>
                                                                <label for="type-4">
                                                                    Requested
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <button type="submit" class="btn text-white my-2" style="background: linear-gradient(blue,black);">Filter</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- search -->
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-5 my-2 ml-5">
                                        <form class="mr-auto ml-md- my-2 my-md-0 mw-100 navbar-search" action="<?= base_url('SuperAdmin/index'); ?>" method="POST">
                                            <?= csrf_field(); ?>
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-light " placeholder="Cari dengan kata kunci..." aria-label="Search" autofocus aria-describedby="basic-addon2" name="search" id="search">
                                                <div class="input-group-append">
                                                    <button class="btn text-white" style="background: linear-gradient(blue,black);" type="submit" name="submit">
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="rounded m-1">
                                    <div class="table-responsive rounded">
                                        <?php if (session()->getFlashdata('pesan')) : ?>
                                            <div class="alert alert-success" role="alert">
                                                <?= session()->getFlashdata('pesan'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <table class="table-hover table">
                                            <tr class="text-white" style="background: linear-gradient(Blue, Black); max-height: 40px;">
                                                <th class="text-center">NO</th>
                                                <th class="text-center">Pengirim</th>
                                                <th class="text-center">Nama surat</th>
                                                <th class="text-center" style="min-width: 200px;">Jenis surat</th>
                                                <th class="text-center">kemahasiswaan</th>
                                                <th class="text-center">Administrator</th>
                                                <th class="text-center" style="min-width: 200px;">User</th>
                                                <th class="text-center" style="min-width: 200px;">BEM</th>
                                                <th class="text-center" style="min-width: 200px;">kemahasiswaan</th>
                                                <th class="text-center" style="min-width: 150px;">Updated At</th>
                                            </tr>
                                            <?php $i = 1 + (5 * ($page - 1)); ?>
                                            <?php ($berkasNim == null) ? $hasil = $berkasHasil : $hasil = $berkasNim ?>
                                            <?php foreach ($hasil as $key => $u) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $i; ?></td>
                                                    <td><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                                    <td style="max-width: 150px;"><a href="<?= base_url('SuperAdmin/download/' . $u['id']); ?>"><?= substr($u['title'], 14, 20); ?></a></td>
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
                                                    <td class="text-center" style="width: 100px;"><?= $type; ?></td>
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
                                                    <td class="text-center"><?= $u['updated_at']; ?></td>
                                                </tr>
                                                <?php $i++ ?>
                                            <?php endforeach; ?>
                                        </table>
                                        <div class="row ml-3">
                                            <?= $pager->links('berkas', 'berkas_pager'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page 2 -->
                <div class="tab-pane" id="berkasLama" role="tabpane2">
                    <!-- isi -->
                    <div class="accordion" id="accordionExample">
                        <?php for ($years = 2020; $years <= date('Y'); $years++) : ?>
                            <!-- accordion 1 -->
                            <div class="card">
                                <div class="card-header" id="headingOne" style="background: linear-gradient(blue,black);">
                                    <div class="btn btn-link text-white btn-block text-center" type="button" data-toggle="collapse" data-target="#collapseOne<?= $years; ?>" aria-expanded="true" aria-controls="collapseOne<?= $years; ?>">
                                        Berkas Tahun <?= $years; ?>
                                    </div>
                                </div>

                                <div id="collapseOne<?= $years; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <!-- isi -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="rounded m-1">
                                                        <div class="table-responsive rounded">
                                                            <table class="table-hover table">
                                                                <tr class="text-white" style="background: linear-gradient(Blue, Black); max-height: 40px;">
                                                                    <th class="text-center">NO</th>
                                                                    <th class="text-center">Pengirim</th>
                                                                    <th class="text-center">Nama surat</th>
                                                                    <th class="text-center" style="min-width: 200px;">Jenis surat</th>
                                                                    <th class="text-center">kemahasiswaan</th>
                                                                    <th class="text-center">Administrator</th>
                                                                    <th class="text-center" style="min-width: 200px;">User</th>
                                                                    <th class="text-center" style="min-width: 200px;">BEM</th>
                                                                    <th class="text-center" style="min-width: 200px;">kemahasiswaan</th>
                                                                    <th class="text-center" style="min-width: 150px;">Updated At</th>
                                                                </tr>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($allBerkas as $key => $u) : ?>
                                                                    <?php if (substr($u['updated_at'], 0, 4) == $years) : ?>
                                                                        <tr>
                                                                            <td class="text-center"><?= $i; ?></td>
                                                                            <td><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                                                            <td style="max-width: 150px;"><a href="<?= base_url('SuperAdmin/download/' . $u['id']); ?>"><?= substr($u['title'], 14, 20); ?></a></td>
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
                                                                            <td class="text-center" style="width: 100px;"><?= $type; ?></td>
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
                                                                            <td class="text-center"><?= $u['updated_at']; ?></td>
                                                                        </tr>
                                                                        <?php $i++; ?>
                                                                    <?php else : ?>
                                                                    <?php endif; ?>

                                                                <?php endforeach; ?>
                                                            </table>
                                                            <div class="row ml-3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <!-- Page 3 -->
                <div class="tab-pane" id="beasiswa" role="tabpane3">
                    <div class="row">page 3</div>
                    <div class="card">

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- detail Modal-->
<?php foreach ($users as $key => $u) : ?>
    <div class="modal fade" id="data<?= $u['nim']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col">
                            <h5 class="modal-title" id="exampleModalLabel"><?= $u['nim']; ?> </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php if ($u['role_id'] == 1) : ?>
                                <h5 class="badge text-white ml-3" style="background: linear-gradient(blue,black);" id="exampleModalLabel"> Super Administrator</h5>
                            <?php elseif ($u['role_id'] == 2) : ?>
                                <h5 class="badge text-white ml-3" style="background: linear-gradient(red,black);" id="exampleModalLabel">Administrator</h5>
                            <?php elseif ($u['role_id'] == 3) : ?>
                                <h5 class="badge text-white ml-3" style="background: linear-gradient(grey,black);" id="exampleModalLabel">User</h5>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- isi -->
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img class="" style="width: 250px; height: 300px;" src="<?= base_url(); ?>/img/<?= $u['image']; ?>" alt="<?= $u['image']; ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-4">
                                            <p>Nama</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['nama']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>Jurusan</p>
                                        </div>
                                        <div class="col-8">
                                            <!-- cek jurusan -->
                                            <?php if (substr($u['nim'], 0, 2) == '35') : ?>
                                                <p>Sistem Informasi</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '36') : ?>
                                                <p>Teknik Informatika</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '37') : ?>
                                                <p>Akuntansi</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '38') : ?>
                                                <p>Manajemen</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '25') : ?>
                                                <p>Manajemen Informasi</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '26') : ?>
                                                <p>Teknik Informatika D-3</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '27') : ?>
                                                <p>Akuntansi D-3</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '28') : ?>
                                                <p>Manajemen D-3</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>Gender</p>
                                        </div>
                                        <div class="col-8">
                                            <?php if ($u['gender'] == 1) : ?>
                                                <p>Laki - laki</p>
                                            <?php elseif ($u['gender'] == 2) : ?>
                                                <p>Perempuan</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>No telepon</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['telepon']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>E-mail</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['email']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>TTL</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['tmptLahir']; ?>, <?= date("d-m-Y", strtotime($u['tglLahir'])); ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>Alamat</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['rtrw']; ?>, <?= $u['desa']; ?>, <?= $u['kecamatan']; ?>, <?= $u['kota']; ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <p class="card-text"><small class="text-muted">Created at :<?= $u['created_at']; ?></small></p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="card-text"><small class="text-muted">Updated at : <?= $u['updated_at']; ?></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>
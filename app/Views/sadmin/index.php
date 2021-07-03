<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-current="true" href="#">Berkas </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#berkasLama" role="tab" aria-controls="berkasLama">Rekap Tahunan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#beasiswa" role="tab" aria-controls="beasiswa">Beasiswa</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="background: #F2F2F2;">
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
                        if ($value['type'] == 1) {
                            array_push($proposal, $value);
                        }
                        if ($value['type'] == 2) {
                            array_push($laporan, $value);
                        }
                        if ($value['type'] == 3) {
                            array_push($beasiswa, $value);
                        }
                        if ($value['type'] == 4) {
                            array_push($dll, $value);
                        }
                    }
                    $jumlah = count($proposal) + count($beasiswa) + count($laporan) + count($dll);

                    $p_proposal = count($proposal) * 100 / $jumlah;
                    $p_laporan = count($laporan) * 100 / $jumlah;
                    $p_beasiswa = count($beasiswa) * 100 / $jumlah;
                    $p_dll = count($dll) * 100 / $jumlah;
                    ?>
                    <!-- Card Information -->
                    <div class="row">
                        <!-- card 1  -->
                        <div class="col-3">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Beasiswa
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($proposal); ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $p_proposal; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="far fa-file-powerpoint fa-2x" style="color: #4E73DF;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card 2  -->
                        <div class="col-3">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Laporan
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($laporan); ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $p_laporan; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-powerpoint fa-2x" style="color: #1CC88A;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card 3  -->
                        <div class="col-3">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Beasiswa
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($beasiswa); ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $p_beasiswa; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-archive fa-2x" style="color: #E85547;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card 4  -->
                        <div class="col-3">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Document
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($dll); ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $p_dll; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-alt fa-2x" style="color: #36B9CC;"></i>
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
                        <div class="col-7">
                            <div class="card">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-<?= (session()->getFlashdata('pesan') == 'Pencarian tidak ditemukan') ? 'danger' : 'success'; ?> mx-1 my-0 mt-1" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <!-- Collapsable Card Example -->
                                <div class="card shadow mx-1 mt-1">
                                    <!-- Card Header - Accordion -->
                                    <a href="#collapseCardExample" style="background: linear-gradient(blue,black);" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                        <h6 class="font-weight-bold text-white text-center">Filter by</h6>
                                    </a>
                                    <!-- Card Content - Collapse -->
                                    <div class="collapse" id="collapseCardExample">
                                        <div class="card-body bg-primary text-white">
                                            <form action="<?= base_url('SuperAdmin/index'); ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <!-- type     -->
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input type="radio" name="type1" id="type_1" value="0" <?= ($type == 0) ? 'checked' : ''; ?>>
                                                        <label for="type_1">
                                                            All
                                                        </label>
                                                    </div>
                                                    <div class="col-10">
                                                        <!-- type -->
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input type="radio" name="type1" id="type_2" value="1" <?= ($type == 1) ? 'checked' : ''; ?>>
                                                                <label for="type_2">
                                                                    Proposal
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type1" id="type_3" value="2" <?= ($type == 2) ? 'checked' : ''; ?>>
                                                                <label for="type_3">
                                                                    Laporan
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
                                                                    Doc
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Jurusan S1 -->
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input type="radio" name="type2" id="type1" value="0" <?= ($jurusan == 0) ? 'checked' : ''; ?>>
                                                        <label for="type1">
                                                            All
                                                        </label>
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type2" value="1" <?= ($jurusan == 1) ? 'checked' : ''; ?>>
                                                                <label for="type2">
                                                                    SI (S-1)
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type3" value="2" <?= ($jurusan == 2) ? 'checked' : ''; ?>>
                                                                <label for="type3">
                                                                    TI (S-1)
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type4" value="3" <?= ($jurusan == 3) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="type4">
                                                                    AK (S-1)
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type5" value="4" <?= ($jurusan == 4) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="type5">
                                                                    MN (S-1)
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Jurusan D3 -->
                                                <div class="row">
                                                    <div class="col-2">
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type6" value="5" <?= ($jurusan == 5) ? 'checked' : ''; ?>>
                                                                <label for="type6">
                                                                    MI (D-3)
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type7" value="6" <?= ($jurusan == 6) ? 'checked' : ''; ?>>
                                                                <label for="type7">
                                                                    TI (D-3)
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type8" value="7" <?= ($jurusan == 7) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="type8">
                                                                    AK (D-3)
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="radio" name="type2" id="type9" value="8" <?= ($jurusan == 8) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="type9">
                                                                    MN (D-3)
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
                                <div class="row m-1">
                                    <div class="col-6"></div>
                                    <div class="col-6">
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
                                <!-- isi table -->
                                <div class="rounded m-2">
                                    <div class="table-responsive rounded">
                                        <table class="table-striped table-hover border-dark">
                                            <tr>
                                                <th class="text-center">NO</th>
                                                <th class="text-center" style="min-width: 150px;">Pengirim</th>
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
                                            <?php ($berkasHasil != null) ? $hasil = $berkasHasil : $hasil = $berkas ?>
                                            <?php foreach ($hasil as $key => $u) : ?>
                                                <tr>
                                                    <td class="text-center mx-2"><?= $i; ?></td>
                                                    <td class="text-center mx-2"><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
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
                                        <?= $pager->links('berkas', 'berkas_pager'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <!-- chart -->
                            <div class="card">
                                <div class="row">
                                    <div class="col">
                                        <script src="https://code.highcharts.com/highcharts.js"></script>
                                        <script src="https://code.highcharts.com/modules/exporting.js"></script>
                                        <div id="container" style="min-width: 310px; height: 537px; max-width:100%; margin: 0 auto"></div>
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
                                                <div class="rounded m-1">
                                                    <div class="table-responsive rounded">
                                                        <table class="table table-striped table-hover">
                                                            <tr>
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
                        <?php endfor; ?>
                    </div>
                </div>
                <!-- Page 3 -->
                <div class="tab-pane" id="beasiswa" role="tabpane3">
                    <div class="card">
                        <!-- isi -->
                        <div class="accordion" id="accordionExample">
                            <?php
                            $db = \Config\Database::connect();
                            $beasiswa = $db->table('berkas')->join('user', 'user.nim = berkas.nim')
                                ->select('berkas.nim')->select('berkas.updated_at')->select('berkas.id')->select('berkas.title')->select('user.nama')->select('berkas.nik')
                                ->select('user.gender')->select('user.rtrw')->select('user.desa')->select('user.kecamatan')->select('user.kota')
                                ->where('berkas.type = 3')->get()->getResultArray();
                            ?>
                            <?php for ($years = date('Y'); $years >= 2020; $years--) : ?>
                                <!-- accordion 1 -->
                                <!-- <div class="card"> -->
                                <div class="card-header" id="headingOne" style="background: linear-gradient(blue,black);">
                                    <div class="btn btn-link text-white btn-block text-center" type="button" data-toggle="collapse" data-target="#collapseOne<?= $years; ?>" aria-expanded="true" aria-controls="collapseOne<?= $years; ?>">
                                        Beasiswa Tahun <?= $years; ?>
                                    </div>
                                </div>

                                <div id="collapseOne<?= $years; ?>" class="collapse <?= ($years == date('Y')) ? 'show' : ''; ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <!-- isi -->
                                        <div class="row">
                                            <div class="col">
                                                <div class="row text-right">
                                                    <div class="col">
                                                        <a href="<?= base_url('SuperAdmin/excel/' . $years); ?>" class="btn text-white" style="background: green;"><i class="far fa-file-excel"></i></a>
                                                    </div>
                                                </div>
                                                <div class="rounded m-1">
                                                    <div class="table-responsive rounded">
                                                        <table class="table table-striped table-hover">
                                                            <tr>
                                                                <th class="text-center">NO</th>
                                                                <th class="text-center">NIM</th>
                                                                <th class="text-center" style="min-width: 200px;">Nama Pengirim</th>
                                                                <th class="text-center">Jurusan</th>
                                                                <th class="text-center" style="min-width: 200px;">Nama surat</th>
                                                                <th class="text-center" style="min-width: 200px;">NIK</th>
                                                                <th class="text-center" style="min-width: 300px;">Alamat</th>
                                                                <th class="text-center" style="min-width: 150px;">Dikirim</th>
                                                            </tr>
                                                            <?php $i = 1; ?>

                                                            <?php foreach ($beasiswa as $key => $u) : ?>
                                                                <?php if (substr($u['updated_at'], 0, 4) == $years) : ?>
                                                                    <tr>
                                                                        <td class="text-center"><?= $i; ?></td>
                                                                        <td><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                                                        <td><?= $u['nama']; ?></td>
                                                                        <?php
                                                                        $jurusan = substr($u['nim'], 0, 2);
                                                                        if ($jurusan == 35) {
                                                                            $j = 'Sistem Informasi';
                                                                        } elseif ($jurusan == 36) {
                                                                            $j = 'Teknik Informatika S-1';
                                                                        } elseif ($jurusan == 37) {
                                                                            $j = 'Akuntansi S-1';
                                                                        } elseif ($jurusan == 38) {
                                                                            $j = 'Manajemen S-1';
                                                                        } elseif ($jurusan == 25) {
                                                                            $j = 'Manajemen Informasi D-3';
                                                                        } elseif ($jurusan == 26) {
                                                                            $j = 'Teknik Informatika D-3';
                                                                        } elseif ($jurusan == 27) {
                                                                            $j = 'Akuntansi D-3';
                                                                        } elseif ($jurusan == 28) {
                                                                            $j = 'Manajemen D-3';
                                                                        }
                                                                        ?>
                                                                        <td><?= $j; ?></td>
                                                                        <td style="max-width: 150px;"><a href="<?= base_url('SuperAdmin/download/' . $u['id']); ?>"><?= substr($u['title'], 14, 20); ?></a></td>
                                                                        <td><?= $u['nik']; ?></td>
                                                                        <td><?= $u['rtrw']; ?> <?= $u['desa']; ?> <?= $u['kecamatan']; ?> <?= $u['kota']; ?></td>
                                                                        <td><?= $u['updated_at']; ?></td>
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
                                <!-- </div> -->
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    let a;
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Statistik pertahun'
        },
        subtitle: {
            text: 'Sumber : Arsip Online'
        },
        xAxis: {
            //INI ADALAH UNTUK KOLOM KETERANGAN

            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'

            ],
            title: {
                text: 'Golongan'
            },
            crosshair: true
        },
        yAxis: {

            title: {
                text: 'Jumlah'
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:8pt">{point.key}</span><table style="font-size:8pt">',
            pointFormat: '<tr><td style="color:{series.color};padding:0">Jml.: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.,
                borderWidth: 0
            }
        },
        series: [{
            colorByPoint: true,
            showInLegend: false,

            data: [12, 18, 87, 55, 44, 40, 36, 33, 52, 65, 45, 57] //INI ADALAH UNTUK JUMLAH

        }, ]
    });
</script>

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
                                <img style="width: 300px; height: 300px;" src="<?= base_url(); ?>/img/<?= $u['image']; ?>" alt="<?= $u['image']; ?>">
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
<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Broadcast Message -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h4 class="alert-heading text-center"><strong>Preview</strong></h4>
        <hr>
        <h4 class="alert-heading"><strong><?= session()->getFlashdata('subject') ?></strong></h4>
        <?= session()->getFlashdata('isi'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card p-3">
        <form action="<?= base_url(); ?>/SuperAdmin/broadcastSave" method="POST">
            <h2 class="text-center">Jurusan</h2>
            <!-- Jenjang S-1    -->
            <div class="row m-2">
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="si" name="si" value="1" checked>
                        <label class="form-check-label" for="si">Sistem Informasi S-1</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ti" name="ti" value="1" checked>
                        <label class="form-check-label" for="ti">Teknik Informatika S-1</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ak" name="ak" value="1" checked>
                        <label class="form-check-label" for="ak">Akuntansi S-1</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="mn" name="mn" value="1" checked>
                        <label class="form-check-label" for="mn">Manajemen S-1</label>
                    </div>
                </div>
            </div>
            <!-- Jenjang D-3 -->
            <div class="row m-2">
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="si3" name="si3" value="1" checked>
                        <label class="form-check-label" for="si3">Manajemen Informasi D-3</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ti3" name="ti3" value="1" checked>
                        <label class="form-check-label" for="ti3">Teknik Informatika D-3</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ak3" name="ak3" value="1" checked>
                        <label class="form-check-label" for="ak3">Akuntansi D-3</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="mn3" name="mn3" value="1" checked>
                        <label class="form-check-label" for="mn3">Manajemen D-3</label>
                    </div>
                </div>
            </div>
            <hr>
            <h2 class="text-center">Angkatan</h2>
            <?php
            $tahun = [];
            for ($thn = date('Y'); $thn >= date('Y') - 4; $thn--) {
                array_push($tahun, $thn);
            }
            $i = 1;
            $j = 1;
            ?>
            <!-- Angkatan -->
            <div class="row m-2 text-center">
                <?php foreach ($tahun as $key => $value) : ?>
                    <div class="col-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="<?= $value; ?>" name="tahun<?= $i; ?>" value="1" checked>
                            <label class="form-check-label" for="<?= $value; ?>">Semester <?= $j; ?> / <?= $j + 1; ?></label>
                        </div>
                    </div>
                    <?php $i++; ?>
                    <?php $j += 2; ?>
                <?php endforeach; ?>
            </div>
            <div class="row my-4">
                <div class="col">
                    <select class="custom-select" name=" lama" id="lama">
                        <option value="1">1 Hari</option>
                        <option value="3">3 Hari</option>
                        <option value="7">7 Hari</option>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text text-white" for="textarea" style="background: linear-gradient(blue,black); width: 80px;">Subject</label>
                </div>
                <input type="text" class="form-control <?= ($validation->hasError('text')) ? 'is-invalid' : ''; ?>" name="text" id="text" placeholder="Input Subject Message . . ." style="text-transform:uppercase;"></input>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <strong><?= $validation->getError('text'); ?></strong>
                </div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text text-white" for="textarea" style="background: linear-gradient(blue,black); width: 80px;">Pesan</label>
                </div>
                <textarea class="form-control <?= ($validation->hasError('textarea')) ? 'is-invalid' : ''; ?>" name="textarea" id="textarea" aria-label="With textarea" placeholder="Input Broadcast Message . . ."></textarea>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <strong> <?= $validation->getError('textarea'); ?></strong>
                </div>
            </div>
            <div class="row my-4">
                <div class="col text-center">
                    <button type="submit" class="btn text-white" style="background: linear-gradient(blue,blue,black);"><strong>Send</strong></button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card">
        <form action="<?= base_url(); ?>/SuperAdmin/update/<?= $menu['id']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3 m-4">
                <label for="title" class="form-label">Menu</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $menu['title']; ?>" disabled>
            </div>
            <div class="custom-control custom-switch m-4">
                <input type="checkbox" class="custom-control-input" id="is_active" <?= ($menu['is_active'] == '1') ? 'checked' : ''; ?> name="is_active" value="1">
                <label class="custom-control-label" for="is_active"><?= ($menu['is_active'] == 1) ? 'Enable' : 'Disable' ?></label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn text-white mb-3" style="background: linear-gradient(blue,black);">Save Change</button>
            </div>
        </form>
    </div>
</div>



<?= $this->endSection(); ?>
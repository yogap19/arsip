        <!-- Sidebar -->
        <?php
        $role_id = session()->get('role_id');
        if ($role_id == 1) {
            $icon = 'logo_1b.png';
            $color = 'blue';
        } elseif ($role_id == 2) {
            $icon = 'logo_2b.png';
            $color = 'red';
        } else {
            $icon = 'logo_3b.png';
            $color = 'black';
        }
        ?>
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background: linear-gradient(<?= $color; ?>, Black);" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('User'); ?>">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div> -->
                <div class="sidebar-brand-text"><img class="rounded-circle" src="<?= base_url('/img/icon/' . $icon); ?>" alt="" width="50px" height="50px"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- looping menu -->
            <?php $db = \Config\Database::connect(); ?>
            <!-- Query menu -->
            <?php

            $menua = $db->table('user_menu')
                ->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id')
                ->where('user_access_menu.role_id = ' . $role_id)
                ->get()->getResultArray();
            ?>
            <?php foreach ($menua as $key => $m) : ?>
                <div class="sidebar-heading">
                    <?= $m['menu']; ?>
                </div>
                <!-- Divider -->

                <?php
                $menuid = $m['menu_id'];
                $subm = $db->table('user_menu')
                    ->join('user_sub_menu', 'user_sub_menu.menu_id = user_menu.id')
                    ->where('user_sub_menu.menu_id = ' . $menuid)->having('user_sub_menu.is_active = 1')
                    ->get()->getResultArray();

                ?>
                <!-- looping submenu -->
                <?php foreach ($subm as $key => $sm) : ?>
                    <?php if ($title == $sm['title']) : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item ">
                        <?php endif; ?>
                        <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                            <i class="<?= $sm['icon']; ?>"></i>
                            <span><?= $sm['title']; ?></span></a>
                        </li>
                    <?php endforeach; ?>
                    <hr class="sidebar-divider ">
                    <!-- Query sub menu -->
                <?php endforeach; ?>
                <!-- Heading -->



                <!-- Nav Item - Edit Profile -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

        </ul>
        <!-- End of Sidebar -->
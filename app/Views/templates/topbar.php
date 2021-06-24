                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <?php if ($title == 'Dashboard') : ?>
                        <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?= base_url('SuperAdmin/index'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Cari dengan NIM..." aria-label="Search" aria-describedby="basic-addon2" name="search" id="search" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                                <div class="input-group-append">
                                    <button class="btn text-white" style="background: linear-gradient(blue,black);" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form> -->
                    <?php endif; ?>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
                                <?php if ($user['image'] == 'default.svg') : ?>
                                    <img class="img-profile rounded-circle" src="<?= base_url(); ?>/img/<?= ($user['gender'] == '1') ? 'boy.svg' : 'girl.svg'; ?>">
                                <?php else : ?>
                                    <img class="img-profile rounded-circle" src="<?= base_url(); ?>/img/<?= $user['image']; ?>">
                                <?php endif; ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('User'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
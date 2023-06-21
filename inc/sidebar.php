<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start">
                <a href="index.php?nav=<?= base64_encode('home') ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <?php if ($getRoleAdmin >= 1) :
                foreach (array_unique($parents) as  $p) :
                    $unique_parent = fetchRecord($dbc, "menus", "id", $p);
            ?>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="<?= $unique_parent['icon'] ?>"></i>
                            <span class="title"><?= ucwords($unique_parent['title']) ?></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <?php foreach ($files as  $value) :
                                $filename = $value . ".php";
                                $q = mysqli_query($dbc, "SELECT * FROM menus WHERE parent_id='$p' AND page='$filename'");
                                if (mysqli_num_rows($q) == 1) :
                                    $navigation = fetchRecord($dbc, "menus", "page", $filename);
                                    if (empty($navigation['parent_id']) and $navigation['page'] == "#") {
                                        continue;
                                    }
                            ?>
                                    <li class="nav-item">
                                        <a href="index.php?nav=<?= base64_encode($value) ?>" class="nav-link ">
                                            <i class="<?= $navigation['icon'] ?>"></i>
                                            <span class="title"><?= ucwords($navigation['title']) ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($getRoleEmployee >= 1) :
                foreach (array_unique($parents) as  $p) :
                    $unique_parent = fetchRecord($dbc, "menus", "id", $p);
            ?>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="<?= $unique_parent['icon'] ?>"></i>
                            <span class="title"><?= ucwords($unique_parent['title']) ?></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <?php foreach ($files as  $value) :
                                $filename = $value . ".php";
                                $q = mysqli_query($dbc, "SELECT * FROM menus WHERE parent_id='$p' AND page='$filename'");
                                if (mysqli_num_rows($q) == 1) :
                                    $navigation = fetchRecord($dbc, "menus", "page", $filename);
                                    if (empty($navigation['parent_id']) and $navigation['page'] == "#") {
                                        continue;
                                    }
                            ?>
                                    <li class="nav-item">
                                        <a href="index.php?nav=<?= base64_encode($value) ?>" class="nav-link ">
                                            <i class="<?= $navigation['icon'] ?>"></i>
                                            <span class="title"><?= ucwords($navigation['title']) ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
            <?php endforeach;
            endif; ?>
            <li class="nav-item">
                <a href="index.php?nav=<?= base64_encode('profile') ?>&business=<?= @$_SESSION['business'] ?>" class="nav-link">
                    <i class="fa fa-cog"></i>
                    <span class="title">
                        Account Settings
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                    <i class="fa fa-power-off"></i>
                    <span class="title">
                        Logout
                    </span>
                </a>
            </li>

        </ul>
    </div>
</div>
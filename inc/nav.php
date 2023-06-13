<?php if (!empty($_REQUEST['nav'])) {

  $get_nav = base64_decode($_REQUEST['nav']);
} else {

  $get_nav = 'home';
}

$page = "pages/" . $get_nav . ".php";

?>

<div class="page-header navbar navbar-fixed-top">

  <div class="page-header-inner ">
    <a href="index.php?nav=<?= base64_encode('home') ?>">
      <div class="page-logo" style="background-color: #ffffff;">
        <span class="text-logo">Dossier </span>
      </div>
    </a>
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse" style="color:black"><i class="fa fa-align-justify"></i> </a>
    <div class="page-top">
      <i class="fa fa-align-justify menu-toggler sidebar-toggler pull-left" style="font-size:18px;margin-left:1%"></i>
      <div class="top-menu">
        <ul class="nav navbar-nav pull-right">

          <li class="nav-item dropdown">

            <a href="#modal-id-video-tutorial" data-toggle="modal" class="dropdown-toggle" ta-hover="dropdown" data-close-others="true"><i class="fa fa-video-camera"></i> See Tutorial</a>

          </li>







          <li class=" dropdown">

            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

              <i class="fa fa-bell"></i>

            </a>

            <ul class="dropdown-menu dropdown-menu-default notifcation">

              <?php $getNotifications = mysqli_query($dbc, "SELECT * FROM notifications WHERE user_id='$fetchUser[user_id]' ORDER BY id DESC LIMIT 5");

              while ($fetchNotifications = mysqli_fetch_assoc($getNotifications)) :

              ?>

                <li>

                  <a href="index.php?nav=<?= @base64_encode('notifications') ?>&business=<?= @($_REQUEST['business']) ?>" class="dropdown-item">

                    <b><?php echo ucwords($fetchNotifications['type']); ?></b> <br>

                    <?= substr(ucwords($fetchNotifications['text']), 0, 20) ?>... <i class="fa fa-link ml-2 "></i>

                  </a>

                </li>



              <?php endwhile; ?>

              <hr>

              <li>

                <a href="index.php?nav=<?= @base64_encode('notifications') ?>&business=<?= @($_REQUEST['business']) ?>" class="dropdown-item text-center">

                  See All Notifications

                </a>

              </li>

            </ul>

          </li>

          <li style="margin-top: 9px;">

            <a class="nav-link text-danger" href="logout.php"> <i class="fa fa-power-off"></i> Logout</a>

          </li>

        </ul>

      </div>

    </div>

  </div>

</div>
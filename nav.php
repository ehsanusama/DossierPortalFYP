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
        <img class="logo-default" src="https://www.attendezz.com/img/logo.png" alt="logo" style="width:60px;height:60px;margin-top:2px" />
        <span class="text-logo" >Attendezz</span>
        <img class="logo-mini" src="https://www.attendezz.com/img/logo.png" alt="logo" style="width:60px;height:60px;margin-top:2px" />
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

          <?php if ($getRoleEmployee == 0) : ?>

            <li class="dropdown dropdown-user">

              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                <?php if (!empty($fetchBusinessData['business_logo'])) : ?>

                  <img src="img/<?= $fetchBusinessData['business_logo'] ?>" class="img img-responsive center-block pull-left mb-3 mr-1" width="24" height="24" alt="" id="aImgShow">

                <?php else : ?>

                  <i class="fa fa-cube"></i>

                <?php endif; ?>

                <?= @(empty($fetchBusinessData['business_name'])) ? 'Select Business' : ucwords(@$fetchBusinessData['business_name']) ?>



              </a>

              <ul class="dropdown-menu dropdown-menu-default">

                <?php $getBusiness = mysqli_query($dbc, "SELECT * FROM business WHERE user_id='$fetchUser[user_id]'");

                while ($fetchBusiness = mysqli_fetch_assoc($getBusiness)) :

                ?>

                  <li>

                    <a href="index.php?nav=<?= @$_REQUEST['nav'] ?>&business=<?= base64_encode($fetchBusiness['business_id']) ?>" class="dropdown-item">

                      <?php if (!empty($fetchBusiness['business_logo'])) : ?>

                        <img src="img/<?= $fetchBusiness['business_logo'] ?>" class="img img-responsive center-block pull-left mr-2" width="28" height="28" alt="" id="aImgShow">

                      <?php else : ?>

                        <i class="fas fa-cube mr-2"></i>

                      <?php endif; ?>

                      <?= @ucwords($fetchBusiness['business_name']) ?>

                      <?php if (@$fetchBusinessData['business_id'] == @$fetchBusiness['business_id']) : ?>

                        <span class="float-right text-muted text-sm"><span class="fa fa-check"></span></span>

                      <?php endif; ?>

                    </a>

                  </li>

                <?php endwhile; ?>

              </ul>

            </li>

          <?php endif; ?>



          <li class="nav-item dropdown">

            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

              <i class="fa fa-qrcode"></i>

            </a>

            <ul class="dropdown-menu dropdown-menu-default">

              <li>

                <a href="">

                  <span class="fa fa-qrcode"> </span> Mark Attendance</span>

                </a>

              </li>

              <li><a href="#qr-modal" class="qr-modal-btn dropdown-item" data-toggle="modal" title="start_shift">Checked In </a></li>

              <li> <a href="#qr-modal" class="qr-modal-btn dropdown-item" data-toggle="modal" title="end_shift">Checked Out </a></li>
              <hr>
              <li><a href="#qr-modal" class="qr-modal-btn dropdown-item" data-toggle="modal" title="start_break">Start Break </a></li>
              <li><a href="#qr-modal" class="qr-modal-btn dropdown-item" data-toggle="modal" title="end_break">End Break </a></li>

            </ul>

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
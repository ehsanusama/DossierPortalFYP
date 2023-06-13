<?php include_once "inc/functions.php";
if (!isset($_COOKIE['user_login'])) {
  header('location:login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "inc/head.php"; ?>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
  <?php include_once("inc/nav.php"); ?>
  <div class="page-container">
    <?php include_once("inc/sidebar.php"); ?>
    <div class="page-content-wrapper">
      <div class="page-content">
        <div class="portlet-body">
          <span class="response"></span>
          <?php getMessage(@$msg, @$sts); ?>
        </div>
        <?php if ($fetchUser['is_verify'] == "no") : ?>
          <div class="alert alert-warning text-center">Your account is not verified yet. <a id="verify-link" href="!#" title="<?= base64_encode($fetchUser['user_email']) ?>" class="text-primary">Click here to verify</a></div>
        <?php endif; ?>
        <?php include_once $page; ?>
        <div class="sticky-response"></div>
      </div>
    </div>
    <?php include_once "inc/foot.php"; ?>
  </div>

</body>

</html>
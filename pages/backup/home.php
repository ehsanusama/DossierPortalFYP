<style>
    .home-card:hover {
        background-color: #284b64 !important;
        color: #ffffff !important;
    }
</style>
<div class="portlet-light">
    <?php if ($getRoleEmployee >= 1) : ?>
        <div class="portlet-body">
            <center>
                <table class="table">
                    <tr class="text-center">
                        <th colspan="2" style="">
                            <h2>Staff/Employee Shift</h2>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <center>
                                <a href="#qr-modal" class="qr-modal-btn" data-toggle="modal" title="start_shift">
                                    <div class="portlet-body bg-success col-6 text-center" style="height: 51px;padding: 14px;">
                                        <div class="card-body text-white">
                                            <b>Checked In</b>
                                        </div><!-- card body -->
                                    </div><!-- card -->
                                </a>
                            </center>
                        </th>
                        <th>
                            <center>
                                <a href="#qr-modal" class="qr-modal-btn" data-toggle="modal" title="end_shift">
                                    <div class="portlet-body bg-danger col-6 text-center" style="height: 51px;padding: 14px;">
                                        <div class="card-body text-white">
                                            <b>Checked Out</b>
                                        </div><!-- card body -->
                                    </div><!-- card -->
                                </a>
                            </center>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th colspan="2" style="">
                            <h2>Staff/Employee Break</h2>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <center>
                                <a href="#qr-modal" class="qr-modal-btn" data-toggle="modal" title="start_break">
                                    <div class="portlet-body bg-success col-6 text-center" style="height: 51px;padding: 14px;">
                                        <div class="card-body text-white">
                                            <b>Start Break </b>
                                        </div><!-- card body -->
                                    </div><!-- card -->
                                </a>
                            </center>
                        </th>
                        <th>
                            <center>
                                <a href="#qr-modal" class="qr-modal-btn" data-toggle="modal" title="end_break">
                                    <div class="portlet-body bg-danger col-6 text-center" style="height: 51px;padding: 14px;">
                                        <div class="card-body text-white">
                                            <b>End Break</b>
                                        </div><!-- card body -->
                                    </div><!-- card -->
                                </a>
                            </center>
                        </th>
                    </tr>
                </table>
            </center>

        </div><!-- container -->

    <?php else : ?>

        <?php if (!empty($_SESSION['business'])) : ?>

            <div class="portlet-body">

                <div class="row">

                    <?php foreach (array_unique($parents) as  $p) :

                        $unique_parent = fetchRecord($dbc, "menus", "id", $p);

                    ?>

                        <div class="col-sm-4 text-center">

                            <div class="portlet-body home-card" style="height: 120px;background-color:white;margin-top:5px; box-shadow: 0px 10px 50px rgba(40, 75, 100, 0.1); color: #284b64;">
                                <div class="btn-group pull-left">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fa fa-ellipsis-v"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-default">
                                        <?php foreach ($files as  $value) :
                                            $filename = $value . ".php";
                                            $q = mysqli_query($dbc, "SELECT * FROM menus WHERE parent_id='$p' AND page='$filename'");
                                            if (mysqli_num_rows($q) == 1) :
                                                $navigation = fetchRecord($dbc, "menus", "page", $filename);
                                                if (empty($navigation['parent_id']) and $navigation['page'] == "#") {
                                                    continue;
                                                }
                                        ?>
                                                <li> <a class="dropdown-item modal-action" href="index.php?nav=<?= base64_encode($value) ?>&business=<?= @$_SESSION['business'] ?>"><span class="<?= $navigation['icon'] ?>"></span> <?= ucwords($navigation['title']) ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <strong class="text-center" style="font-size: 1.5em;font-weight: 700;">
                                    <span class="<?= $unique_parent['icon'] ?>" style="margin-top:12%;"></span>
                                    <?= ucwords($unique_parent['title']) ?>
                                </strong>

                            </div><!-- card body -->



                        </div><!-- col -->



                    <?php endforeach; ?>

                </div><!-- row -->

                <br><br>

                <div class="hidden" style="font-size: 13px">

                    <div class="card-header">

                        <h3 class="card-title text-center">Quick Attendance Report</h3>

                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">

                                <i class="fas fa-minus"></i></button>

                        </div>

                    </div>

                    <div class="<?php if (empty($_REQUEST['dated'])) {

                                    echo "";
                                } ?>">

                        <form action="" method="get">

                            <input type="hidden" name="nav" value="<?= @$_REQUEST['nav'] ?>">

                            <input type="hidden" name="business" value="<?= @$_REQUEST['business'] ?>">

                            <?php $currentDate = empty($_REQUEST['dated']) ? date('d-F-Y') : $_REQUEST['dated']; ?>

                            <h3 class="text-center"><input type="text" onchange="form.submit()" autocomplete="off" class="dateField" name="dated" style="border:none" value="<?= @$currentDate ?>"></h3>

                            <div class="row">

                                <?php $getBusinessUsers = getUserByBusiness($dbc, base64_decode($_SESSION['business']));

                                $business_id = base64_decode($_SESSION['business']);

                                foreach ($getBusinessUsers as $emp) :

                                    $_REQUEST['emp_id'] = $emp['user_id'];

                                    if (!empty($emp['user_pic'])) {

                                        $pic = $emp['user_pic'];
                                    } else {

                                        $pic = "default.png";
                                    }

                                    $dated = date('Y-m-d', strtotime($currentDate));

                                    $fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);

                                    $getTimeOff = mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND att_date='$dated' AND status='leave'");

                                    if (mysqli_num_rows($getTimeOff) >= 1) {

                                        $fetchTimeOff = mysqli_fetch_assoc($getTimeOff);
                                    }

                                    $day = date('l', strtotime($dated));

                                    @$getStartShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                    @$getEndShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                    @$getStartBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                    @$getEndBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                    @$getDeviceStart = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND  emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND shift='start_shift'"));

                                    @$getDeviceEnd = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND  emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND shift='end_shift'"));

                                    @$getTracking = (mysqli_query($dbc, "SELECT * FROM tracking WHERE dated='$dated' AND  user_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                    $hour_shift = $hour_break = '';

                                    $icons = [

                                        'card_scan' => "id-card",

                                        "phone_scan" => "mobile",

                                        'manual' => 'pencil',

                                    ];

                                    if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time'])) {

                                        $hour_shift = number_format(differenceInHours($getStartShift['att_time'], $getEndShift['att_time']), 2);
                                    }

                                    if (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time'])) {

                                        $hour_break = number_format(differenceInHours($getStartBreak['att_time'], $getEndBreak['att_time']), 2);
                                    }

                                ?>

                                    <div class="col-sm-4">

                                        <div class="portlet light">

                                            <div class="portlet-body">

                                                <center>

                                                    <img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle mb-1" width="40" height="40"> <br>

                                                    <strong>ID#: <?= strtoupper($emp['user_id']) ?> </strong> <br>

                                                    <strong><?= strtoupper($emp['user_first_name']) ?> <?= strtoupper($emp['user_last_name']) ?></strong> <br>

                                                </center>

                                                <hr>

                                                <?php if (!empty($fetchTimeOff) and mysqli_num_rows($getTimeOff) >= 1) : ?>

                                                    <div class="alert alert-warning text-center">

                                                        Time Off <br>

                                                        Reason: <?= @strtoupper($fetchTimeOff['reason']) ?>

                                                    </div>

                                                <?php else : ?>

                                                    <table class="table table-bordered table-condensed myTable" style="font-size: 11px">

                                                        <tr>

                                                            <th>CheckIn</th>

                                                            <td class="text-right"><?php if (!empty($getStartShift['att_time'])) {

                                                                                        echo date('h:i A', strtotime(@$getStartShift['att_time']));
                                                                                    } else {

                                                                                        echo "-";
                                                                                    }

                                                                                    echo "<br><span class='fa fa-" . $icons[$getDeviceStart['device']] . "'></span>";

                                                                                    ?>



                                                            </td>

                                                            <th>Break Start</th>

                                                            <td class="text-right"><?php if (!empty($getStartBreak['att_time'])) {

                                                                                        echo date('h:i A', strtotime(@$getStartBreak['att_time']));
                                                                                    } else {

                                                                                        echo "-";
                                                                                    } ?></td>



                                                        </tr>

                                                        <tr>

                                                            <th>CheckOut</th>

                                                            <td class="text-right"><?php if (!empty($getEndShift['att_time'])) {

                                                                                        echo date('h:i A', strtotime(@$getEndShift['att_time']));
                                                                                    } else {

                                                                                        echo "-";
                                                                                    }

                                                                                    echo "<br><span class='fa fa-" . $icons[$getDeviceEnd['device']] . "'></span>";

                                                                                    ?></td>

                                                            <th>Break End</th>

                                                            <td class="text-right"><?php if (!empty($getEndBreak['att_time'])) {

                                                                                        echo date('h:i A', strtotime(@$getEndBreak['att_time']));
                                                                                    } else {

                                                                                        echo "-";
                                                                                    } ?></td>



                                                        </tr>

                                                        <tr>

                                                            <th>Total Shift Time</th>

                                                            <td class="text-right">

                                                                <?php

                                                                if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time']) or (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time']))) {

                                                                    $totalHrs = ($hour_shift - $hour_break);

                                                                    if ($totalHrs < 0) {

                                                                        echo "Not Checked In/Checked out";
                                                                    } else {

                                                                        echo @($hour_shift - $hour_break) . " hr(s)";
                                                                    }
                                                                }

                                                                ?>

                                                            </td>

                                                            <th>Total Break Time</th>

                                                            <td class="text-right">

                                                                <?php if (!empty($hour_break)) {

                                                                    echo $hour_break . " hr(s)";
                                                                } else {

                                                                    echo "-";
                                                                } ?>

                                                            </td>



                                                        </tr>

                                                    </table>

                                                <?php endif; ?>

                                            </div><!-- body -->

                                        </div><!-- card -->

                                    </div><!-- col -->

                                <?php endforeach; ?>

                            </div><!-- row -->

                        </form>

                    </div><!-- card body -->

                </div><!-- card -->

                <div class="portlet light" style="font-size: 13px">

                    <div class="portlet-title">

                        <h3 class="caption-subject bold uppercase">Quick Attendance Report</h3>

                    </div>

                    <div class="portlet-body">
                        <div class="table-responsive panel panel-default panel-body">
                            <table class="table myTable table-bordered">

                                <tr>

                                    <th>Pic</th>

                                    <th>Details</th>

                                    <th>Check In</th>

                                    <th>Break Start</th>

                                    <th>Break End</th>

                                    <th>Check Out</th>

                                    <th>Break Time</th>

                                    <th>Total Time</th>

                                </tr>

                                <div class="<?php if (empty($_REQUEST['dated'])) {

                                                echo "";
                                            } ?>">

                                    <form action="" method="get">

                                        <input type="hidden" name="nav" value="<?= @$_REQUEST['nav'] ?>">

                                        <input type="hidden" name="business" value="<?= @$_REQUEST['business'] ?>">

                                        <?php $currentDate = empty($_REQUEST['dated']) ? date('d-F-Y') : $_REQUEST['dated']; ?>

                                        <h3 class="text-center"><input type="text" onchange="form.submit()" autocomplete="off" class="dateField" name="dated" style="border:none" value="<?= @$currentDate ?>"></h3>

                                        <div class="row">

                                            <?php $getBusinessUsers = getUserByBusiness($dbc, base64_decode($_SESSION['business']));

                                            $business_id = base64_decode($_SESSION['business']);

                                            foreach ($getBusinessUsers as $emp) :

                                                $_REQUEST['emp_id'] = $emp['user_id'];

                                                if (!empty($emp['user_pic'])) {

                                                    $pic = $emp['user_pic'];
                                                } else {

                                                    $pic = "default.png";
                                                }

                                                $dated = date('Y-m-d', strtotime($currentDate));

                                                $fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);

                                                $getTimeOff = mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND att_date='$dated' AND status='leave'");

                                                if (mysqli_num_rows($getTimeOff) >= 1) {

                                                    $fetchTimeOff = mysqli_fetch_assoc($getTimeOff);
                                                }

                                                $day = date('l', strtotime($dated));

                                                @$getStartShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                                @$getEndShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                                @$getStartBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                                @$getEndBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                                @$getDeviceStart = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND  emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND shift='start_shift'"));

                                                @$getDeviceEnd = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND  emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND shift='end_shift'"));

                                                @$getTracking = (mysqli_query($dbc, "SELECT * FROM tracking WHERE dated='$dated' AND  user_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

                                                $hour_shift = $hour_break = '';

                                                $icons = [

                                                    'card_scan' => "id-card",

                                                    "phone_scan" => "mobile",

                                                    'manual' => 'pencil',

                                                ];

                                                if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time'])) {

                                                    $hour_shift = number_format(differenceInHours($getStartShift['att_time'], $getEndShift['att_time']), 2);
                                                }

                                                if (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time'])) {

                                                    $hour_break = number_format(differenceInHours($getStartBreak['att_time'], $getEndBreak['att_time']), 2);
                                                }

                                            ?>

                                                <tr>

                                                    <td>

                                                        <a style="color: black" href="#modal-id" data-toggle="modal" title="load_staff_form|user_id|<?= @$emp['user_id'] ?>" class="modal-action">



                                                            <img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle mb-1" width="48" height="48" style="width:48px">

                                                        </a>

                                                    </td>

                                                    <td>

                                                        <strong>ID#: <?= strtoupper($emp['user_id']) ?> </strong> <br>

                                                        <strong><?= strtoupper($emp['user_first_name']) ?> <?= strtoupper($emp['user_last_name']) ?></strong>

                                                    </td>

                                                    <td><?php if (!empty($getStartShift['att_time'])) {

                                                            echo date('h:i A', strtotime(@$getStartShift['att_time']));
                                                        } else {

                                                            echo "-";
                                                        }

                                                        echo "<br><span class='fa fa-" . @$icons[$getDeviceStart['device']] . "'></span>";

                                                        ?>



                                                    </td>

                                                    <td><?php if (!empty($getStartBreak['att_time'])) {

                                                            echo date('h:i A', strtotime(@$getStartBreak['att_time']));
                                                        } else {

                                                            echo "-";
                                                        } ?></td>

                                                    <td><?php if (!empty($getEndBreak['att_time'])) {

                                                            echo date('h:i A', strtotime(@$getEndBreak['att_time']));
                                                        } else {

                                                            echo "-";
                                                        } ?></td>

                                                    <td><?php if (!empty($getEndShift['att_time'])) {

                                                            echo date('h:i A', strtotime(@$getEndShift['att_time']));
                                                        } else {

                                                            echo "-";
                                                        }

                                                        echo "<br><span class='fa fa-" . @$icons[$getDeviceEnd['device']] . "'></span>";

                                                        ?></td>

                                                    <td>

                                                        <?php if (!empty($hour_break)) {

                                                            echo $hour_break . " hr(s)";
                                                        } else {

                                                            echo "-";
                                                        } ?>

                                                    </td>

                                                    <td>

                                                        <?php

                                                        if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time']) or (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time']))) {

                                                            $totalHrs = ($hour_shift - $hour_break);

                                                            if ($totalHrs < 0) {

                                                                echo "Not Checked In/Checked out";
                                                            } else {

                                                                echo @($hour_shift - $hour_break) . " hr(s)";
                                                            }
                                                        }

                                                        ?>

                                                    </td>

                                                </tr>



                                            <?php endforeach; ?>

                            </table>
                        </div>
                    </div>

                </div><!-- row -->

                </form>

            </div><!-- card body -->

</div><!-- card -->

</div>

<?php else : ?>

    <?php $date = date('Y-m-d'); ?>

    <div class="portlet-body">

        <h2>Select Your Business</h2>

        <?php $getBusiness = mysqli_query($dbc, "SELECT * FROM business WHERE user_id='$fetchUser[user_id]'"); ?>

        <div class="row">

            <?php if (mysqli_num_rows($getBusiness) > 0) :
                while ($fetchBusniess = mysqli_fetch_assoc($getBusiness)) :
            ?>
                    <div class="col-md-4 col-sm-6 ">

                        <div style="height: 200px;">

                            <div class="portlet-body" style="background-color: white;border-top:5px solid #284b64;border-radius:5px">

                                <div class="btn-group">

                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <span class="fa fa-ellipsis-v"></span>

                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-default">

                                        <li> <a class="dropdown-item modal-action" href="#modal-id" data-toggle="modal" title="load_business_form|business_id|<?= $fetchBusniess['business_id'] ?>"><span class="fa fa-pencil"></span> Edit Information</a></li>

                                        <li> <a class="dropdown-item" href="index.php?nav=<?= base64_encode('business_qrcode') ?>&business=<?= base64_encode($fetchBusniess['business_id']) ?>"><span class="fa fa-qrcode"></span> Business QR Code</a></li>

                                        <li> <a class="dropdown-item" target="_blank" href="mark_attendance.php?business=<?= base64_encode($fetchBusniess['business_id']) ?>&period=<?= base64_encode($date) ?>"><span class="fa fa-camera"></span> Mark Attendance by Camera</a>

                                        </li>

                                        <hr>
                                        <li> <a class="dropdown-item text-danger" href="#!" onclick="deleteData('business','business_id',<?= $fetchBusniess['business_id'] ?>,'index.php?nav=<?= @$_REQUEST['nav'] ?>',this)" style="color:red"><span class="fa fa-remove text-danger"></span> Delete</a>
                                        </li>

                                    </ul>

                                </div>



                                <center>

                                    <b class="text-center">

                                        <?php if (!empty($fetchBusniess['business_logo'])) : ?>

                                            <img src="img/<?= $fetchBusniess['business_logo'] ?>" class="img img-responsive center-block mb-2" width="48" height="48" alt="" id="aImgShow">

                                        <?php else : ?>

                                            <span class="fa fa-cube fa-2x mb-2 ml-2 text-center"></span>

                                        <?php endif; ?>

                                        <br>

                                        <a href="index.php?nav=<?= @$_REQUEST['nav'] ?>&business=<?= base64_encode($fetchBusniess['business_id']) ?>"><?php echo ucwords(@$fetchBusniess['business_name']); ?></a>

                                    </b>

                                    <div class="form-group">

                                        <?php @$checked = (strtolower($fetchBusniess['business_status']) == "active" or strtolower($fetchBusniess['business_status']) == "enable") ? "checked" : ""; ?>

                                        <label class="switch">
                                            <input title="business|<?= $fetchBusniess['business_id'] ?>" type="checkbox" class="switch-btn" name="user_status" value="yes" <?= @$checked ?>>
                                            <span class="slider round"></span>
                                        </label>



                                    </div><!-- form group -->

                                </center>

                            </div>

                        </div>

                    </div>

            <?php endwhile;

            endif; ?>

            <!-- /.col-md-3 -->

            <div class="col-md-4 col-sm-6">

                <div style="height:140px;background-color: white;">

                    <div class="text-center mt-3">

                        <br><br>

                        <b>

                            <a class="modal-action text-secondary" href="#modal-id" data-toggle="modal" title="load_business_form|business_id|">

                                <span class="fa fa-plus-circle fa-2x mb-2"></span> <br>

                                Add new Business</a>

                        </b>

                    </div>

                </div>

            </div>



        </div>

        <!-- /.row -->

        <br> <br>

        <?php

            $getSubscription = mysqli_query($dbc, "SELECT * FROM subscription WHERE user_id='$fetchUser[user_id]' ORDER BY id DESC LIMIT 1");

            if (mysqli_num_rows($getSubscription) > 0) :

        ?>



            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12 pull-right">

                        <?php
                        while ($fetchSubscription = mysqli_fetch_assoc($getSubscription)) :
                            $fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchSubscription['user_id']);
                        ?>
                            <!-- <p class="text-muted">You are on the <b>Monthly Subscription</b> plan right now. Make a choice below to move to a different plan.</p> -->
                            <div class="project-state pull-right text-center" style="float: right;">
                                <h4>Account Subscription Status <span class="badge badge-success text-capitalize"><?= $fetchSubscription['status'] ?></span></h4>
                                <div class="progress progress-sm" style="height:52px;border-radius:40px !important;width:300px">
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width:<?= datePercentage($fetchSubscription['start_date'], $fetchSubscription['end_date']) . "%" ?>;padding: 14px;font-size: 16px;">
                                        Monthly Subscription <?= datePercentage($fetchSubscription['start_date'], $fetchSubscription['end_date']) ?>%
                                    </div>
                                </div>


                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>



        <?php endif; ?>

    </div>

<?php endif; ?>

<?php endif; ?>



<div class="modal fade" id="qr-modal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-body" id="qr-modal-body">

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>


<center style="position: fixed;bottom: 10px;right: 0">
    <a href="../attendezz.apk" download="">
        <img src="../img/download_apk.png" width="200" class="img img-responsive" alt="">
    </a>
</center>
</div>
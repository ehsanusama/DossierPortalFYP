<?php include_once("inc/smsModule.php"); ?>
<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class=''>
        <div class='portlet-body '>
            <div class="bg-dar w-100 text-center p-2 mt-5 ">
                <h1 class=''>Send SMS</h1>
            </div>
            <form method="POST" action='' style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id=''>
                <input type="hidden" name="action" value="addGroup" id='actionGrp'>
                <input type="hidden" name="id" id='groupID' value="">
                <div class="form-group">
                    <label for="smsTitle">SMS Title</label>
                    <input type="text" class="form-control smsTitle" id="text" placeholder="Enter SMS Title" required>
                </div>
                <div class="form-group">
                    <label for="email">MESSAGE</label>
                    <br>
                    <!-- required> -->
                    <textarea name="form-control" class="form-control smsMessage" placeholder="Enter Your Message" id="" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="email">Select Method</label>
                    <br>
                    <!-- required> -->
                    <select name="type" id="type" class="form-control" style="overflow: hidden;" required onchange="doSomething()">
                        <option value="sms">
                            By Sms
                        </option>
                        <option value="notification">
                            By Push Notification
                        </option>
                        <option value="both">
                            Both
                        </option>
                    </select>
                </div>
                <!-- Row -->
                <div class='row'>
                    <div class="form-group col-12 " id="contactDropDown">
                        <label for="group_name">Send To</label>
                        <form></form>
                        <div class="dropdown col-12">
                            <button class="w-100 btn dropdown-toggle border" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;">
                                Choose Contacts Or Groups
                            </button>
                            <form class="dropdown-menu w-100 p-4" aria-labelledby="dropdownMenuButton" style='height:400px;overflow-y:scroll'>
                                <label for=""><small>Groups</small></label>
                                <?php
                                $getGroups = mysqli_query($dbc, "SELECT * FROM smsgroups");
                                while ($fetchGroups = mysqli_fetch_assoc($getGroups)) { ?>
                                    <div>
                                        <?php if (!empty($fetchGroups['groupName'])   && $fetchGroups['sts'] === "active") {
                                            echo '<div class="mt-1 row container"><label class="dropdown-item col-6"><input data-type="group" id="smsGroup" style="margin-left:10px" type="checkbox" value=' . $fetchGroups['id'] . '><span style="padding:3px;"></span>' . ucwords($fetchGroups['groupName']) . '</label><div  class="' . $fetchGroups['id'] . 'groupDiv col-6"></div></div>';
                                        }; ?>
                                    </div>
                                <?php } ?>
                                <label for=""><small>Contacts</small></label>
                                <?php
                                $getContact = mysqli_query($dbc, "SELECT * FROM smscontact");
                                while ($fetchContact = mysqli_fetch_assoc($getContact)) { ?>
                                    <div>
                                        <?php if (!empty($fetchContact['phone'])) {
                                            echo '<label class="dropdown-item"><input data-type="contact" style="margin-left:10px" type="checkbox" name="" value=' . $fetchContact['phone'] . '><span style="padding:3px;"></span>' . ucwords($fetchContact['FirstName']) . " " . ucwords($fetchContact['LastName']) . '</label>';
                                        }; ?>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                    <button id="sendSMS" type="button" id='addGroup' class="btn btn-primary ml-2 ">Send Message</button>
                </div>
            </form>
        </div>
        <br>
        <!-- SMS Message Section -->
        <div style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%'>
            <div class="portlet-body">

                <form action="" method="POST" class="horizontal-form">
                    <div class="row">
                        <div class="col-md-7">
                            <h1>SMS</h1>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <div class="form-group  bg-primary ">
                                <input type="search" name="searchBy" id="search" class="form-control" placeholder="Number, Title" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button name="searchByBtn" type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>

                </form>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Message</th>
                                <th scope="col">Number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_REQUEST['searchByBtn'])) {
                                $searchBy = $_REQUEST['searchBy'];
                                $sql = "SELECT * FROM sms where type = 'sms' AND title like '%$searchBy' OR  phone like '%$searchBy'";
                            } else {
                                $sql = "SELECT * FROM sms where type = 'sms'";
                            }
                            $i = 1;
                            $q = mysqli_query($dbc, $sql);
                            while ($row = mysqli_fetch_assoc($q)) : ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['msg'] ?></td>
                                    <td><?php echo $row['phone'] ?></td>
                                    <td><?php echo ucwords($row['sts']) ?></td>
                                    <td><?php echo ucwords($row['type']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
        <!--@ SMS Message Section -->
        <br>
        <!-- Notfication Message Section -->
        <div style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%'>
            <div class="portlet-body">
                <div class="card-title w-100  text-white mb-2 px-3 ">
                    <h1>Notifications</h1>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Message</th>
                                <th scope="col">Status</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $q = mysqli_query($dbc, "SELECT * FROM sms where type = 'notification'");
                            while ($row = mysqli_fetch_assoc($q)) : ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['msg'] ?></td>
                                    <td><?php echo ucwords($row['sts']) ?></td>
                                    <td><?php echo ucwords($row['type']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
        <!--@ Notfication Message Section -->
    </div>
</div>
<!-- Sweet Alert Script -->
<!-- <script src="js/jquery.js"></script> -->
<script src="js/smsModule.js"></script>
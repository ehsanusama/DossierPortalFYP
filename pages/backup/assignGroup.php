<?php
include_once("inc/smsModule.php");


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./bootstrap/css/bootstrap.css"> -->
    <!-- Sweet Alert CDN -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    </link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Document</title>
    <style>
        dropdown-menu label {
            display: block;
        }
    </style>

</head>

<body>
    <div class='portlet light'>
        <div class='portlet-body'>
            <h1 class='w-100 text-center py-2 mt-5'>Assign Group To Contacts</h1>
            <div class='card-body m-auto'>
                <form class='card p-5' method="POST" action='' style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id=''>
                    <input type="hidden" name="action" value="addGroup" id='actionGrp'>
                    <input type="hidden" name="id" id='groupID' value="">
                    <!-- Row -->
                    <div class='row container'>
                        <div class="col-6">
                            <label for="group_name">Choose Group</label>
                            <br>
                            <select name="" id="groupName" style='border:1px lightgray solid;border-radius:4px;padding:8px;width:100%;outline:none'>
                                <option value="" selected>Choose Group</option>
                                <?php
                                $getGroup = mysqli_query($dbc, "SELECT * FROM smsgroups");
                                while ($fetchGroup = mysqli_fetch_assoc($getGroup)) { ?>
                                    <div>
                                        <?php
                                        if (!empty($fetchGroup['groupName'])) {
                                            echo '<option value=' . $fetchGroup['id'] . '>' . $fetchGroup['groupName'] . '</option>';
                                        }; ?>
                                    </div>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-6 ">
                            <label for="group_name">Choose Group</label>
                            <form></form>
                            <div class="dropdown col-6 ">
                                <button class="btn dropdown-toggle border" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Choose Contacts
                                </button>
                                <form class="dropdown-menu" aria-labelledby="dropdownMenuButton" style='height:200px;overflow-y:scroll'>
                                    <?php
                                    $getContact = mysqli_query($dbc, "SELECT * FROM smscontact");
                                    while ($fetchContact = mysqli_fetch_assoc($getContact)) { ?>
                                        <div>
                                            <?php if (!empty($fetchContact['phone'])) {
                                                echo '<label class="dropdown-item"><input  style="margin-left:10px" type="checkbox" name="" value=' . $fetchContact['id'] . '><span style="padding:3px;"></span>' . ucwords($fetchContact['FirstName'] . " " . $fetchContact['LastName']) . '</label>';
                                            }; ?>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                        <button id="assignGroup" type="button" id='addGroup' class="btn btn-primary ml-2 ">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sweet Alert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="js/smsModule.js"></script>
</body>

</html>
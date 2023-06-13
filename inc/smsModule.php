<?php
// $dbc = mysqli_connect("localhost", "root", "", "noazeye");
// if(!$dbc){
// echo "Database is not available";
// exit();
// }
include_once("functions.php");
function getAllContact($dbc)
{
    $getContact = mysqli_query($dbc, "SELECT * FROM smscontact");
    $contacts = "";
    $i = 1;
    while ($fetchContact = mysqli_fetch_assoc($getContact)) {
        $timestamp = strtotime($fetchContact["timestamp"]);
        $date =  date("d-M-Y", $timestamp);
        $sts = ($fetchContact["sts"] === "activate") ? "deactivate" : "activate";
        $contacts .= '
            <tr>
                <th scope="row">' . $i . '</th>
                <td><small>' . $fetchContact["FirstName"] . '</small></td>
                <td><small>' . $fetchContact["LastName"] . '</small> </td>
                <td><small>' . $fetchContact["email"] . '</small></td>
                <td><small>' . $fetchContact["phone"] . '</small></td>
                <td><small>' . $date . '</small></td>
                <td><small>' . $fetchContact["sts"] . '</small></td>
                <td>
                    <button type="button" value=' . $fetchContact["id"] . ' id="delCxt" name="del_User" class=" btn btn-error btn-sm">Delete</button>
                </td>
                <td>
                    <button type="button" value=' . $fetchContact["id"] . ' id="editCxt" name="del_User" class=" btn btn-info btn-sm">Edit</button>
                </td>
                <td>
                        <button type="submit" name="sts" id="changeSts" class="text-white  btn btn-warning btn-sm" value=' . $fetchContact["id"] . '>' . $fetchContact["sts"] . '</button>
                </td>
            </tr>';
        $i = $i + 1;
    }
    return $contacts;
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] === "getAllContact") {
    echo getAllContact($dbc);
    exit();
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] === "addContact") {
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $ifExist = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM smscontact where phone = '$phone'"));
    if ($ifExist === 0) {
        $addContact = mysqli_query($dbc, "INSERT INTO smscontact(FirstName, LastName, email, phone) VALUES('$first_name', '$last_name', '$email', '$phone')");
        if ($addContact) {
            $contacts = getAllContact($dbc);
            $sts = "success";
            echo json_encode(array($sts, $contacts));
            exit();
        } else {
            $contacts = getAllContact($dbc);
            $sts = "error";
            $msg = mysqli_error($dbc);
            echo json_encode(array($sts, $contacts, $msg));
            exit();
        }
    } else {
        $contacts = getAllContact($dbc);
        $sts = "error";
        $msg = "User Already exist";
        echo json_encode(array($sts, $contacts, $msg));
        exit();
    }
}



if (isset($_REQUEST['action']) && $_REQUEST['action'] === "updateCxt") {
    @$id = $_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $updateCxt = mysqli_query($dbc, "UPDATE smscontact set FirstName = '$first_name',  LastName = '$last_name', email = '$email', phone = '$phone' WHERE id = '$id'");
    if ($updateCxt) {
        $contacts = getAllContact($dbc);
        $sts = "success";
        echo json_encode(array($sts, $contacts));
        exit();
    } else {
        $contacts = getAllContact($dbc);
        $sts = mysqli_error($dbc);
        echo json_encode(array($sts, $contacts));
        exit();
    }
}



if (isset($_REQUEST['action']) && $_REQUEST['action'] === "delContact") {
    $contactID = $_REQUEST['contactID'];
    $delContact = mysqli_query($dbc, "DELETE FROM smscontact WHERE id = '$contactID'");
    if ($delContact) {
        $contacts = getAllContact($dbc);
        $sts = "success";
        echo json_encode(array($sts, $contacts));
        exit();
    } else {
        $contacts = getAllContact($dbc);
        $sts = "error";
        echo json_encode(array($sts, $contacts));
        exit();
    }
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] === "changeSts") {
    $contactID = $_REQUEST['contactID'];

    if ($_REQUEST['sts'] === 'active') {
        $sts = "deactive";
    } else {
        $sts = "active";
    }
    $updateSts = mysqli_query($dbc, "UPDATE smscontact set sts = '$sts' where id = '$contactID'");
    if ($updateSts) {
        $contacts = getAllContact($dbc);
        $sts = "success";
        echo json_encode(array($sts, $contacts));
        exit();
    } else {
        $contacts = getAllContact($dbc);
        $sts = "error";
        echo json_encode(array($sts, $contacts));
        exit();
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] === "editCxt") {
    $contactID = $_REQUEST['contactID'];
    $getUser = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM smscontact where id = '$contactID'"));
    if ($getUser) {
        // echo json_encode($getUser);
        // $contacts = getAllContact($dbc);
        $sts = "success";
        echo json_encode(array($sts, $getUser));
        exit();
    } else {
        // $contacts = getAllContact($dbc);
        $sts = "error";
        echo $sts;
        // echo json_encode(array($sts, $contacts));
        exit();
    }
}


/*===============================
            Groups Code  
 ================================*/

function getAllGroups($dbc)
{
    $getGroups = mysqli_query($dbc, "SELECT * FROM smsgroups");
    $groups = "";
    $i = 1;
    while ($fetchGroups = mysqli_fetch_assoc($getGroups)) {
        $timestamp = strtotime($fetchGroups["timestamp"]);
        $date =  date("d-M-Y", $timestamp);
        $sts = ($fetchGroups["sts"] === "active") ? "deactive" : "active";
        $groups .= '
            <tr>
                <th scope="row">' . $i . '</th>
                <td><small>' . $fetchGroups["groupName"] . '</small></td>
                <td><small>' . $date . '</small></td>
                <td><small>' . $fetchGroups["sts"] . '</small></td>
                <td>
                    <button type="button" value=' . $fetchGroups["id"] . ' id="delGrp" name="del_User" class=" btn btn-error btn-sm">Delete</button>
                </td>
                <td>
                    <button type="button" value=' . $fetchGroups["id"] . ' id="editGrp" name="del_User" class=" btn btn-info btn-sm">Edit</button>
                </td>
                <td>
                        <button type="submit" name="sts" id="changeGrpSts" class="text-white  btn btn-warning btn-sm" value=' . $fetchGroups["id"] . '>' . $fetchGroups["sts"] . '</button>
                </td>
            </tr>';
        $i = $i + 1;
    }
    return $groups;
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] === "getAllGroups") {
    echo  getAllGroups($dbc);
    exit();
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] === "addGroup") {
    $groupName = $_REQUEST['group_name'];
    $ifExist = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM smsgroups where groupName = '$groupName'"));
    if ($ifExist === 0) {
        $addGroup = mysqli_query($dbc, "INSERT INTO smsgroups(groupName) VALUE('$groupName')");
        if ($addGroup) {
            $msg = "Group Added Successfully";
            $groups = getAllGroups($dbc);
            $sts = "success";
            echo json_encode(array($msg, $sts, $groups));
            exit();
        } else {
            $msg = "Unable to add Group";
            $groups = getAllGroups($dbc);
            $sts = "error";
            echo json_encode(array($msg, $sts, $groups));
            exit();
        }
    } else {
        $msg = "Group Already Exist";
        $groups = getAllGroups($dbc);
        $sts = "error";
        echo json_encode(array($msg, $sts, $groups));
        exit();
    }
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] === "delGroup") {
    $id = $_REQUEST['id'];
    $delGroup = mysqli_query($dbc, "DELETE FROM smsgroups WHERE id = '$id'");
    if ($delGroup) {
        $msg = "Groups has been deleted";
        $groups = getAllGroups($dbc);
        $sts = "success";
        echo json_encode(array($msg, $sts, $groups));
        exit();
    } else {
        $msg = "Unable to delete group try again";
        $groups = getAllGroups($dbc);
        $sts = "error";
        echo json_encode(array($msg, $sts, $groups));
        exit();
    }
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] === "changeGrpSts") {
    $id = $_REQUEST['id'];
    if ($_REQUEST['sts'] === 'active') {
        $sts = "deactive";
    } else {
        $sts = "active";
    }
    $updateSts = mysqli_query($dbc, "UPDATE smsgroups set sts = '$sts' where id = '$id'");
    if ($updateSts) {
        $msg = "Status Updated";
        $groups = getAllGroups($dbc);
        $sts = "success";
        echo json_encode(array($msg, $sts, $groups));
        exit();
    } else {
        $msg = "Unable to Update Status try again";
        $groups = getAllGroups($dbc);
        $sts = "error";
        echo json_encode(array($msg, $sts, $groups));
        exit();
    }
}


/* edit group */
if (isset($_REQUEST['action']) && $_REQUEST['action'] === "editGrp") {
    $id = $_REQUEST['id'];
    $getGroup = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM smsgroups where id = '$id'"));
    if ($getGroup) {
        $msg = "Group Data";
        $group = $getGroup;
        $sts = "success";
        echo json_encode(array($msg, $sts, $group));
        exit();
    } else {
        $msg = "unable to edit group";
        $sts = "error";
        echo $sts;
        exit();
    }
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] === "updateGrp") {
    @$id = $_REQUEST['id'];
    @$groupName = $_REQUEST['group_name'];
    $updateGrp = mysqli_query($dbc, "UPDATE smsgroups set groupName = '$groupName' WHERE id = '$id'");
    if ($updateGrp) {
        $msg = "Group Name Updated";
        $groups = getAllGroups($dbc);
        $sts = "success";
        echo json_encode(array($msg, $sts, $groups));
        exit();
    } else {
        $msg = "Unable to Update Group Name try again";
        $groups = getAllGroups($dbc);
        $sts = "error";
        echo json_encode(array($msg, $sts, $groups));
        exit();
    }
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] === "assignContact") {
    $contactList = $_REQUEST['contactList'];
    $groupId = $_REQUEST["groupId"];
    $error = false;
    $exist = "";
    foreach ($contactList as $key => $contact) {
        $ifExist = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_groups where group_id = '$groupId' AND  contact_id = '$contact'"));
        if ($ifExist === 0) {
            $assignGroup = mysqli_query($dbc, "INSERT INTO assign_groups(group_id, contact_id) VALUES('$groupId', '$contact')");
            if ($assignGroup) {
                $error = true;
            } else {
                $error = false;
            }
        } else {
            $selectUser = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM smscontact where id = '$contact'"));
            $exist .= ucwords($selectUser['FirstName'] . " " . $selectUser['LastName'] . ", ");
        }
    }
    if (!empty($exist)) {
        $exist .= "is already existed in this Group. So they are not added in this Group again.";
    }
    if ($error === true) {
        $msg = "Contacts added in Group <br>" . $exist;
        $sts = "success";
        echo json_encode(array($msg, $sts));
        exit();
    } elseif ($error === false) {
        $msg = $exist;
        $sts = "error";
        echo json_encode(array($msg, $sts));
        exit();
    }
}

function groupContact($dbc, $id)
{
    $getGroups = mysqli_query($dbc, "SELECT * FROM assign_groups where group_id = '$id'");
    $contactsId = [];
    while ($fetchGroups = mysqli_fetch_assoc($getGroups)) {
        array_push($contactsId, $fetchGroups['contact_id']);
    }
    return $contactsId;
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] === "groupContacts") {
    $id = $_REQUEST['id'];
    $contactArray = groupContact($dbc, $id);
    $smsINPUTS = "<div style='border:1px solid lightgray;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;overflow-x:scroll;padding:5px;margin-right:5px'>";
    foreach ($contactArray as $key => $contact) {
        $getContact = mysqli_query($dbc, "SELECT * FROM smscontact where id = '$contact'");
        $fetchContact = mysqli_fetch_assoc($getContact);
        // $smsINPUTS .= '<label class="dropdown-item"><input style="margin-left:10px" type="checkbox" checked name="" data-type="contact" value=""><span style="padding:3px;"></span>'.ucwords($fetchContact['FirstName'])." ".ucwords($fetchContact['LastName']).'</label>';
        $smsINPUTS .= '<label class="dropdown-item"><input style="margin-left:10px" type="checkbox" checked name="" data-type="contact" value=' . $fetchContact['phone'] . '><span style="padding:3px;"></span>' . ucwords($fetchContact['FirstName']) . " " . ucwords($fetchContact['LastName']) . '</label>';
    }
    $smsINPUTS .= "</div>";
    echo $smsINPUTS;
    exit();
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] === "sendMessage") {
    $contactList = $_REQUEST['contactList'];
    $smsTitle = $_REQUEST['smsTitle'];
    $type = $_REQUEST['type'];
    $smsMessage = $_REQUEST['smsMessage'];
    $msg = "";
    if ($type == "sms") {
        foreach ($contactList as $key => $contact) {
            $sendMessage = mysqli_query($dbc, "INSERT INTO sms(title, msg, phone, type) VALUES ('$smsTitle','$smsMessage', '$contact', '$type')");
        }
        $msg = "SMS Send";
    } elseif ($type == "notification") {
        $sendMessage = mysqli_query($dbc, "INSERT INTO sms(title, msg, phone, type) VALUES ('$smsTitle','$smsMessage', 'null', '$type')");
        $msg = "Notification Send";
    } elseif ($type == "sms, notification") {
        $type = explode(",", $type);
        $type = array_map("trim", $type);
        $typeSMS = $type['0'];
        $typeNotfication = $type['1'];
        $sendMessage = mysqli_query($dbc, "INSERT INTO sms(title, msg, phone, type) VALUES ('$smsTitle','$smsMessage', 'null', '$typeNotfication')");
        foreach ($contactList as $key => $contact) {
            $sendMessage = mysqli_query($dbc, "INSERT INTO sms(title, msg, phone, type) VALUES ('$smsTitle','$smsMessage', '$contact', '$typeSMS')");
        }
        $msg = "Notification & SMS Send";
    }
    $sts = "success";
    echo json_encode(array($msg, $sts));
    exit();
}




$response = $arr = [];
if (!empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "getSMS") {
        @$status = empty($_REQUEST['status']) ? "queue" : strtolower($_REQUEST['status']);
        $q = mysqli_query($dbc, "SELECT * FROM sms WHERE sts ='$status'");
        while ($r = mysqli_fetch_assoc($q)) {
            $title = trim($r['title']);
            $type = $r['type'];
            if ($type == "sms" || $type == "notification") {
                $r['type'] = [$type];
            } elseif ($type = "sms, notification") {
                $type = explode(",", $type);
                $r['type'] = array_map("trim", $type);
            }
            $arr[] = $r;
        }
        @$response = [
            "action" => $_REQUEST['action'],
            "sms_status" => $status,
            'count' => mysqli_num_rows($q),
            "msg" => "SMS Queue List",
            'sts' => 'success',
            'data' => $arr,
            'code' => 200
        ];
    } elseif ($_REQUEST['action'] == "updateSMS" and !empty($_REQUEST['status']) and  !empty($_REQUEST['id'])) {
        $status = strtolower($_REQUEST['status']);
        $id = strtolower($_REQUEST['id']);
        $q = mysqli_query($dbc, "UPDATE sms SET sts='$status' WHERE id='$id'");
        if ($q) {
            @$response = [
                "action" => $_REQUEST['action'],
                "msg" => "SMS Status Updated as " . $status,
                'sts' => 'success',
                'code' => 200
            ];
        } else {
            @$response = [
                "action" => $_REQUEST['action'],
                "msg" => mysqli_error($dbc),
                'sts' => 'danger',
                'code' => 201
            ];
            echo json_encode($response);
            exit();
        }
    }
} else {
    @$response = [
        "action" => $_REQUEST['action'],
        "msg" => "No direct access allowed. Invalid API Call",
        'sts' => 'danger',
        'code' => 404
    ];
}
if (!empty($_REQUEST['action'])) {
    echo json_encode($response);
    exit();
}

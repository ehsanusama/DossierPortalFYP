<?php @include_once '../inc/functions.php';
@include_once '../mailerClass/PHPMailerAutoload.php';
$response = [];
//base_url() = https://attendezz.com/dashboard/api/
$baseUrl = str_replace("api/", "", base_url()); // https://attendezz.com/dashboard/
$email_body = '<center><div style="padding:50px;background:#fff;border:1px solid #eee;box-shadow:10px 10px 10px gray"><img src="http://attendezz.com/img/logo.png" width="80" height="80" alt=""> <h3>Attendezz <small>QR Attendance System</small></h3>';
if (!empty($_REQUEST['action'])) {

    @$fetchUser = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM users WHERE user_email='$_COOKIE[user_login]' OR username='$_COOKIE[user_login]'"));




    if ($_REQUEST['action'] == "login") {
        /* Login Process */
        $user_roles = [];
        $user_email = validate_data($dbc, $_REQUEST['user_email']);
        $user_password = md5($_REQUEST['user_password']);
        $q = mysqli_query($dbc, "SELECT * FROM users WHERE (user_email='$user_email' OR username='$user_email') AND user_password='$user_password'");

        $count = mysqli_num_rows($q);
        if ($count == 1) {
            if (!empty($_REQUEST['platform']) and $_REQUEST['platform'] == "web") {
                setcookie("user_login", $user_email, time() + (86400 * 30), "/");
            }

            $fetchUserData = mysqli_fetch_assoc($q);
            $fetchUserData['profile_img_path'] = $baseUrl . "img/staff/" . $fetchUserData['user_pic'];
            $fetchUserData['user_extra'] = json_decode($fetchUserData['user_extra']);
            $fetchUserData['user_timing'] = json_decode($fetchUserData['user_timing']);
            $created_business = $user_business = [];
            $getUserRole = mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE user_id='$fetchUserData[user_id]'");
            while ($fetchUserRole = mysqli_fetch_assoc($getUserRole)) {
                $user_roles[] = $fetchUserRole['user_role'];
            }
            if (strtolower($fetchUserData['user_status']) == "enable" or strtolower($fetchUserData['user_status']) == "active") {
                $response = [
                    "msg" => "Logging...",
                    "sts" => "success",
                    'user_data' => $fetchUserData,
                    "user_roles" => $user_roles,
                    "user_business" => $user_business,
                    "user_created_business" => $created_business,
                    "action" => $_REQUEST['action']
                ];
                $notifications = [
                    'type' => "login",
                    'text' => 'Login attempted from IP: ' . $ip,
                    'user_id' => $fetchUserData['user_id'],
                ];
                insert_data($dbc, "notifications", $notifications);
            } else {
                $response = [
                    "msg" => "Your account is disabled. Contact with your business/company manager",
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        } else {
            $response = [
                "msg" => "Invalid Email or Password",
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    } elseif ($_REQUEST['action'] == "getuser" and !empty($_REQUEST['user_id'])) {
        /* Login Process */
        $q = mysqli_query($dbc, "SELECT * FROM users WHERE (user_id='$_REQUEST[user_id]')");
        @$user_id = $_REQUEST['user_id'];
        $count = mysqli_num_rows($q);
        if ($count == 1) {
            $created_business =  $user_business = [];
            $fetchUserData = mysqli_fetch_assoc($q);
            $fetchUserData['profile_img_path'] = $baseUrl . "img/staff/" . $fetchUserData['user_pic'];
            $fetchUserData['user_extra'] = json_decode($fetchUserData['user_extra']);
            $fetchUserData['user_timing'] = json_decode($fetchUserData['user_timing']);
            $getUserRole = mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE user_id='$fetchUserData[user_id]'");
            while ($fetchUserRole = mysqli_fetch_assoc($getUserRole)) {
                $user_roles[] = $fetchUserRole['user_role'];
            }
            $getUserBusiness = mysqli_query($dbc, "SELECT * FROM assign_business WHERE user_id='$user_id'");
            while ($fetchUserBusiness = mysqli_fetch_assoc($getUserBusiness)) {
                $business_data = fetchRecord($dbc, "business", "business_id", $fetchUserBusiness['business_id']);
                $business_data['business_logo'] = $baseUrl . "img/" . $business_data['business_logo'];
                $user_business[] = $business_data;
            }
            $getUserCreatedBusiness = mysqli_query($dbc, "SELECT * FROM business WHERE user_id='$fetchUserData[user_id]'");
            while ($fetchUserCreatedBusiness = mysqli_fetch_assoc($getUserCreatedBusiness)) {
                $user_created_business_data = fetchRecord($dbc, "business", "business_id", $fetchUserCreatedBusiness['business_id']);
                $user_created_business_data['business_logo'] = $baseUrl . "img/" . $user_created_business_data['business_logo'];
                $created_business[] = $user_created_business_data;
            }

            if (strtolower($fetchUserData['user_status']) == "enable" or strtolower($fetchUserData['user_status']) == "active") {
                @$response = [
                    "msg" => "Data fetched...",
                    "sts" => "success",
                    'user_data' => $fetchUserData,
                    "user_roles" => $user_roles,
                    "user_business" => $user_business,
                    'user_created_business' => $created_business,
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => "Your account is disabled. Contact with your business/company manager",
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        } else {
            $response = [
                "msg" => "Invalid Email or Password",
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /* Update User Profile */ elseif ($_REQUEST['action'] == 'update_user_profile') {
        $fetchUser['user_id'] = (!empty($fetchUser['user_id'])) ? $fetchUser['user_id'] : $_REQUEST['user_id'];
        $user_extra = [
            'age' => $_REQUEST['age'],
            'domicile' => $_REQUEST['domicile'],
            'cnic' => $_REQUEST['cnic'],
            'tts_service' => $_REQUEST['tts_service'],
            'assistant_professor' => $_REQUEST['assistant_professor'],
            'mid_term_review' => $_REQUEST['mid_term_review'],
            'department' => $_REQUEST['department'],
            'phd_experience' => $_REQUEST['phd_experience'],
            'ntu' => $_REQUEST['ntu'],
            'nationality' => $_REQUEST['nationality']
        ];
        @$data = [
            'user_first_name' => $_REQUEST['user_first_name'],
            'user_last_name' => $_REQUEST['user_last_name'],
            'user_phone' => $_REQUEST['user_phone'],
            'user_address' => $_REQUEST['user_address'],
            'user_dob' => $_REQUEST['user_dob'],
            'designation' => $_REQUEST['designation'],
            'user_extra' => json_encode($user_extra)
        ];
        if (update_data($dbc, "users", $data, "user_id", $fetchUser['user_id'])) {
            $response = [
                "msg" => "Profile Updated",
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /* Change User Password */ elseif ($_REQUEST['action'] == 'update_password') {
        $fetchUser['user_id'] = (!empty($fetchUser['user_id'])) ? $fetchUser['user_id'] : $_REQUEST['user_id'];
        $msg = "";
        $old_password = md5($_REQUEST['old_password']);
        $new_password = md5($_REQUEST['new_password']);
        $confirm_password = md5($_REQUEST['confirm_password']);
        if (!empty($old_password)) {
            if (@mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM users WHERE user_id='$fetchUser[user_id]' AND user_password='$old_password'")) == 1) {
                if ($new_password == $confirm_password) {
                    $data = ['user_password' => $new_password];
                    if (update_data($dbc, "users", $data, 'user_id', $fetchUser['user_id'])) {
                        $response = [
                            "msg" => "Password Updated successfully",
                            "sts" => "success",
                            "action" => $_REQUEST['action']
                        ];
                    } else {
                        $response = [
                            "msg" => mysqli_error($dbc),
                            "sts" => "danger",
                            "action" => $_REQUEST['action']
                        ];
                    }
                } else {
                    $response = [
                        "msg" => "New or Confimed Password not Matched...",
                        "sts" => "info",
                        "action" => $_REQUEST['action']
                    ];
                }
            } else {
                $response = [
                    "msg" => "Old Password not Matched...",
                    "sts" => "warning",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    } elseif ($_REQUEST['action'] == "forgot_password_module") {

        $user_email = $_REQUEST['user_email'];
        $fetchUserData = fetchRecord($dbc, "users", "user_email", $user_email);
        if (countWhen($dbc, "users", "user_email", $user_email) == 0) {
            $response = [
                "msg" => "'" . $user_email . "' is not found in our system",
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        } else {
            $new_password = substr(uniqid(), 0, 6);
            $email_body .= 'Hello, ' . strtoupper($fetchUserData['user_first_name']) . '<br>
					Your temporary password is: <b>' . $new_password . '</b><br>
					For security reasons, You can click the link<br><br><a href="https://attendezz.com/dashboard/" style="background:#008D4C;color:#fff;padding:6px 16px;text-decoration:none;line-height:24px ">Click here to login</a>
					 <br><br> we advise you to change your password after logging in.';
            $email_body .= '</div></center>';
            if ($server == 'localhost') {
                $mail_response = send_email($user_email, "Attendezz - Your new password", $email_body);
            } else {
                $mail_response = mail($user_email, "Attendezz - Your new password", $email_body, $headers);
            }

            if ($mail_response) {
                if (update_data($dbc, "users", ["user_password" => md5($new_password)], "user_email", $user_email)) {
                    $response = [
                        "msg" => "We've sent you an email. Please find enclosed your new temporary password.",
                        "sts" => "success",
                        "action" => $_REQUEST['action']
                    ];
                } else {
                    $response = [
                        "msg" => mysqli_error($dbc),
                        "sts" => "danger",
                        "action" => $_REQUEST['action']
                    ];
                }
            } else {
                $response = [
                    "msg" => "Error in sending email",
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    } elseif ($_REQUEST['action'] == "verify_link") {
        $user_email = base64_decode($_REQUEST['email']);
        $fetchUserData = fetchRecord($dbc, "users", "user_email", $user_email);
        $email_body = '
                    <table style="max-width:700px ;align-content: center;font-family:sans-serif;" align="center">
                    <tr style="align-content: center">
                    <td style="padding: 12px 30px;background-color: white;" ><img src="http://attendezz.com/img/logo.png" alt="Company Logo" width="50px" style="margin-left: 53%;"></td>
                        </tr>
                        <tr style="align-content: center">
                        <td> <img src="https://www.attendezz.com/img/confirm.gif" alt="" style="height:300px; width:300px;margin-left: 33%;"> </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td>
                              <h2 >Hi ' . strtoupper($fetchUserData['user_first_name']) . '</h2>
                              <h3 style="text-align: center">Welcome to Attendezz!</p>
                            </td>
                        </tr>
                           <tr style="text-align: center;">
                            <td>
                                <p>Please click the button below to confirm your email account.</p>
                            </td>
                          </tr>
                           <tr style="text-align: center;">
                             <td><a style="background-color: #fd4f04;color: white;padding: 10px 20px;border: none;text-decoration: none;"  href="' . base_url() . 'verify.php?email=' . base64_encode($user_email) . '">VERIFY MY EMAIL</a></td>
                            </tr>
                            <tr style="text-align: center;">
                            <td>
                                <p>This link expires in three days to maintain your security. If you<br> received this email by accident, feel free to ignore it. <br><br>
                                                Thanks, from team Attendezz</p>
                                                <i style="font-size:15px">This email has been sent to ' . $user_email . ' as part of your Attendezz account.</i>
                            </td>
                          </tr>
                    <tr style="text-align: center;" >
                        <td >
        
                            <h5>Copyright &copy; 2023,All Rights Reserved</h5>
                            <a href="' . FB_LINK . '"><img src="https://cdn-icons-png.flaticon.com/128/2504/2504903.png" width="30px"></a>
                            <a href=""><img src="https://cdn-icons-png.flaticon.com/128/2504/2504947.png" width="30px"></a>
                            <a href="' . INSTA_LINK . '"><img src="https://cdn-icons-png.flaticon.com/128/2111/2111463.png" width="30px"></a>
                        </td>
                    </tr>
                </table>       
        ';

        if ($server == "localhost") {
            $mail_response = send_email($user_email, "Attendezz - Time to verify your email", $email_body);
        } else {
            $mail_response = mail($user_email, "Attendezz - Time to verify your email", $email_body, $headers);
        }
        if ($mail_response) {
            $response = [
                "msg" => "Check your inbox to verify your account",
                "sts" => "success",
                "action" => 'login'
            ];
        } else {
            $response = [
                "msg" => "Error in sending email, Something went wrong try submit again",
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    } elseif ($_REQUEST['action'] == 'update_user_role_rights') {
        if (isset($_REQUEST['user_role_name'])) {
            if (mysqli_query($dbc, "DELETE FROM assign_module WHERE user_role='$_REQUEST[user_role_name]'")) {

                foreach ($_REQUEST['user_role_page'] as $page) :
                    $data = [
                        'user_role' => $_REQUEST['user_role_name'],
                        'menu_page' => $page,
                    ];
                    $q = insert_data($dbc, "assign_module", $data);

                endforeach;
                if (@$q) {
                    $response = [
                        "msg" => "User Rights Updated",
                        "sts" => "success",
                        "action" => $_REQUEST['action']
                    ];
                } else {
                    $response = [
                        "msg" => mysqli_error($dbc),
                        "sts" => "danger",
                        "action" => $_REQUEST['action']
                    ];
                }
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    }/*Delete Table Data*/ else if (!empty($_REQUEST['id']) and $_REQUEST['action'] == "delete_data") {
        $id = $_REQUEST['id'];
        $table = $_REQUEST['table'];
        $fld = $_REQUEST['fld'];
        if (mysqli_query($dbc, "DELETE FROM $table WHERE $fld='$id'")) {
            $response = [
                "msg" => "Data has been deleted",
                "sts" => "danger",
                "action" => $_REQUEST['action'],
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    } elseif ($_REQUEST['action'] == "assign_user_roles") {
        if (mysqli_query($dbc, "DELETE FROM assign_user_role WHERE user_id='$_REQUEST[user_id]'")) {

            foreach ($_REQUEST['role_list'] as $role) :
                @$data = [
                    'user_id' => $_REQUEST['user_id'],
                    'user_role' => strtolower($role),
                    'assign_user_role_remarks' => "Assign by User: " . $_COOKIE['user_login'],
                ];
                $q = insert_data($dbc, "assign_user_role", $data);

            endforeach;
            if (@$q) {
                $response = [
                    "msg" => "User Role Updated",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /*Register Staff Module*/ elseif ($_REQUEST['action'] == "register_staff_module") {
        @$data = [
            'user_first_name' => strtolower($_REQUEST['user_first_name']),
            'user_last_name' => strtolower($_REQUEST['user_last_name']),
            'user_email' => strtolower($_REQUEST['user_email']),
            'user_phone' => $_REQUEST['user_phone'],
        ];
        if (@$_FILES['f']['tmp_name']) {
            upload_pic($_FILES['f'], "../img/staff/");
            $data['user_pic'] = $_SESSION['pic_name'];
        }
        if ($_REQUEST['operation'] == "add") {
            $data['username'] = str_replace(" ", "_", strtolower($_REQUEST['user_first_name'])) . "_" . substr(uniqid(), 0, 5);
            $data['user_password'] = md5($_REQUEST['user_password']);
            $data['user_created_id'] = $fetchUser['user_id'];
            $email_body = 'You have been invited by National Textile University to join an account on Dossier Portal! <br>
												Please <a href="https://attendezz.com/dashboard" target="_blank">click the link</a> to login and set your account password. <br>
												Your temporary password is: ' . $_REQUEST['user_password'] . '
												<br><br>Thank you!<br>
												Team Attendezz
												 <br><br>

											<i style="font-size:10px">This email has been sent to ' . $fetchUser['user_email'] . ' as part of your Attendezz account.</i>';
            if (!empty($_REQUEST['send_email']) and $_REQUEST['send_email'] == "yes") {
                if ($server == "localhost") {
                    $mail_response = send_email($data['user_email'], "Welcome, - " . strtoupper($data['user_first_name']), $email_body);
                } else {
                    $mail_response = mail($data['user_email'], "Welcome, - " . strtoupper($data['user_first_name']), $email_body, $headers);
                }
            } else {
                $mail_response = true;
            }

            if ($mail_response) {
                if (insert_data($dbc, "users", $data)) {
                    /*Sending Email*/
                    $lastId = mysqli_insert_id($dbc);
                    $data_assign_role = [
                        'user_id' => $lastId,
                        'user_role' => (!empty($_REQUEST['user_role'])) ? $_REQUEST['user_role'] : 'user',
                        'assign_user_role_remarks' => 'Manager registration by ' . $fetchUser['user_email']
                    ];
                    insert_data($dbc, "assign_user_role", $data_assign_role);
                    $response = [
                        "msg" => "Account has been created successfully.",
                        "sts" => "success",
                        "action" => $_REQUEST['action'],
                    ];
                } else {
                    $response = [
                        "msg" => mysqli_error($dbc),
                        "sts" => "danger",
                        "action" => $_REQUEST['action']
                    ];
                }
            } else {
                $response = [
                    "msg" => "Error in sending email, Something went wrong try submit again",
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
        /*Update Code*/ else {
            $fetchUserData = fetchRecord($dbc, "users", "user_id", $_REQUEST['user_id']);
            if (mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM users WHERE user_password='$_REQUEST[user_password]' AND user_id='$_REQUEST[user_id]'")) == 0) {
                $data["user_password"] = md5($_REQUEST['user_password']);
            }
            if (update_data($dbc, "users", $data, "user_id", $_REQUEST['user_id'])) {
                $email_body = 'Hello, ' . strtoupper($fetchUserData['user_first_name']) . '<br>
											Your temporary password is: <b>' . $_REQUEST['user_password'] . '</b><br>
											For security reasons, we advise you to change your password after logging in.';
                if (!empty($_REQUEST['send_password']) and $_REQUEST['send_password'] == "yes") {
                    if ($server == "localhost") {
                        $mail_response = send_email($data['user_email'], "Attendezz - New Password", $email_body);
                    } else {
                        $mail_response = mail($data['user_email'], "Attendezz - New Password", $email_body, $headers);
                    }
                }
                $response = [
                    "msg" => "Profile Updated",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    }
    /*Update Account Status*/ elseif ($_REQUEST['action'] == "change_account_status") {
        if ($_REQUEST['table'] == "users") {
            $q = update_data($dbc, "users", ["user_status" => $_REQUEST['status']], 'user_id', $_REQUEST['id']);
        } elseif ($_REQUEST['table'] == "business") {
            $q = update_data($dbc, "business", ["business_status" => $_REQUEST['status']], 'business_id', $_REQUEST['id']);
        } elseif ($_REQUEST['table'] == "business_tracking") {
            $q = update_data($dbc, "business", ["is_tracking" => $_REQUEST['status']], 'business_id', $_REQUEST['id']);
        } elseif ($_REQUEST['table'] == "is_multiple") {
            $q = update_data($dbc, "users", ["is_multiple" => $_REQUEST['status']], 'user_id', $_REQUEST['id']);
        } elseif ($_REQUEST['table'] == "is_tracking_staff") {
            $q = update_data($dbc, "assign_business", ["is_tracking" => $_REQUEST['status']], 'id', $_REQUEST['id']);
        } elseif ($_REQUEST['table'] == "business_weekly_promotion") {
            $q = update_data($dbc, "business", ["weekly_promotion" => $_REQUEST['status']], 'business_id', $_REQUEST['id']);
        } elseif ($_REQUEST['table'] == "get_notification") {
            $q = update_data($dbc, "business", ["get_notification" => $_REQUEST['status']], 'business_id', $_REQUEST['id']);
        } else {
        }
        if ($q) {
            $response = [
                "msg" => strtoupper($_REQUEST['table']) . " Account status changed to " . strtoupper($_REQUEST['status']),
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    } elseif ($_REQUEST['action'] == "update_profile_pic" and !empty($_REQUEST['img'])) {
        $img = $_REQUEST['img']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $name = md5(uniqid()) . ".png";
        if (file_put_contents('../img/staff/' . $name, $data)) {
            if (update_data($dbc, "users", ['user_pic' => $name], "user_id", $_REQUEST['user_id'])) {
                $response = [
                    "msg" => "Profile Picture has been updated",
                    "sts" => "success",
                    "pic_name" => $name,
                    "img_path" => 'https://www.attendezz.com/dashboard/img/staff/' . $name,
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        } else {
            $response = [
                "msg" => "error in uploading picture",
                "pic_name" => "",
                "img_path" => "",
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /******************Dossier FYP Portal Code *****************/
    /*executive_summary*/ elseif ($_REQUEST['action'] == "executive_summary") {

        $data = [
            'summary' => $_REQUEST['summary'],
            'user_id' => $fetchUser['user_id']
        ];
        if (empty($_REQUEST['id'])) {

            if (insert_data($dbc, "executive_summary", $data)) {
                $response = [
                    "msg" => "Executive Summary Added Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
            # code...
        } else {
            if (update_data($dbc, "executive_summary", $data, "id", $_REQUEST['id'])) {
                $response = [
                    "msg" => "Executive Summary Updated Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    }/*research_interests*/ elseif ($_REQUEST['action'] == "research_interests") {

        $data = [
            'research_interests' => $_REQUEST['research_interests'],
            'user_id' => $fetchUser['user_id']
        ];
        if (empty($_REQUEST['id'])) {

            if (insert_data($dbc, "research_interests", $data)) {
                $response = [
                    "msg" => "Research interests Added Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
            # code...
        } else {
            if (update_data($dbc, "research_interests", $data, "id", $_REQUEST['id'])) {
                $response = [
                    "msg" => "Research interests Updated Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    }
    /***********Research Data*************/
    elseif ($_REQUEST['action'] == "research_data") {
        for ($i = 0; $i < count($_REQUEST['research_domain_text']); $i++) {
            $research_domain_details[] = [
                'research_domain_text' => $_REQUEST['research_domain_text'][$i],
                'research_domain_details' => $_REQUEST['research_domain_details'][$i],
            ];

            if (@$_FILES['f']['tmp_name'][$i]) {
                $file_array = [
                    'name' => $_FILES['f']['name'][$i],
                    'tmp_name' => $_FILES['f']['tmp_name'][$i],
                    'error' => $_FILES['f']['error'][$i],
                    'size' => $_FILES['f']['size'][$i],
                    'type' => $_FILES['f']['type'][$i],
                ];
                upload_file($file_array, "../img/uploads/");
                $research_domain_details['document'][$i] = $_SESSION['file_name'];
            }
        }

        $data = [
            'research_domain_title' => $_REQUEST['research_domain_title'],
            'user_id' => $fetchUser['user_id'],
            'research_domain_data' => json_encode($research_domain_details)
        ];

        if (insert_data($dbc, "research_data", $data)) {
            $response = [
                "msg" => "Research interests Updated Successfully",
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /***********academic_data*************/
    elseif ($_REQUEST['action'] == "academic_data") {

        for ($i = 0; $i < count($_REQUEST['research_domain_text']); $i++) {
            $research_domain_details[] = [
                'research_domain_text' => $_REQUEST['research_domain_text'][$i],
                'research_domain_details' => $_REQUEST['research_domain_details'][$i],
            ];
            if (@$_FILES['f']['tmp_name'][$i]) {
                $file_array = [
                    'name' => $_FILES['f']['name'][$i],
                    'tmp_name' => $_FILES['f']['tmp_name'][$i],
                    'error' => $_FILES['f']['error'][$i],
                    'size' => $_FILES['f']['size'][$i],
                    'type' => $_FILES['f']['type'][$i],
                ];
                upload_file($file_array, "../img/uploads/");
                $research_domain_details['file'][$i] = $_SESSION['file_name'];
            }
        }

        $data = [
            'academic_domain_title' => $_REQUEST['academic_domain_title'],
            'user_id' => $fetchUser['user_id'],
            'academic_domain_data' => json_encode($research_domain_details)
        ];

        if (insert_data($dbc, "academic_data", $data)) {
            $response = [
                "msg" => "Research interests Updated Successfully",
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /****************other_contributions*******************/
    elseif ($_REQUEST['action'] == "other_contributions") {

        for ($i = 0; $i < count($_REQUEST['research_domain_text']); $i++) {
            $research_domain_details[] = [
                'research_domain_text' => $_REQUEST['research_domain_text'][$i],
                'research_domain_details' => $_REQUEST['research_domain_details'][$i],
            ];
            if (@$_FILES['f']['tmp_name'][$i]) {
                $file_array = [
                    'name' => $_FILES['f']['name'][$i],
                    'tmp_name' => $_FILES['f']['tmp_name'][$i],
                    'error' => $_FILES['f']['error'][$i],
                    'size' => $_FILES['f']['size'][$i],
                    'type' => $_FILES['f']['type'][$i],
                ];
                upload_file($file_array, "../img/uploads/");
                $research_domain_details['file'][$i] = $_SESSION['file_name'];
            }
        }
        $data = [
            'contributions_domain_title' => $_REQUEST['contributions_domain_title'],
            'user_id' => $fetchUser['user_id'],
            'contributions_domain_data' => json_encode($research_domain_details)
        ];

        if (insert_data($dbc, "other_contributions", $data)) {
            $response = [
                "msg" => "Research interests Updated Successfully",
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /*personal_mission*/ elseif ($_REQUEST['action'] == "personal_mission") {

        $data = [
            'summary' => $_REQUEST['personal_mission_text'],
            'user_id' => $fetchUser['user_id']
        ];
        if (empty($_REQUEST['id'])) {

            if (insert_data($dbc, "personal_mission", $data)) {
                $response = [
                    "msg" => "Personal Mission Added Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
            # code...
        } else {
            if (update_data($dbc, "personal_mission", $data, "id", $_REQUEST['id'])) {
                $response = [
                    "msg" => "Personal Mission Updated Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    }
    /****************academic_qualification*******************/
    elseif ($_REQUEST['action'] == "academic_qualification") {
        for ($i = 0; $i < count($_REQUEST['degree']); $i++) {
            $data = [
                'degree' => $_REQUEST['degree'][$i],
                'research' => $_REQUEST['research'][$i],
                'university' => $_REQUEST['university'][$i],
                'major_field' => $_REQUEST['major_field'][$i],
                'user_id' => $fetchUser['user_id']
            ];
            if (@$_FILES['f']['tmp_name'][$i]) {
                $file_array = [
                    'name' => $_FILES['f']['name'][$i],
                    'tmp_name' => $_FILES['f']['tmp_name'][$i],
                    'error' => $_FILES['f']['error'][$i],
                    'size' => $_FILES['f']['size'][$i],
                    'type' => $_FILES['f']['type'][$i],
                ];
                upload_file($file_array, "../img/uploads/");
                $data['file'][$i] = $_SESSION['file_name'];
                $data = array_merge($data, array('file' => $data['file'][$i]));
            }
            $cdata = [
                'cdegree' => @$_REQUEST['cdegree'][$i],
                'cresearch' => @$_REQUEST['cresearch'][$i],
                'cuniversity' => @$_REQUEST['cuniversity'][$i],
                'cmajor_field' => @$_REQUEST['cmajor_field'][$i],
                'user_id' => @$fetchUser['user_id'],
            ];
            if (insert_data($dbc, "academic_qualification", $data)) {
                insert_data($dbc, "certifications ", $cdata);
                $response = [
                    "msg" => "Academic Qualification Add Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    } elseif ($_REQUEST['action'] == "certifications") {
        for ($i = 0; $i < count($_REQUEST['degree']); $i++) {
            $data = [
                'cdegree' => $_REQUEST['degree'][$i],
                'cresearch' => $_REQUEST['research'][$i],
                'cuniversity' => $_REQUEST['university'][$i],
                'cmajor_field' => $_REQUEST['major_field'][$i],
                'user_id' => $fetchUser['user_id']
            ];
            if (@$_FILES['f']['tmp_name'][$i]) {
                $file_array = [
                    'name' => $_FILES['f']['name'][$i],
                    'tmp_name' => $_FILES['f']['tmp_name'][$i],
                    'error' => $_FILES['f']['error'][$i],
                    'size' => $_FILES['f']['size'][$i],
                    'type' => $_FILES['f']['type'][$i],
                ];
                upload_file($file_array, "../img/uploads/");
                $data['file'][$i] = $_SESSION['file_name'];
                $data = array_merge($data, array('file' => $data['file'][$i]));
            }

            if (insert_data($dbc, "certifications", $data)) {
                $response = [
                    "msg" => "Academic certifications Add Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    }

    /*professional_experience*/ elseif ($_REQUEST['action'] == "professional_experience") {
        $data = [
            'institute' => $_REQUEST['institute'],
            'position' => $_REQUEST['position'],
            'duties' => $_REQUEST['duties'],
            'year_from' => $_REQUEST['from'],
            'year_to' => $_REQUEST['to'],
            'user_id' => $fetchUser['user_id']
        ];
        if (@$_FILES['f']['tmp_name']) {
            upload_file($_FILES['f'], "../img/uploads/");
            $data['file'] = $_SESSION['file_name'];
        }
        if (insert_data($dbc, "professional_experience", $data)) {
            $response = [
                "msg" => "Professional Experience Add Successfully",
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    } /*statement_teaching*/ elseif ($_REQUEST['action'] == "statement_teaching") {

        $data = [
            'statement_teaching_text' => $_REQUEST['statement_teaching_text'],
            'user_id' => $fetchUser['user_id']
        ];
        if (empty($_REQUEST['id'])) {

            if (insert_data($dbc, "statement_teaching", $data)) {
                $response = [
                    "msg" => "Statement Teaching Added Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
            # code...
        } else {
            if (update_data($dbc, "statement_teaching", $data, "id", $_REQUEST['id'])) {
                $response = [
                    "msg" => "Statement Teaching Updated Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    }
    /****************taught_course_details*******************/
    elseif ($_REQUEST['action'] == "taught_course_details") {
        $data = [
            'title' => $_REQUEST['title'],
            'credit_hour' => $_REQUEST['credit_hour'],
            'teaching_hour' => $_REQUEST['teaching_hour'],
            'phd_ms_bs' => $_REQUEST['phd_ms_bs'],
            'year' => $_REQUEST['year'],
            'user_id' => $fetchUser['user_id']
        ];
        if (@$_FILES['f']['tmp_name']) {
            upload_pic($_FILES['f'], "../img/uploads/");
            $data['document'] = $_SESSION['pic_name'];
        }
        if (insert_data($dbc, "taught_course_details", $data)) {
            $response = [
                "msg" => "Record Inserted Successfully",
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    } elseif ($_REQUEST['action'] == "develop_course_details") {
        $data = [
            'title' => $_REQUEST['title'],
            'credit_hour' => $_REQUEST['credit_hour'],
            'phd_ms_bs' => $_REQUEST['phd_ms_bs'],
            'user_id' => $fetchUser['user_id']
        ];

        if (insert_data($dbc, "develop_course_details", $data)) {
            $response = [
                "msg" => "Record Inserted Successfully",
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /*professional_experience*/ elseif ($_REQUEST['action'] == "curriculum_develop") {
        $data = [
            'institute' => $_REQUEST['institute'],
            'position' => $_REQUEST['position'],
            'duties' => $_REQUEST['duties'],
            'year_from' => $_REQUEST['from'],
            'year_to' => $_REQUEST['to'],
            'user_id' => $fetchUser['user_id']
        ];
        if (insert_data($dbc, "curriculum_develop", $data)) {
            $response = [
                "msg" => "Record Add Successfully",
                "sts" => "success",
                "action" => $_REQUEST['action']
            ];
        } else {
            $response = [
                "msg" => mysqli_error($dbc),
                "sts" => "danger",
                "action" => $_REQUEST['action']
            ];
        }
    }
    /*personal_mission*/ elseif ($_REQUEST['action'] == "traning_conducted") {

        $data = [
            'details' => $_REQUEST['details'],
            'user_id' => $fetchUser['user_id']
        ];
        if (@$_FILES['f']['tmp_name']) {
            upload_pic($_FILES['f'], "../img/uploads/");
            $data['file'] = $_SESSION['pic_name'];
        }
        if (empty($_REQUEST['id'])) {
            if (insert_data($dbc, "traning_conducted", $data)) {
                $response = [
                    "msg" => "Record Added Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
            # code...
        } else {
            if (update_data($dbc, "traning_conducted", $data, "id", $_REQUEST['id'])) {
                $response = [
                    "msg" => "Record Updated Successfully",
                    "sts" => "success",
                    "action" => $_REQUEST['action']
                ];
            } else {
                $response = [
                    "msg" => mysqli_error($dbc),
                    "sts" => "danger",
                    "action" => $_REQUEST['action']
                ];
            }
        }
    } else {
    }
}/*Action not empty*/
if (empty($response)) {
    $response = [
        "msg" => "invalid api call. Undefined Action",
        'sts' => "danger",
        "action" => ''
    ];
}
echo json_encode($response);

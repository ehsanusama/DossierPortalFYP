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
</head>

<body>
    <div class='portlet light'>
        <div class='portlet-body'>
            <h1 class=' w-100 text-center py-2 mt-5'>Add Contact</h1>
            <div class='card-body m-auto'>
                <form class='card p-5' method="post" action='' style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id='addContact_form'>
                    <input type="hidden" name="action" value="addContact" id='actionCxt'>
                    <input type="hidden" name="id" id='cxtID' value="">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" placeholder="First Name" name='first_name' required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Last Name" name='last_name' required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name='email' required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" id="phone" placeholder="03XXXXXXXXXXX" name='phone' required>
                    </div>
                    <button type="submit" id='addContact' class="btn btn-primary btn-sm">Submit</button>
                </form>
            </div>
            <div class="row">
                <h1 class=' w-100 text-center py-2 mb-2 mt-5'>Contact</h1>
                <div class='table-responsive'>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><small><b>First Name</b></small></th>
                                <th scope="col"><small><b>Last Name</b></small></th>
                                <th scope="col"><small><b>User Email</b></small></th>
                                <th scope="col"><small><b>Phone</b></small></th>
                                <th scope="col"><small><b>Register Date</b></small></th>
                                <th scope="col"><small><b>Status</b></small></th>
                                <th scope="col"><small><b>Delete</b></small></th>
                                <th scope="col"><small><b>Edit</b></small></th>
                                <th scope="col"><small><b>Change Status</b></small></th>
                            </tr>
                        </thead>
                        <tbody id="contactData">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Sweet Alert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="../life/js/jquery.js"></script>
    <script src="js/smsModule.js"></script>
</body>

</html>
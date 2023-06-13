<?php include_once("inc/smsModule.php"); ?>
<div class='portlet light'>
    <div class='portlet-body'>
        <h1 class=' w-100 text-center py-2 mt-5'>Add New Groups</h1>
        <div class='card-body m-auto'>
            <form class='card p-5' method="get" action='' style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id='addGroup_form'>
                <input type="hidden" name="action" value="addGroup" id='actionGrp'>
                <input type="hidden" name="id" id='groupID' value="">
                <div class="form-group">
                    <label for="group_name">Add New Group</label>
                    <input type="text" class="form-control" id="group_name" placeholder="New Group Name" name='group_name' required>
                </div>
                <button type="submit" id='addGroup' class="btn btn-primary btn-sm">Add Group</button>
            </form>
        </div>
        <div class="row">
            <h1 class=' w-100 text-center py-2 mb-2 mt-5'>Groups</h1>
            <div class='table-responsive'>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><small><b>Group Name</b></small></th>
                            <th scope="col"><small><b>Added At</b></small></th>
                            <th scope="col"><small><b>Status</b></small></th>
                            <th scope="col"><small><b>Delete</b></small></th>
                            <th scope="col"><small><b>Edit</b></small></th>
                            <th scope="col"><small><b>Change Status</b></small></th>
                        </tr>
                    </thead>
                    <tbody id="groupData">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Sweet Alert Script -->
<script src="js/smsModule.js"></script>
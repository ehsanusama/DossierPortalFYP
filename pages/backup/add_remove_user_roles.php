<div class="portlet light">
  <div class="portlet-body">
    <div class="portlet-title">
      <h3 class="box-title">Add User Roles</h3>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">

          <!-- /.box-header -->

          <div class="box-body">
            <table class="table myTable">

              <thead>

                <tr>

                  <th>Role ID</th>

                  <th>Role Name</th>

                  <th>Status</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody class="text-capitalize">

                <?php $q = mysqli_query($dbc, "SELECT * FROM user_roles");

                while ($r = mysqli_fetch_assoc($q)) :

                ?>

                  <tr class="delete_area">

                    <td><?= $r['user_role_id'] ?></td>

                    <td><?= $r['user_role_name'] ?></td>

                    <td><?= getEnDis($r['user_role_status']) ?></td>

                    <td>

                      <div class="btn-group">

                        <a href="#" onclick="deleteData('user_roles','user_role_id',<?= $r['user_role_id'] ?>,'index.php?nav=<?= $_REQUEST["nav"] ?>',this)" class="btn btn-danger btn-xs">Delete</a>

                        <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&edit_user_role_id=<?= base64_encode($r['user_role_id']) ?>" class="btn btn-primary btn-xs">Edit</a>

                      </div>

                    </td>

                  </tr>

                <?php endwhile; ?>

              </tbody>

            </table>

          </div>

          <!-- /.table-responsive -->

        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
        <!-- /.box -->
      </div><!-- col -->

      <div class="col-sm-6 panel panel-default panel-body">

        <form action="" method="post" class="ajax_form">
          <div class="box-tools pull-right">

            <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&business=<?= @$_SESSION['business'] ?>" class="btn btn-box-tool text-success" data-widget="collapse"><i class="fa fa-plus"></i> Add new

            </a>

          </div>

          <div class="form-group">

            <label for="">Role Name</label>

            <input type="text" name="user_role_name" class="form-control" placeholder="Role Name" required value="<?= @$fetchUserRoleData['user_role_name'] ?>">

          </div><!-- group -->

          <div class="form-group">

            <label for="">Status</label>

            <select name="user_role_status" id="" class="form-control">

              <?php getSelectTag(@$fetchUserRoleData['user_role_status'], "Select Status"); ?>

              <option value="enable">Enable</option>

              <option value="disable">Disable</option>

            </select>

          </div><!-- group -->
          <div class="text-right">
            <?= @$user_role_btn ?>
          </div>
        </form>

      </div><!-- col -->

    </div><!-- row -->
  </div>
</div><!-- box -->
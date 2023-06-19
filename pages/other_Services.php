<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(7.7) Other Services</h2>
    </div>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form" enctype="multipart/form-data">
            <input type="hidden" name="action" value="other_Services">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Role </th>
                                    <th colspan="2" class="text-center">At </th>
                                    <th colspan="2" class="text-center">Responsibilities </th>
                                    <th colspan="1" class="text-center">From </th>
                                    <th colspan="1" class="text-center">To </th>

                                </tr>
                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="role" required></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="at" required></td>
                                    <td colspan="2"><input type="text" class="form-control " name="duties"></td>
                                    <td colspan="1"><input type="number" class="form-control " name="from"></td>
                                    <td colspan="1"><input type="number" class="form-control " name="to"></td>

                                </tr>
                            </table>
                        </div><!-- row -->
                    </div><!-- panel -->

                    <button class="btn btn-primary" type="submit">Save</button>

                </div><!-- col -->
            </div><!-- row -->
        </form>
    </div>


</div>

<div class='portlet light'>
    <div class="portlet-title">
        <h4 class=''>(7.7) Other Services</h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Role </th>
                        <th class="text-center">At </th>
                        <th class="text-center">Responsibilities </th>
                        <th class="text-center">From </th>
                        <th class="text-center">To </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM other_Services WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><?= $row['role'] ?></td>
                            <td><?= $row['at'] ?></td>
                            <td><?= $row['duties'] ?></td>
                            <td><?= $row['year_from'] ?></td>
                            <td><?= $row['year_to'] ?></td>
                            <td> <a href="#" onclick="deleteData('other_Services','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>
            <style>
                dropdown-menu label {
                    display: block;
                }
            </style>
            <?php
            if (!empty($_REQUEST['collaboration_established_edit'])) {
                $fetch_collaboration_established = fetchRecord($dbc, "collaboration_established", "id", $_REQUEST['collaboration_established_edit']);
            }
            ?>
            <div class='portlet light'>
                <div class="portlet-title">
                    <h2 class=''>(7.1) MOU’s/ Collaboration established with National and International Organization</h2>
                </div>
                <div class='portlet-body'>
                    <form action="api/index.php" method="post" class="ajax-form">
                        <input type="hidden" name="action" value="collaboration_established">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default panel-body">
                                    <div class="row">
                                        <table class="table">
                                            <tr>
                                                <th colspan="2" class="text-center">Country </th>
                                                <th colspan="2" class="text-center">University </th>
                                                <th colspan="2" class="text-center">Type of Collaboration </th>
                                            </tr>
                                            <tr class="product-row">
                                                <td colspan="2"><input type="text" class="form-control" name="country" value="<?= @$fetch_collaboration_established['country'] ?>"></input></td>
                                                <td colspan="2"><input type="text" class="form-control " name="uni" value="<?= @$fetch_collaboration_established['uni'] ?>"></td>
                                                <td colspan="2"><input type="text" class="form-control " name="type" value="<?= @$fetch_collaboration_established['type'] ?>"></td>
                                                <input type="hidden" name="id" value="<?= @$fetch_collaboration_established['id'] ?>">

                                            </tr>
                                        </table>
                                    </div><!-- row -->
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div><!-- panel -->



                            </div><!-- col -->
                        </div><!-- row -->
                    </form>
                </div>


            </div>

            <div class='portlet light'>
                <div class="portlet-title">
                    <h4 class=''>(7.1) MOU’s/ Collaboration established with National and International Organization</h4>
                </div>
                <div class='portlet-body'>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Country </th>
                                    <th class="text-center">University </th>
                                    <th class="text-center">Type of Collaboration </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM collaboration_established WHERE user_id = $fetchUser[user_id]";
                                $q = mysqli_query($dbc, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($q)) :
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['country'] ?></td>
                                        <td><?= $row['uni'] ?></td>
                                        <td><?= $row['type'] ?></td>
                                        <td>
                                            <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&collaboration_established_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                            <a href="#" onclick="deleteData('collaboration_established','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                    </tr>

                                <?php
                                    $i++;
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </h2>
    </div>



</div>
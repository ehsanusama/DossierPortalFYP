<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(5.4) Curriculum Development & Review</h2>
    </div>
    <?php
    if (!empty($_REQUEST['curriculum_develop_edit'])) {
        $fetch_curriculum_develop = fetchRecord($dbc, "curriculum_develop", "id", $_REQUEST['curriculum_develop_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form">
            <input type="hidden" name="action" value="curriculum_develop">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Role </th>
                                    <th colspan="2" class="text-center">Organization </th>
                                    <th colspan="2" class="text-center">Duties </th>
                                    <th colspan="1" class="text-center">From </th>
                                    <th colspan="1" class="text-center">To </th>
                                </tr>
                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="institute" value="<?= @$fetch_curriculum_develop['institute'] ?>"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="position" value="<?= @$fetch_curriculum_develop['position'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="duties" value="<?= @$fetch_curriculum_develop['duties'] ?>"></td>
                                    <td colspan="1"><input type="text" class="form-control " name="from" value="<?= @$fetch_curriculum_develop['year_from'] ?>"></td>
                                    <td colspan="1"><input type="text" class="form-control " name="to" value="<?= @$fetch_curriculum_develop['year_to'] ?>"></td>
                                    <input type="hidden" name="id" value="<?= @$fetch_curriculum_develop['id'] ?>">

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
        <h4 class=''>(5.4) Curriculum Development & Review</h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Role </th>
                        <th class="text-center">Organization </th>
                        <th class="text-center">Duties </th>
                        <th class="text-center">From </th>
                        <th class="text-center">To </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM curriculum_develop WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><?= $row['institute'] ?></td>
                            <td><?= $row['position'] ?></td>
                            <td><?= $row['duties'] ?></td>
                            <td><?= $row['year_from'] ?></td>
                            <td><?= $row['year_to'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&curriculum_develop_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>

                                <a href="#" onclick="deleteData('curriculum_develop','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
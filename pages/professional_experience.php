<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(4) Professional Experience</h2>
    </div>
    <?php
    if (!empty($_REQUEST['professional_experience_edit'])) {
        $fetch_professional_experience = fetchRecord($dbc, "professional_experience", "id", $_REQUEST['professional_experience_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="professional_experience">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Name of Institution </th>
                                    <th colspan="2" class="text-center">Position Held </th>
                                    <th colspan="2" class="text-center">Duties </th>
                                    <th colspan="1" class="text-center">From </th>
                                    <th colspan="1" class="text-center">To </th>
                                    <th colspan="1">File</th>
                                </tr>
                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="institute" required value="<?= @$fetch_professional_experience['institute'] ?>"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="position" required value="<?= @$fetch_professional_experience['position'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="duties" required value="<?= @$fetch_professional_experience['duties'] ?>"></td>
                                    <td colspan="1"><input type="number" class="form-control " name="from" value="<?= @$fetch_professional_experience['year_from'] ?>"></td>
                                    <td colspan="1"><input type="number" class="form-control " name="to" value="<?= @$fetch_professional_experience['year_to'] ?>"></td>
                                    <td colspan="1"><input type="file" id="img" class="center-block" name="f">
                                        <input type="hidden" name="id" value="<?= @$fetch_professional_experience['id'] ?>">
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
        <h4 class=''>(4) Professional Experience</h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Name of Institution </th>
                        <th class="text-center">Position Held </th>
                        <th class="text-center">Duties </th>
                        <th class="text-center">From </th>
                        <th class="text-center">To </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM professional_experience WHERE user_id = $fetchUser[user_id]";
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
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&professional_experience_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>

                                <a href="#" onclick="deleteData('professional_experience','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
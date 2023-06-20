<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(5.5) Trainings & Certificates (Attended) / Conducted </h2>
    </div>
    <?php
    if (!empty($_REQUEST['traning_conducted_edit'])) {
        $fetch_traning_conducted = fetchRecord($dbc, "traning_conducted", "id", $_REQUEST['traning_conducted_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="traning_conducted">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="6" class="text-center">Role </th>
                                    <th colspan="2" class="text-center">File </th>

                                </tr>
                                <tr class="product-row">
                                    <td colspan="6"><textarea type="text" class="form-control" name="details" required> <?= @$fetch_traning_conducted['details'] ?></textarea></td>
                                    <td colspan="1"><input type="file" id="img" name="f" value="<?= @$fetch_traning_conducted['title'] ?>">
                                        <input type="hidden" name="id" value="<?= @$fetch_traning_conducted['id'] ?>">

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
        <h4 class=''>(5.5) Trainings & Certificates (Attended) / Conducted </h4>
    </div>

    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="col-md-4" class="text-center">Details </th>
                        <th class="text-center">File </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM traning_conducted WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td colspan="col-md-4"><?= $row['details'] ?></td>
                            <td><?= $row['file'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&traning_conducted_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>

                                <a href="#" onclick="deleteData('traning_conducted','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
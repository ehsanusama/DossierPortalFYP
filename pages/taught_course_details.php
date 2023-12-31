<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(5.2) Detail of Courses Taught</h2>
    </div>
    <?php
    if (!empty($_REQUEST['taught_course_details_edit'])) {
        $taught_course_details_edit = fetchRecord($dbc, "taught_course_details", "id", $_REQUEST['taught_course_details_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="taught_course_details">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Course Title </th>
                                    <th colspan="2" class="text-center">Credit Hours </th>
                                    <th colspan="2" class="text-center">Teaching Hours (since 20xx) </th>
                                    <th colspan="2" class="text-center">PhD/MS/BS </th>
                                    <th colspan="2" class="text-center">Year</th>
                                    <th colspan="1">Document</th>
                                </tr>
                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="title" required value="<?= @$taught_course_details_edit['title'] ?>"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="credit_hour" required value="<?= @$taught_course_details_edit['credit_hour'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="teaching_hour" required value="<?= @$taught_course_details_edit['teaching_hour'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="phd_ms_bs" value="<?= @$taught_course_details_edit['phd_ms_bs'] ?>"></td>
                                    <td colspan="2"><input type="number" class="form-control " name="year" value="<?= @$taught_course_details_edit['year'] ?>"></td>
                                    <td colspan="1"><input type="file" id="img" class="center-block" name="f" value="<?= @$taught_course_details_edit['document'] ?>">
                                    </td>
                                    <input type="hidden" name="id" value="<?= @$taught_course_details_edit['id'] ?>">


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
        <h4 class=''>(5.2) Detail of Courses Taught</h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Course Title </th>
                        <th class="text-center">Credit Hours </th>
                        <th class="text-center">Teaching Hours (since 20xx) </th>
                        <th class="text-center">PhD/MS/BS </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM taught_course_details WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['credit_hour'] ?></td>
                            <td><?= $row['teaching_hour'] ?></td>
                            <td><?= $row['phd_ms_bs'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&taught_course_details_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>

                                <a href="#" onclick="deleteData('taught_course_details','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
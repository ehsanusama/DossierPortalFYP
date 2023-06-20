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
            if (!empty($_REQUEST['develop_course_details_edit'])) {
                $fetch_develop_course_details = fetchRecord($dbc, "develop_course_details", "id", $_REQUEST['develop_course_details_edit']);
            }
            ?>
            <div class='portlet light'>
                <div class="portlet-title">
                    <h2 class=''>(5.3) Detail of New Courses Developed</h2>
                </div>
                <div class='portlet-body'>
                    <form action="api/index.php" method="post" class="ajax-form">
                        <input type="hidden" name="action" value="develop_course_details">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default panel-body">
                                    <div class="row">
                                        <table class="table">
                                            <tr>
                                                <th colspan="2" class="text-center">Course Title </th>
                                                <th colspan="2" class="text-center">Credit Hours </th>
                                                <th colspan="2" class="text-center">PhD/MS/BS </th>
                                            </tr>
                                            <tr class="product-row">
                                                <td colspan="2"><input type="text" class="form-control" name="title" value="<?= @$fetch_develop_course_details['title'] ?>"></input></td>
                                                <td colspan="2"><input type="text" class="form-control " name="credit_hour" value="<?= @$fetch_develop_course_details['credit_hour'] ?>"></td>
                                                <td colspan="2"><input type="text" class="form-control " name="phd_ms_bs" value="<?= @$fetch_develop_course_details['phd_ms_bs'] ?>"></td>
                                                <input type="hidden" name="id" value="<?= @$fetch_develop_course_details['id'] ?>">

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
                    <h4 class=''>(5.3) Detail of New Courses Developed</h4>
                </div>
                <div class='portlet-body'>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Course Title </th>
                                    <th class="text-center">Credit Hours </th>
                                    <th class="text-center">PhD/MS/BS </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM develop_course_details WHERE user_id = $fetchUser[user_id]";
                                $q = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_assoc($q)) :
                                ?>
                                    <tr>
                                        <td><?= $row['title'] ?></td>
                                        <td><?= $row['credit_hour'] ?></td>
                                        <td><?= $row['phd_ms_bs'] ?></td>
                                        <td>
                                            <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&develop_course_details_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>

                                            <a href="#" onclick="deleteData('develop_course_details','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                    </tr>

                                <?php
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
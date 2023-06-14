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
                                                <td colspan="2"><input type="text" class="form-control" name="title"></input></td>
                                                <td colspan="2"><input type="text" class="form-control " name="credit_hour"></td>
                                                <td colspan="2"><input type="text" class="form-control " name="phd_ms_bs"></td>

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
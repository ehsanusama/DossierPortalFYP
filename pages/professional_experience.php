<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(4) Professional Experience</h2>
    </div>
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
                                    <td colspan="2"><input type="text" class="form-control" name="institute"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="position"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="duties"></td>
                                    <td colspan="1"><input type="text" class="form-control " name="from"></td>
                                    <td colspan="1"><input type="text" class="form-control " name="to"></td>
                                    <td colspan="1"><input type="file" id="img" class="center-block" onchange="uploadImage(this)" data-target="#aImgShow" name="f">

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
                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
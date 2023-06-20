<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(6.9) External Examiner/Referee of MS/PhD Thesis:</h2>
    </div>
    <?php
    if (!empty($_REQUEST['external_examiner_edit'])) {
        $fetch_external_examiner = fetchRecord($dbc, "external_examiner", "id", $_REQUEST['external_examiner_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="external_examiner">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">

                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Student’s Name </th>
                                    <th colspan="2" class="text-center">Thesis Title</th>
                                    <th colspan="2" class="text-center">Year </th>
                                    <th colspan="2" class="text-center">Class </th>

                                </tr>

                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="name" required value="<?= @$fetch_external_examiner['name'] ?>"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="title" required value="<?= @$fetch_external_examiner['title'] ?>"></td>
                                    <td colspan="2"><input type="number" class="form-control " name="year" required value="<?= @$fetch_external_examiner['year'] ?>"></td>
                                    <td colspan="2"> <select name="class" class="form-control">
                                            <option value="" disabled selected>Status</option>
                                            <option value="PhD">PhD</option>
                                            <option value="MS">MS</option>
                                            <option value="BS">BS</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th colspan="2">University</th>

                                    <th colspan="1">Document</th>
                                </tr>
                                <tr>
                                    <td colspan="2"> <input type="text" class="form-control " name="uni" value="<?= @$fetch_external_examiner['uni'] ?>"></td>
                                    <td colspan="1"><input type="file" id="img" class="center-block" name="f">
                                        <input type="hidden" name="id" value="<?= @$fetch_external_examiner['id'] ?>">

                                    </td>
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
        <h4 class=''>(6.3) Books Chapters authored:</h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th class="text-center">Student’s Name </th>
                        <th class="text-center">Thesis Title</th>
                        <th class="text-center">Year </th>
                        <th class="text-center">Class </th>
                        <th>AS</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php

                    $sql = "SELECT * FROM external_examiner WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    $k = 1;
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><?= $k  ?></td>
                            <td><?= @$row['name'] ?></td>
                            <td><?= @$row['title'] ?></td>
                            <td><?= @$row['year'] ?></td>
                            <td><?= $row['class'] ?></td>
                            <td><?= @$row['uni'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&external_examiner_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                <a href="#" onclick="deleteData('external_examiner','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </tr>

                    <?php
                        $k++;
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
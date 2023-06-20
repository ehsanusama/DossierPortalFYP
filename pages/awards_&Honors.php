<style>
    dropdown-menu label {
        display: block;
    }
</style>
<?php
if (!empty($_REQUEST['awards_Honors_edit'])) {
    $fetch_awards_Honors = fetchRecord($dbc, "awards_Honors", "id", $_REQUEST['awards_Honors_edit']);
}
?>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(7.5) Awards & Honors </h2>
    </div>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form">
            <input type="hidden" name="action" value="awards_Honors">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Name of Award </th>
                                    <th colspan="2" class="text-center">Year </th>
                                    <th colspan="2" class="text-center"> Awarding Body </th>
                                </tr>
                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="name" required value="<?= @$fetch_awards_Honors['name'] ?>"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="year" required value="<?= @$fetch_awards_Honors['year'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="body" value="<?= @$fetch_awards_Honors['body'] ?>"></td>
                                    <input type="hidden" name="id" value="<?= @$fetch_awards_Honors['id'] ?>">

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
        <h4 class=''>(7.5) Awards & Honors </h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Name of Award </th>
                        <th class="text-center">Year </th>
                        <th class="text-center"> Awarding Body </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM awards_Honors WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['year'] ?></td>
                            <td><?= $row['body'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&awards_Honors_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                <a href="#" onclick="deleteData('awards_Honors','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

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
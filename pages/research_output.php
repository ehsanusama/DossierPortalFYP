<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class='portlet light'>
        <div class="portlet-title">
            <h2 class=''>(6.2) Research Out Put </h2>
        </div>
        <?php
        if (!empty($_REQUEST['research_output_edit'])) {
            $fetch_research_output = fetchRecord($dbc, "research_output", "id", $_REQUEST['research_output_edit']);
        }
        ?>
        <div class='portlet-body'>
            <form action="api/index.php" method="post" class="ajax-form">
                <input type="hidden" name="action" value="research_output">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default panel-body">
                            <div class="row">
                                <table class="table">
                                    <tr>
                                        <th colspan="6" class="text-center"> </th>
                                        <th colspan="2" class="text-center">Number </th>

                                    </tr>
                                    <tr class="product-row">
                                        <td colspan="6"><input type="text" class="form-control" name="details" required value="<?= @$fetch_research_output['details'] ?>"></input></td>
                                        <td colspan="1"><input type="number" class="form-control" name="number" required value="<?= @$fetch_research_output['number'] ?>">
                                            <input type="hidden" name="id" value="<?= @$fetch_research_output['id'] ?>">

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

</div>

<div class='portlet light'>
    <div class="portlet-title">
        <h4 class=''>(6.2) Research Out Put </h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" colspan="3">Details </th>
                        <th class="text-center">Number </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM research_output WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td colspan="3"><?= $row['details'] ?></td>
                            <td><?= $row['number'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&research_output_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                <a href="#" onclick="deleteData('research_output','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
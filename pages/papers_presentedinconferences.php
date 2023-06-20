<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(9) Papers presented in Conferences </h2>
    </div>
    <?php
    if (!empty($_REQUEST['presented_conferences_edit'])) {
        $fetch_presented_conferences = fetchRecord($dbc, "presented_conferences", "id", $_REQUEST['presented_conferences_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="presented_conferences">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Name of Author/Authors </th>
                                    <th colspan="2" class="text-center"> Title of Paper </th>
                                    <th colspan="2" class="text-center"> National/International/ Held At </th>
                                    <th colspan="2" class="text-center">Year/Conference Title</th>
                                    <th>File</th>
                                </tr>

                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="author" required value="<?= @$fetch_presented_conferences['author'] ?>"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="title" required value="<?= @$fetch_presented_conferences['title'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="held_at" required value="<?= @$fetch_presented_conferences['held_at'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="conference_title" value="<?= @$fetch_presented_conferences['conference_title'] ?>"></td>
                                    <td colspan="2"><input type="file" name="f" class="form-control" id="img" style="width: 150px;" value="<?= @$fetch_presented_conferences['file'] ?>"></td>
                                    <input type="hidden" name="id" value="<?= @$fetch_presented_conferences['id'] ?>">
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
        <h4 class=''>(9) Papers presented in Conferences</h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Name of Author/Authors </th>
                        <th class="text-center"> Title of Paper </th>
                        <th class="text-center"> National/International/ Held At </th>
                        <th class="text-center">Year/Conference Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>




                    <?php
                    $sql = "SELECT * FROM presented_conferences WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><?= $row['author'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['held_at'] ?></td>
                            <td><?= $row['conference_title'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&presented_conferences_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                <a href="#" onclick="deleteData('presented_conferences','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                            </td>
                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
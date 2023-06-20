<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(6.8) Reviewer of research articles: </h2>
    </div>
    <?php
    if (!empty($_REQUEST['reviewer_articles_edit'])) {
        $fetch_reviewer_articles = fetchRecord($dbc, "reviewer_articles", "id", $_REQUEST['reviewer_articles_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="reviewer_articles">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="4" class="text-center">File </th>

                                </tr>
                                <tr class="product-row">
                                    <td colspan="4"><input type="file" id="img" name="f" value="<?= @$fetch_reviewer_articles['file'] ?>">
                                        <input type="hidden" name="id" value="<?= @$fetch_reviewer_articles['id'] ?>">

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
        <h4 class=''>(6.8) Reviewer of research articles: </h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">File </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM reviewer_articles WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><a target="_blank" href="img/uploads/<?= $row['file'] ?>"> <?= $row['file'] ?></a></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&reviewer_articles_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>

                                <a href="#" onclick="deleteData('reviewer_articles','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
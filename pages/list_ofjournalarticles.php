<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(8) List of Journal Articles </h2>
    </div>
    <?php
    if (!empty($_REQUEST['journal_articles_edit'])) {
        $fetch_journal_articles = fetchRecord($dbc, "journal_articles", "id", $_REQUEST['journal_articles_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="journal_articles">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Authors and Title </th>
                                    <th colspan="2" class="text-center"> Year </th>
                                    <th colspan="2" class="text-center"> Journal </th>
                                    <th colspan="2" class="text-center">Impact Factor (JCR)</th>
                                    <th colspan="2" class="text-center">DOI </th>
                                    <th colspan="2" class="text-center">First/Corresponding Authors Author </th>
                                    <th>File</th>
                                </tr>

                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="title" required value="<?= @$fetch_journal_articles['title'] ?>"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="year" required value="<?= @$fetch_journal_articles['year'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="journal" required value="<?= @$fetch_journal_articles['journal'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="impact" value="<?= @$fetch_journal_articles['impact'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="doi" value="<?= @$fetch_journal_articles['doi'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="corresponding" value="<?= @$fetch_journal_articles['corresponding'] ?>"></td>
                                    <td colspan="2"><input type="file" name="f" class="form-control" id="img" style="width: 150px;" value="<?= @$fetch_journal_articles['file'] ?>"></td>
                                    <input type="hidden" name="id" value="<?= @$fetch_journal_articles['id'] ?>">

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
        <h4 class=''>(8) List of Journal Articles</h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Authors and Title </th>
                        <th class="text-center"> Year </th>
                        <th class="text-center"> Journal </th>
                        <th class="text-center">Impact Factor (JCR)</th>
                        <th class="text-center">DOI </th>
                        <th class="text-center">First/Corresponding Authors Author </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM journal_articles WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['year'] ?></td>
                            <td><?= $row['journal'] ?></td>
                            <td><?= $row['impact'] ?></td>
                            <td><?= $row['doi'] ?></td>
                            <td><?= $row['corresponding'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&journal_articles_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>

                                <a href="#" onclick="deleteData('journal_articles','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(6.3) Books Chapters authored:</h2>
    </div>
    <?php
    if (!empty($_REQUEST['books_authored_edit'])) {
        $fetch_books_authored = fetchRecord($dbc, "books_authored", "id", $_REQUEST['books_authored_edit']);
    }
    ?>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="books_authored">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Authors </th>
                                    <th colspan="2" class="text-center">Chapter </th>
                                    <th colspan="2" class="text-center">Year </th>
                                    <th colspan="2" class="text-center">Book </th>

                                </tr>

                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="authors" required value="<?= @$fetch_books_authored['authors'] ?>"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="chapter" value="<?= @$fetch_books_authored['chapter'] ?>"></td>
                                    <td colspan="2"><input type="number" class="form-control " name="year" required value="<?= @$fetch_books_authored['year'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="book" required value="<?= @$fetch_books_authored['book'] ?>"></td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">DOI</th>
                                    <th colspan="2" class="text-center">Publisher</th>
                                    <th colspan="1">Document</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="text" class="form-control " name="doi" value="<?= @$fetch_books_authored['doi'] ?>"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="publisher" required value="<?= @$fetch_books_authored['publisher'] ?>"></td>

                                    <td colspan="1"><input type="file" id="img" class="center-block" name="f" value="<?= @$fetch_books_authored['file'] ?>">
                                    </td>
                                    <input type="hidden" name="id" value="<?= @$fetch_books_authored['id'] ?>">

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
                        <th class="text-center">Authors </th>
                        <th class="text-center">Chapter </th>
                        <th class="text-center">Year </th>
                        <th class="text-center">Book </th>
                        <th class="text-center">DOI</th>
                        <th class="text-center">Publisher</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM books_authored WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>






                        <tr>
                            <td><?= $row['authors'] ?></td>
                            <td><?= $row['chapter'] ?></td>
                            <td><?= $row['year'] ?></td>
                            <td><?= $row['book'] ?></td>
                            <td><?= $row['doi'] ?></td>
                            <td><?= $row['publisher'] ?></td>
                            <td>
                                <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&books_authored_edit=<?= $row['id'] ?>" class="btn  btn-primary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                <a href="#" onclick="deleteData('books_authored','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(6.3) Books Chapters authored:</h2>
    </div>

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
                                    <td colspan="2"><input type="text" class="form-control" name="authors"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="chapter"></td>
                                    <td colspan="2"><input type="number" class="form-control " name="year"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="book"></td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">DOI</th>
                                    <th colspan="2" class="text-center">Publisher</th>
                                    <th colspan="1">Document</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="text" class="form-control " name="doi"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="publisher"></td>

                                    <td colspan="1"><input type="file" id="img" class="center-block" name="f">
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
                            <td> <a href="#" onclick="deleteData('books_authored','id',<?= $row['user_id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
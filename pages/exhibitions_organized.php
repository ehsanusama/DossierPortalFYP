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
                    <h2 class=''>(7.3) Conferences/Exhibitions Organized (As Organizer)</h2>
                </div>
                <div class='portlet-body'>
                    <form action="api/index.php" method="post" class="ajax-form">
                        <input type="hidden" name="action" value="exhibitions_organized">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default panel-body">
                                    <div class="row">
                                        <table class="table">
                                            <tr>
                                                <th colspan="2" class="text-center">Conference Title</th>
                                                <th colspan="2" class="text-center">Organizer </th>
                                                <th colspan="2" class="text-center">Location </th>
                                                <th colspan="2" class="text-center">Date </th>

                                            </tr>
                                            <tr class="product-row">
                                                <td colspan="2"><input type="text" class="form-control" name="title"></input></td>
                                                <td colspan="2"><input type="text" class="form-control " name="organizer"></td>
                                                <td colspan="2"><input type="text" class="form-control " name="location"></td>
                                                <td colspan="2"><input type="date" class="form-control " name="date"></td>

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
                    <h4 class=''>(7.3) Conferences/Exhibitions Organized (As Organizer)</h4>
                </div>
                <div class='portlet-body'>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Conference Title</th>
                                    <th class="text-center">Organizer </th>
                                    <th class="text-center">Location </th>
                                    <th class="text-center">Date </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM exhibitions_organized WHERE user_id = $fetchUser[user_id]";
                                $q = mysqli_query($dbc, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($q)) :
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['title'] ?></td>
                                        <td><?= $row['organizer'] ?></td>
                                        <td><?= $row['location'] ?></td>
                                        <td><?= $row['date'] ?></td>
                                        <td> <a href="#" onclick="deleteData('exhibitions_organized','id',<?= $row['user_id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

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
        </h2>
    </div>



</div>
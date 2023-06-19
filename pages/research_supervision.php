<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(6.7) Research Supervision:</h2>
    </div>

    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
            <input type="hidden" name="action" value="research_supervision">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">

                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Student’s Name </th>
                                    <th colspan="3" class="text-center">Thesis Title</th>
                                    <th colspan="1" class="text-center">Year </th>
                                    <th colspan="2" class="text-center">Class </th>

                                </tr>

                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="name" required></input></td>
                                    <td colspan="3"><input type="text" class="form-control " name="title" required></td>
                                    <td colspan="1"><input type="number" class="form-control " name="year" required></td>
                                    <td colspan="2"> <select name="class" class="form-control">
                                            <option value="" disabled selected>Degree</option>
                                            <option value="PhD">PhD</option>
                                            <option value="MS">MS</option>
                                            <option value="BS">BS</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">AS</th>
                                    <th colspan="2" class="text-center">Status</th>
                                    <th colspan="1" class="text-center">Document</th>
                                </tr>
                                <tr>
                                    <td colspan="2"> <select name="role" class="form-control">
                                            <option value="" disabled selected>As</option>
                                            <option value="Supervisor">As Supervisor</option>
                                            <option value="Co-Supervisor">As Co-Supervisor</option>
                                        </select></td>
                                    <td colspan="2">
                                        <select name="status" class="form-control">
                                            <option value="" disabled selected>Status</option>
                                            <option value="inprogress">Inprogress</option>
                                            <option value="completed">Completed</option>

                                        </select>
                                    </td>
                                    <td colspan="1"><input type="file" id="img" class="center-block" name="f"></td>
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
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $class = ["Phd", "MS", "BS"];
                    $role = ["Supervisor", "Co-Supervisor"];
                    for ($i = 0; $i < count($class); $i++) :

                        for ($j = 0; $j < count($role); $j++) :
                            $sql = "SELECT * FROM research_supervision WHERE user_id = $fetchUser[user_id] and class = '$class[$i]' and role = '$role[$j]' ";
                            $q = mysqli_query($dbc, $sql);
                    ?>
                            <tr>
                                <td colspan="6" class="text-center"><?= $class[$i] ?> Thesis completed (As <?= $role[$j] ?>) </td>
                            </tr>
                            <?php
                            $k = 1;
                            while ($row = mysqli_fetch_assoc($q)) :
                            ?>
                                <tr>
                                    <td><?= $k  ?></td>
                                    <td><?= @$row['name'] ?></td>
                                    <td><?= @$row['title'] ?></td>
                                    <td><?= @$row['year'] ?></td>
                                    <td><?= $row['class'] ?></td>
                                    <td><?= @$row['role'] ?></td>
                                    <td><?= @$row['status'] ?></td>
                                    <td> <a href="#" onclick="deleteData('research_supervision','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                </tr>

                    <?php
                                $k++;
                            endwhile;

                        endfor;

                    endfor;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
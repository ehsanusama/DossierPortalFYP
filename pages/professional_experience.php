<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(4) Professional Experience</h2>
    </div>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form">
            <input type="hidden" name="action" value="academic_qualification">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <th colspan="2" class="text-center">Name of Institution </th>
                                    <th colspan="2" class="text-center">Position Held </th>
                                    <th colspan="2" class="text-center">Duties </th>
                                    <th class="text-center">From </th>
                                    <th class="text-center">To </th>
                                    <th>Action</th>
                                </tr>
                                <tr class="product-row">
                                    <td colspan="2"><input type="text" class="form-control" name="name_ins[]"></input></td>
                                    <td colspan="2"><input type="text" class="form-control " name="position[]"></td>
                                    <td colspan="2"><input type="text" class="form-control " name="duties[]"></td>
                                    <td colspan="1"><input type="text" class="form-control " name="from[]"></td>
                                    <td colspan="1"><input type="text" class="form-control " name="to[]"></td>
                                    <td><button type="button" class="btn btn-success btn-sm addQualificationRowBtn"><span class="fa fa-plus"></span></button></td>
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
        <h4 class=''>(3) Academic Qualification</h4>
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Degree </th>
                        <th class="text-center">Research Thesis/ Project Title </th>
                        <th class="text-center">University </th>
                        <th class="text-center">Major Field/Subjects </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM academic_qualification WHERE user_id = $fetchUser[user_id]";
                    $q = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($q)) :
                    ?>
                        <tr>
                            <td><?= $row['degree'] ?></td>
                            <td><?= $row['research'] ?></td>
                            <td><?= $row['university'] ?></td>
                            <td><?= $row['major_field'] ?></td>
                        </tr>

                    <?php
                    endwhile;
                    ?>
                    <tr>
                        <td>Certifications</td>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM certifications WHERE user_id = $fetchUser[user_id]";
                    $cq = mysqli_query($dbc, $sql);
                    while ($crow = mysqli_fetch_assoc($cq)) :
                    ?>
                        <tr>
                            <td><?= $crow['cdegree'] ?></td>
                            <td><?= $crow['cresearch'] ?></td>
                            <td><?= $crow['cuniversity'] ?></td>
                            <td><?= $crow['cmajor_field'] ?></td>
                        </tr>

                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
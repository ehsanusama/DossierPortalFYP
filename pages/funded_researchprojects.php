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
                    <h2 class=''>(6.4) Funded Research Projects :</h2>
                </div>

                <div class='portlet-body'>
                    <form action="api/index.php" method="post" class="ajax-form">
                        <input type="hidden" name="action" value="funded_research_projects">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default panel-body">
                                    <div class="row">
                                        <table class="table">
                                            <tr>
                                                <th colspan="3" class="text-center">Project Title </th>
                                                <th colspan="2" class="text-center">Principal/CoPrincipal Investigator </th>
                                                <th colspan="2" class="text-center">Amount in millions (PKR) </th>

                                            </tr>

                                            <tr class="product-row">
                                                <td colspan="3"><input type="text" class="form-control" name="title" required></input></td>
                                                <td colspan="2"><input type="text" class="form-control " name="investigator" required></td>
                                                <td colspan="2"><input type="number" class="form-control " name="amount" required></td>
                                            </tr>
                                            <tr>
                                                <th colspan="2" class="text-center"> Sponsoring Agency</th>
                                                <th colspan="2" class="text-center"> Partner (Industry)</th>
                                                <th colspan="2" class="text-center"> Duration </th>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="text" class="form-control " name="sponsor"></td>
                                                <td colspan="2"><input type="text" class="form-control " name="partner"></td>
                                                <td colspan="2"><input type="text" class="form-control " name="duration"></td>
                                                <td colspan="2">
                                                    <select name="status" class="form-control">
                                                        <option value="" disabled selected>Status</option>
                                                        <option value="inprogress">Inprogress</option>
                                                        <option value="completed">Completed</option>

                                                    </select>
                                                </td>
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
                    <h4 class=''>(6.4) Funded Research Projects :</h4>
                </div>
                <div class='portlet-body'>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Project Title </th>
                                    <th class="text-center">Principal/CoPrincipal Investigator </th>
                                    <th class="text-center">Amount in millions (PKR) </th>
                                    <th class="text-center"> Sponsoring Agency</th>
                                    <th class="text-center"> Partner (Industry)</th>
                                    <th class="text-center"> Duration </th>
                                    <th class="text-center"> Status </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM funded_research_projects WHERE user_id = $fetchUser[user_id]";
                                $q = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_assoc($q)) :
                                ?>
                                    <tr>
                                        <td><?= $row['title'] ?></td>
                                        <td><?= $row['investigator'] ?></td>
                                        <td><?= $row['amount'] ?></td>
                                        <td><?= $row['sponsor'] ?></td>
                                        <td><?= $row['partner'] ?></td>
                                        <td><?= $row['duration'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                        <td> <a href="#" onclick="deleteData('funded_research_projects','id',<?= $row['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                    </tr>

                                <?php
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
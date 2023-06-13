<div class="portlet light">
    <div class="portlet-body">
        <div class="table-responsive panel panel-default panel-body">
            <table class="table table-striped custom_dt table-bordered table-hover table-checkable order-column myTable ">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Timestamp</th>
                </tr>
                <?php
                $planRequest = mysqli_query($dbc, "SELECT * FROM subscribe_plan ORDER by id DESC");
                $i = 1;
                if (mysqli_num_rows($planRequest) > 0) :
                    while ($request = mysqli_fetch_assoc($planRequest)) : ?>
                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $request['user_name']; ?></td>
                            <td><?php echo $request['user_email']; ?></td>
                            <td><?php echo $request['phone']; ?></td>
                            <td><?php echo $request['plan']; ?></td>
                            <td><?php echo date('l, d-M-Y', strtotime($request['timestamp'])); ?></td>
                        </tr>
                <?php endwhile;
                else :

                    echo "<tr><td>No Request Found</td></tr>";
                endif; ?>
            </table>
        </div>
    </div>
</div>
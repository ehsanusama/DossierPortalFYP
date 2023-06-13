    <div class="portlet light">
        <div class="portlet-title">
            <h3 class="card-title">Subscription</h3>
            <div class="card-tools">
                <a href="#modal-id" data-toggle="modal" title="load_subscription_form|user_id|" class="btn btn-success pull-right modal-action">+ Add Subscription</a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <br><br><br>
        <div class="portlet-body">
            <table class="table myTable ">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            User Details
                        </th>
                        <th style="width: 20%">
                            Started Date
                        </th>
                        <th>
                            Expiry Date
                        </th>
                        <th style="width: 18%" class="text-center">
                            Status
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $getSubscriber = mysqli_query($dbc, "SELECT * FROM users");
                    $i = 1;
                    while ($fetchSubscriber = mysqli_fetch_assoc($getSubscriber)) :
                        $getSubscription = mysqli_query($dbc, "SELECT * FROM subscription WHERE user_id='$fetchSubscriber[user_id]' ORDER BY id DESC LIMIT 1");
                        while ($fetchSubscription = mysqli_fetch_assoc($getSubscription)) :
                            $fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchSubscription['user_id']);
                    ?>
                            <tr>
                                <td>
                                    <?= $i++; ?>
                                </td>
                                <td>
                                    <strong>Staff ID#: </strong> <?= $fetchEmployeeData['user_id'] ?>
                                    <br>
                                    <?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?>
                                    <br>
                                    <a data-toggle="tooltip" title="<?= strtolower($fetchEmployeeData['user_email']) ?>" href="mailto:<?= strtolower($fetchEmployeeData['user_email']) ?>"><?= strtolower($fetchEmployeeData['user_email']) ?></a>
                                    <br>
                                    <small>
                                        Created <?= date('d.m.Y', strtotime($fetchEmployeeData['user_add_date'])) ?>
                                    </small>
                                </td>
                                <td class="text-success">
                                    <b><big><?= date('d-M-Y', strtotime($fetchSubscription['start_date'])) ?></big></b>
                                </td>
                                <td class="project_progress text-danger">
                                    <b><big> <?= date('d-M-Y', strtotime($fetchSubscription['end_date'])) ?></big></b>
                                </td>
                                <td class="project-state text-center">
                                    <span class="badge badge-success text-capitalize"><?= $fetchSubscription['status'] ?></span>
                                    <br><br>
                                    <div class="progress progress-sm" style="height: 20px;">
                                        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width:<?= datePercentage($fetchSubscription['start_date'], $fetchSubscription['end_date']) . "%" ?>">
                                            <?= datePercentage($fetchSubscription['start_date'], $fetchSubscription['end_date']) ?>% Completed
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group-vertical">
                                        <a title="load_billing_form|id|<?= $fetchSubscription['id'] ?>" class="btn btn-warning btn-sm modal-action" href="#modal-id" data-toggle="modal"> <i class="fa fa-bell"> </i> Notification
                                        </a>
                                        <a title="load_renew_billing_form|id|<?= $fetchSubscription['id'] ?>" class="btn btn-primary btn-sm modal-action" href="#modal-id" data-toggle="modal"> <i class="fa fa-refresh"> </i> Renew
                                        </a>
                                        <a title="load_cancel_billing_form|id|<?= $fetchSubscription['id'] ?>" class="btn btn-danger btn-sm  modal-action" href="#modal-id" data-toggle="modal"> <i class="fa fa-remove"> </i> Cancel
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    <?php endwhile;
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
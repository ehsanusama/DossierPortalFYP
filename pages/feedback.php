<?php
$json_data = file_get_contents('https://cgit.pk/api.php?action=feedback');

$data =  json_decode($json_data, true);


if (isset($_GET['date'])) {
    $json_data = file_get_contents('https://cgit.pk/api.php?action=feedback&');

    $date =   strtotime($_GET['date']);

    $new_date = date('Y-m-d', $date);

    $data =  json_decode($json_data, true);
}

?>

<div class="portlet light">
    <div class="portlet-body">
        <h2>CGit.pk Feedback</h2>
        <form action='' method='get' class="pull-right">
            <div class="form-group">
                <input type="text" autocomplete="off" class="dateField mt-3 mb-5 datepicker" name='date' placeholder="Choose Date">
                <input type="hidden" autocomplete="off" class="dateField mt-3 mb-5" value='<?= @$_REQUEST['nav'] ?>' name='nav'>
                <input type="hidden" autocomplete="off" class="dateField mt-3 mb-5" value='<?= @$_REQUEST['business'] ?>' name='business'>
                <button class='btn btn-success btn-sm' type='submit'>Submit</button>
            </div>
        </form>
        <table id="example" class="myTable" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Message</th>
                    <th>Rating</th>
                    <th>Date/Time</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['date'])) {
                    if ($data !== '') {
                        foreach ($data as $feedback) {
                            if (date('Y-m-d', strtotime($feedback['date'])) == $new_date) {
                ?>
                                <tr>
                                    <td><?= ucwords($feedback['name']) ?></td>
                                    <td><?= $feedback['email'] ?></td>
                                    <td><?= $feedback['message'] ?></td>
                                    <td><?= $feedback['rating'] ?></td>
                                    <td><?= $feedback['date'] ?></td>

                                </tr>

                        <?php
                            }
                        }
                    }
                } else {
                    foreach ($data as $feedback) {

                        ?>
                        <tr>
                            <td><?= ucwords($feedback['name']) ?></td>
                            <td><?= $feedback['email'] ?></td>
                            <td><?= $feedback['message'] ?></td>
                            <td><?= $feedback['rating'] ?></td>
                            <td><?= $feedback['date'] ?></td>

                        </tr>

                <?php
                    }
                }
                ?>


            </tbody>
        </table>
        <hr>
        <?php $json_data = file_get_contents('https://attendezz.com/dashboard/api/index.php?action=get_feedback');
        $json_data =  json_decode($json_data, true);
        ?>
        <h2>Mobile Application Feedback</h2>
        <table class="table table-bordered table-condensed myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Feedback</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($json_data['data'] as $feedback) : ?>
                    <tr>
                        <td><?= $feedback['id'] ?></td>
                        <td><?= $feedback['user_id'] ?></td>
                        <td><?= $feedback['feedback'] ?></td>
                        <td><?= $feedback['timestamp'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
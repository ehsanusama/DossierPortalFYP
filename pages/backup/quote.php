<?php
$json_data = file_get_contents('https://cgit.pk/api.php?action=message');

$data =  json_decode($json_data, true);


if (isset($_GET['date'])) {
    $json_data = file_get_contents('https://cgit.pk/api.php?action=message&');

    $date =   strtotime($_GET['date']);

    $new_date = date('Y-m-d', $date);

    $data =  json_decode($json_data, true);
}

?>

<div class="portlet light">
    <div class="portlet-body">
        <!--<form action='' method='get'>-->
        <!--    <input type="text" autocomplete="off" class="dateField mt-3 mb-5" name='date'>-->
        <!--    <input type="hidden" autocomplete="off" class="dateField mt-3 mb-5" value='bWVzc2FnZQ==' name='nav'>-->
        <!--    <input type="hidden" autocomplete="off" class="dateField mt-3 mb-5" value='MjA' name='business'>-->
        <!--    <button class='btn btn-success' type='submit' >Submit</button>-->
        <!--    </form>-->
        <table id="example" class=" table myTable" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Message</th>
                    <th>Service</th>
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
                                    <td><textarea cols='10' rows='7'><?= $feedback['message'] ?></textarea></td>
                                    <td><?= $feedback['service'] ?></td>
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
                            <td><textarea cols='40' rows='7'><?= $feedback['message'] ?></textarea></td>
                            <td><?= $feedback['service'] ?></td>
                            <td><?= $feedback['date'] ?></td>

                        </tr>

                <?php
                    }
                }
                ?>


            </tbody>
        </table>
    </div>
</div>
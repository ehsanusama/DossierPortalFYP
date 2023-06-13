<?php
	
	$url = "https://attendezz.com/dashboard/cronjob/weekly_report_summary.php";

        // Initialize a CURL session.
        $ch = curl_init();

        // Return Page contents.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Grab URL and pass it to the variable
        curl_setopt($ch, CURLOPT_URL, $url);

        $response = json_decode(curl_exec($ch));
        var_dump($response);
        exit();
        mail('moixx.ansari43@gmail.com','testing- '.rand(9999,1000),rand(9999,1000).' at '.date('h:i A')." ".$response);
?>
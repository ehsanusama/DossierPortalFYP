<?php 
	if(!empty($_REQUEST['email'])){
	 $headers = "From:admin@nccfsl.org.ng\n";

        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html\n";
		if(mail($_REQUEST['email'],$_REQUEST['subject'],$_REQUEST['body'],$headers)){
			echo "Email sent";
		}else{
			echo "Error in sending Email";
		}
	}else{
		echo "Email is empty";
	}
 ?>
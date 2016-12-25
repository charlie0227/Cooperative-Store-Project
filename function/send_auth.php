
<?php
ini_set('display_errors',1);
function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

	$remail=$_POST['remail'];
	// the message
	$msg = RandomString();

	// use wordwrap() if lines are longer than 70 characters
	//$msg = wordwrap($msg,70);

	// send email
	if (mail ($remail,"Auth",$msg)) { 
		echo $msg;
		//echo 'Your message has been sent!';
	} else { 
		echo 'Something went wrong, go back and try again!'; 
	}
	//mail($remail,"Auth",$msg);
	
?> 
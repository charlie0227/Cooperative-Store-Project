
<?php
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
	mail($remail,"My subject",$msg);
	echo $msg;
?> 
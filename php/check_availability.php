<?php 
require_once("includes/config.php");
if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	$result = mysqli_query($con,"SELECT email FROM users WHERE email='$email'");
	$count = mysqli_num_rows($result);
	if($count>0) {
		echo "<span style='color:red'> L'Email inserita esiste gia'.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else {
		echo "<span style='color:green'> Email disponibile per la registrazione</span>";
 		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}
?>
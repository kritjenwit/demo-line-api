<?php 

	$conn = mysqli_connect('localhost','root','','line');


	if($conn){
		echo 'Yes';
	}else{
		die('No');
	}
<?php
	//This api file is used for delete any customer by id
	include "config.php";
	$id = $_POST['id'];
	mysqli_query($link,"delete from `customers` where ID=$id");
	if(mysqli_error($link)){
		$result['error']=mysqli_error($link);
		$result['result']=0;
	}else{
		$result['error']='';
		$result['result']=1;
	}
	echo json_encode($result);
?>
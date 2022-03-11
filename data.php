<?php
	//This api file contains json that put data from the mysql table
	include "config.php";
	$query = mysqli_query($link,"SELECT @rownum := @rownum + 1 AS urutan,t.*
		FROM customers t, 
		(SELECT @rownum := 0) r ORDER BY ID");
	$data = array();
	while($r = mysqli_fetch_assoc($query)) {
		$data[] = $r;
	}
	$i=0;
	foreach ($data as $key) {
		// add new button
		$data[$i]['del'] =' 
		<button type="submit" id="'.$data[$i]['ID'].'" class="btn btn-danger btnhapus" ><i class="fa fa-remove"></i></button>';
		$i++;
	}
	$datax = array('data' => $data);
	echo json_encode($datax);
?>

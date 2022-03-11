<?php set_time_limit(0); ?>
<style type="text/css">
	.overflow{
		overflow: auto;
	}
</style>
<?php
/**
 * XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
 */
	//header('Content-Type: text/plain');
	//Connect Database And Import IT

	$_GET['File'] = $certainfile;

	if (isset($argv[1]))
	{
		$Filepath = $argv[1];
	}
	elseif (isset($_GET['File']))
	{
		$Filepath = $_GET['File'];
	}
	else
	{
		if (php_sapi_name() == 'cli')
		{
			echo 'Please specify filename as the first argument'.PHP_EOL;
		}
		else
		{
			echo 'Please specify filename as a HTTP GET parameter "File", e.g., "/test.php?File=test.xlsx"';
		}
		exit;
	}

	// Excel reader from http://code.google.com/p/php-excel-reader/
	require('lib/excelreader/php-excel-reader/excel_reader2.php');
	require('lib/excelreader/SpreadsheetReader.php');

	date_default_timezone_set('UTC');

	$StartMem = memory_get_usage();
 
	try
	{
		$queryvalue = ""; 
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$BaseMem = memory_get_usage();
		$Sheets = $Spreadsheet -> Sheets();

		foreach ($Sheets as $Index => $Name)
		{
			$Time = microtime(true);
			$Spreadsheet -> ChangeSheet($Index);
            echo "
            <div style='overflow:auto'>
            <table id='excelformat' class='table table-striped table-bordered table-hover overflow'>";
			foreach ($Spreadsheet as $Key => $Row)
			{
				//echo $Key.': ';
				if ($Row)
				{   
					/*echo "<pre>";
					print_r($Row);
					echo "</pre>";*/
					//Pre Table
                    
					//Data Table
					$queryvalue_ctn = ""; 
					echo "<tr>";
					foreach ($Row as $Keycell => $cell) {
						echo "<td>".$cell."</td>";
						if($Key > 0 && $Keycell >= 0){
							$queryvalue_ctn .= "'".mysqli_real_escape_string($link,$cell)."',";
						}
					}
					echo "</tr>";

					//Each Value Per Row
					$queryvalue_ctn = substr($queryvalue_ctn, 0, -1);
					if($Key > 0){
					    $queryvalue .= "(".$queryvalue_ctn."),";
					}    
				}
				else
				{
					//var_dump($Row);
				}
			}
			echo 
			"
			</table>
			</div>
			";
			//echo $queryvalue;
			$query = "insert into ".$table_name."(".$column_stmt.") values ".$queryvalue;
			$fixquery = substr($query, 0, -1);
			//echo "<textarea>".$fixquery."</textarea>";
		}

	    //echo $fixquery;
	    //$exec_query = mysqli_query($link,$fixquery);
	    if (!mysqli_query($link,$fixquery)){
			echo("<br/><br/><br/>Error description: " . mysqli_error($link));
		}else{
			echo "<strong>Success Import All Data</strong>";
		}
	}
	catch (Exception $E)
	{
		//echo $E -> getMessage();
	}
?>

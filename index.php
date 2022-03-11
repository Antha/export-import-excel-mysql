<?php
    ob_start();
    $bpath = "";
    include "config.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Import Export Excel</title>
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo $bpath.$ico_img; ?>" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo $bpath ?>bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo $bpath ?>dist/css/AdminLTE.min.css">
        <!-- SweetAlert  style -->
        <link rel="stylesheet" href="<?php echo $bpath ?>plugins/sweetalert/sweetalert.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo $bpath ?>dist/css/skins/_all-skins.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            #excelformat>tbody>tr:nth-of-type(odd) {
                background: #c1ffc1;
            }

            #excelformat>tbody>tr:nth-of-type(even) {
                background:#dfffdf;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Export/Import Mysql Table Into Microsoft Excel Files
                <small>Dashboard</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-server"></i> Dashboard</a></li>
                <li class="active">Customers</li>
            </ol>
        </section>
        <!-- ========================================================================================================== -->
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Table Action List Of Customers</strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-wrench"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>                
                </div>
            </div>
            <div class="box-body">
                <div style="display:flex;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="btn btn-default">
                            <input type="file" name="fileexcel">
                        </div>
                        <button type="submit" class="btn btn-primary" name="import">
                            <i class="fa fa-plus"></i> Import
                        </button>
                        <button type="submit" class="btn btn-success" name='view_exm'>
                            <i class="fa fa-server"></i> Download Format
                        </button>
                    </form>
                    <form action="export.php" method="post" enctype="multipart/form-data" style="padding: 1px 4px;">
                        <button type="submit" class="btn btn-primary" name="import">
                        <i class="fa fa-plus"></i> Export</button>
                    </form>
                </div>
                <?php 
                    //If user click import button
                    if(isset($_POST["import"])){
                        //print_r($_FILES["fileexcel"]);
                        //If file is exist
                        if($_FILES["fileexcel"]["name"] != ""){
                            //Get all columns from the mysql table
                            $query_column = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'ict' AND TABLE_NAME = 'customers' AND COLUMN_NAME NOT IN('ID')";
                            $result_column = mysqli_query($link,$query_column); 
                            //This var will be used in import process 
                            $column_stmt = "";
                            while ($row_CL = mysqli_fetch_array($result_column)){
                                $column_stmt .= "`".$row_CL["COLUMN_NAME"]."`,";
                            }
                            $column_stmt = substr($column_stmt,0,'-1');
                            $table_name = "customers";
                            
                            //Define Upload Directory
                            $uploaddir = 'uploads/';
                            $uploadfile = $uploaddir . basename($_FILES["fileexcel"]["name"]);
                            if (move_uploaded_file($_FILES["fileexcel"]["tmp_name"], $uploadfile)){
                                echo "<p class='text-center'><strong>";
                                echo "File imported successfully! Table Above Are Data What You Have Been Imported";
                                echo "</strong></p>";
                            }
                            $certainfile = $uploadfile;
                            include("lib/excelreadertrans.php");
                        }else{
                            echo "<script>alert('File Is Empty')</script>";
                        }
                    }
                    if(isset($_POST["view_exm"])){
                        header("Location:file_master/customers_example.xlsx");
                    }
                ?>
                <div class="box-body" style="width: 100%; overflow:auto !important; ">
                    <!-- This is data table of the mysql table -->
                    <table id="table_ticket" class="table table-striped table-bordered table-hover" style="overflow: auto;">
                        <thead>
                            <tr class="tableheader">
                                <th>No</th>
                                <?php 
                                     //Get all columns from the mysql table
                                    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'ict' AND TABLE_NAME = 'customers' AND COLUMN_NAME NOT IN('ID')";
                                    $doquery = mysqli_query($link,$query);   
                                    while($row = mysqli_fetch_array($doquery)){ 
                                        echo "<th>".$row["COLUMN_NAME"]."</th>";
                                    }          
                                ?>
                                <th colspan="3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section>
    </body>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $bpath ?>plugins/jQuery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $bpath ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- SweetAlert -->
    <script src="<?php echo $bpath ?>plugins/sweetalert/sweetalert.min.js"></script>
    <!-- SweetAlert -->
    <script src="<?php echo $bpath ?>plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Bootstrap-notify -->
    <script src="<?php echo $bpath ?>plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="<?php echo $bpath ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $bpath ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $bpath ?>plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/customer.js"></script>
</html>

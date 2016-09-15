<?php
  session_start();
  extract($_REQUEST);

include_once 'php/conexion.php';
include_once 'php/entrar.php';



switch (@$_REQUEST['option']) {
    case 'home':
    if (isset($_SESSION['idUsu'])) {
        $include='html/home.php';
    }else{
        header("location:?option=sesion.php");
      }
        break;
    case 'logout':
        session_unset();
        session_destroy();
        header('location:?option=sesion.php');
        break;
    default:

        $include='html/sesion.php';
        break;
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Initec</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  



</head>
<body>
	<div class="container-fluid">
		<?php include ($include); ?>
	</div>

	 <script src="js/jquery.js"></script>
    <script src="js/app.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
<!--     <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script> -->
</body>
</html>

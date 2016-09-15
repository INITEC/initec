<?php 

include_once 'php/conexion.php';
include_once 'php/consults.php';



switch (@$_REQUEST['option']) {
    case 'home':
        $include='html/home.php';
        break;
    case 'proin':
        $include = 'html/proin.php';
        break;
    case 'video':
        $include = 'html/video_pro.php';
        break;
    case 'informacion':
        $include = 'html/informacion.php';
        break;
    case 'inscripcion':
        $include = 'html/inscripcion.php';
        break;
    case 'logout':
        session_unset();
        session_destroy();
        header('location:?option=home.php');
        break;
    default:

        $include='html/home.php';
        break;

        //case 'home':
    // if (isset($_SESSION['idUsu'])) {
    //     $include='html/home.php';
    // }else{
    //     header("location:?option=home.php");
    //   }
    //     break;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>INITEC WEB</title>
    <link rel="shortcut icon" href="img/favicon.ico">
	<link rel="stylesheet" href="css/bootstrap.css">
<!-- 	<link rel="stylesheet" href="css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>



    <?php include ('html/header.php'); ?>
  
        <?php include $include; ?>

		
    
    <?php
    require ('html/footer.php');
    ?>

	<script src="js/jquery-3.1.0.js"></script>
	<script src="js/app.js"></script>

	    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>

</body>
</html>
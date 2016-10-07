<?php 
session_start();
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
<html lang="es">
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

    <script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
  } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
      'into this app.';
  } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
      'into Facebook.';
  }
}

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
  });
}

window.fbAsyncInit = function() {
  FB.init({
    appId      : '328094414208994',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
});

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});

};

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log(response)
      console.log('Successful login for: ' + response.name);
      //document.getElementById('status').innerHTML =
      $('#sesion').html('<ul class="nav navbar-right top-nav"><li class="dropdown"><a href="#" class="dropdown-toggle btn" data-toggle="dropdown"><i class="glyphicon glyphicon-user">  </i>'+response.name+'<b class="caret"></b></a><ul class="dropdown-menu"><li><a href="?option=logout" out-fb><i class="glyphicon glyphicon-log-out"></i> Cerrar sesion</a></li></ul></li></ul>');
      $('.modal').fadeOut('500');

      $('.out-fb').on('click', function(event) {
        event.preventDefault();
        cerrar();
      });

  });
}
function cerrar(){
  FB.logout(function(response){

  });
}
</script>
<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
      <div class="">
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
       <h3 class="modal-title text-center" id="lineModalLabel"></h3> <br>
   </div>
   <div class="modal-body">
       <img src="img/logo-initec-426x115.png" class="ubc-log-mod" alt="">
       <!-- content goes here -->

       <form class="form-horizontal" method="post">
          <div class="form-group">
            <div class="col-xs-2"></div>
            <div class="input-group col-xs-8 esp_log">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese correo">    
            </div> 
            <div class="col-xs-2"></div>
        </div>
        <div class="form-group">
            <div class="col-xs-2"></div>
            <div class="input-group col-xs-8 esp_log">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese Contraseña">    
            </div> 
            <div class="col-xs-2"></div>
        </div>
        <div class="col-xs-4 col-md-5"></div>
        <div class="col-xs-4 col-md-2">
            <button type="submit" class="btn btn-primary btn-loge" name="inicia">INICIO SESION</button>    
        </div>
        <div class="col-xs-4 col-md-5"></div>
    </form><br><br>


    
    <fb:login-button id="btn-fb" scope="public_profile,email" onlogin="checkLoginState();">INGRESA CON FACEBOOK
</fb:login-button>


</div>
</div>
</div>
</div>


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


<!-- <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '328094414208994',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script> -->

<!-- AGREGAR LIKES Y COMPARTIR

 <div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div> -->
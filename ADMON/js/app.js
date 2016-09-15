$(document).ready(function() {
	$sesion = $('.user').attr('id');
	oprol();
	changePassword();

});

//////////////////////////////////////////////////////////
////////////////////// ROL  USUARIO /////////////////////
////////////////////////////////////////////////////////
function oprol(){
	//$sesion = $_SESSION['cod'];
	
	$.ajax({
		url: 'php/entrar.php',
		type: 'POST',
		//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
		data: {oprol: 8, sesion: $sesion},
	})
	.done(function(html) {
		
		$('select#rol').html(html);
		cambio();
	})
	.fail(function() {
		console.log("error");
	})
	
	
}

///////////////////////////////////////////////////////////
////////////////// FIN ROL USUARIO ///////////////////////
/////////////////////////////////////////////////////////

////////////////////////////////////////////////////////
////////////////// CAMBIO ROL USUARIO /////////////////
//////////////////////////////////////////////////////

function cambio(){
	$('select#rol').change(function(event){
		$('#rol option:selected').each(function(){
			$opRol = $(this).val(); 
			cargarMenu($opRol);
		});
	});
}

function cargarMenu(opRol){
	$.ajax({
		url: 'php/entrar.php',
		type: 'POST',
		data: {opRol: opRol},
	})
	.done(function(html) {
		$('.opciones-rol').html(html);
		cargaCont();
	})
	.fail(function() {
		console.log("error");
	})

	
}

////////////////////////////////////////////////////////
///////////////FIN CAMBIO ROL USUARIO /////////////////
//////////////////////////////////////////////////////

////////////////////////////////////////////////////////
///////////// CAMBIO CONTENIDO OPCION /////////////////
//////////////////////////////////////////////////////

function cargaCont(){
	$('div.opciones-rol').on('click','.rol_user',function(){
		$id = $(this).attr('id');
		opc_muestra($id);
	});

}

function opc_muestra(id){
	$.ajax({
		url: 'php/entrar.php',
		type: 'POST',
		//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
		data: {redi: id},
	})
	.done(function(data) {
		$dir = data;
		muestraCont($dir);
	})
	.fail(function() {
		console.log("error");
	})

}

function muestraCont(url){
	$.ajax({
		url: url,
		type: 'POST',
		//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
		//data: {param1: 'value1'},
	})
	.done(function(html) {
		$('div.sector').html(html);
		list_courses();
	})
	.fail(function() {
		console.log("error");
	})
	
}

////////////////////////////////////////////////////////
///////////// FIN CAMBIO CONTENIDO OPCION /////////////
//////////////////////////////////////////////////////

/********************************************************
***************** LISTAR CURSOS PROFESOR ****************
********************************************************/

function list_courses(){
	$.ajax({
		url: 'php/entrar.php',
		type: 'POST',
		//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
		data: {cursos_pro: $sesion},
	})
	.done(function(html) {
		$('.cursos_profesor').html(html);
	})
	.fail(function() {
		console.log("error");
	})

	
}

/********************************************************
*************** FIN LISTAR CURSOS PROFESOR **************
********************************************************/

/********************************************************
******************* CAMBIAR CONTRASEÑA ******************
********************************************************/

function changePassword(){
	$('.modal').on('click','#changePsw',function(event){
		event.preventDefault();
		$sesion = $('.user').attr('id');
		$act = $('#PasswordActual').val(); console.log($act);
		$new1 = $('#NewPassword').val(); console.log($new1);
		$new2 = $('#NewPassword1').val(); console.log($new2);

		
			if ($new1==$new2) 
			{
				$.ajax({
				url: 'php/entrar.php',
				type: 'POST',
				//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {cambio:5,user:$sesion,act:$act,new1:$new1},
				})
				.done(function(html) {
					console.log(html)
					$('div.mensaje').html(html);
				})
				.fail(function() {
					console.log("error");
				})
			}
			else
			{
				$("div.mensaje").html("Nueva contraseña no coinciden");
			}
		
	});

}

/********************************************************
****************FIN CAMBIAR CONTRASEÑA ******************
********************************************************/
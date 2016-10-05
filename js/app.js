$(document).ready(function() {
  slider();   
  programas();
  aliados();
});
 

/**********************************************************
************************** CARGAR SLIDE FOR HOME **********
***********************************************************/
function slider(){
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {slider: 8},
	}) 
	.done(function(html) {
		
		$('div#car-slid').html(html);
		$num = $('div#car-slid').find('.slider').length;
		butons_slid($num)
	})
}

function butons_slid(num){
	for (var i = 1; i <= num; i++) {
		if(i == 1){
			$('ol#cant-ind').html("<li data-target='#carousel-example' data-slide-to='"+(i-1)+"' class='active'></li>");
		}
		else{
			$('ol#cant-ind').append("<li data-target='#carousel-example' data-slide-to='"+(i-1)+"'></li>");
		}


    
	}
}

/**************************************************************************
**************** CARGAR PROGRAMAS DE INCUBA - PRE - ACELERA ***************
***************************************************************************/

function programas(){
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {tipo_curso: '6'},
	})
	.done(function(html) {
		$('div.services').html(html);
			$('div.services').on('click','.cont_program',function(){
				//event.preventDefault();
				$cod= $(this).attr('id');
				localStorage.setItem('code',$cod);
				//videos(localStorage.getItem('code'));
				
			});
	})
}

/***************************************************************************
***************** CARGAR ALIADOS ESTRATEGICOS ******************************
***************************************************************************/

function aliados(){
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {aliados: '9'},
	})
	.done(function(html) {
	
		$('#move').html(html);
	})
	
}

/********************************************************************************
********************** CARGA CONTENIDO PROGRAMA SELECCIONADO ********************
*********************************************************************************/

function opc_program(cod){
	
		

		$.ajax({
			url: 'php/consults.php',
			type: 'POST',
			data: {opc_prog: cod},
		})
		.done(function(html) {
			//console.log(html);
			 window.location.href = html;

		})	

	
}

/**************************************************************************************
********************* CARGA VIDEOS DE PROGRAMA SELECCIONADO ***************************
***************************************************************************************/

function videos(code){
	
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {videos: code},
	})
	.done(function(html) {
		$('div.historias').html(html);
	})

}

function color_sel(opc){
	$(opc).addClass('selected_opc');	
}

//console.log(localStorage.getItem('code'))
videos(localStorage.getItem('code'));
infograma(localStorage.getItem('code'));

function infograma(cod){
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {infograma: cod},
	})
	.done(function(data) {
		//console.log(data);
		$('div.infograma').html(data);
		cursos(localStorage.getItem('code'));
		head(localStorage.getItem('code'));
	})
	
}

function head(dat){
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {head: dat},
	})
	.done(function(data) {
		//console.log(data);
		$('.banner').html(data);
	})
	
}


function cursos(dat){
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {cursos: dat},
	})
	.done(function(html) {
		$('.cur_prin').html(html);
		complementarios(localStorage.getItem('code'));
	})
}

function complementarios(dat){
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {complementarios: dat},
	})
	.done(function(html) {
		//console.log(html);
		$('div.cur_comp').html(html);
		galeria(localStorage.getItem('code'));
	})
	
}

function galeria(code){
	$.ajax({
		url: 'php/consults.php',
		type: 'POST',
		data: {galeria: code},
	})
	.done(function(data) {
		//console.log(data);
		$('div#images_galeria').html(data);
	})
	
}
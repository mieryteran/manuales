addEvent(window,'load',iniciarEventos,false);

function iniciarEventos() {
	var boton = document.getElementById('buscar');
	addEvent(boton,'click',presion,false);
}

function presion() {
	var archivo = document.getElementById('opciones').value;
	cargarDatos(archivo);
}
var conexion;
var reloj;
function cargarDatos(archivo) {
	conexion = crearXMLHttpRequest();
	conexion.onreadystatechange = requerimientoAjax;
	conexion.open('GET','archivero.php?id='+archivo,true);
	conexion.send(null);
	reloj = setTimeout(detener,2000);
}

function detener() {
	var resultado = document.getElementById('resultado');
	conexion.abort();
	resultado.innerHTML = 'tiempo expiro';
}

function requerimientoAjax() {
	var resultado = document.getElementById('resultado');
	if (conexion.readyState == 4) {
		if(conexion.status == 200){
				clearTimeout(reloj);
				var data = conexion.responseText;
				resultado.innerHTML = data;
				
		} else if(conexion.status == 404) {
				clearTimeout(reloj);
				resultado.innerHTML = conexion.statusText;
		}
	} else {
		resultado.innerHTML = 'Cargando..';
	}
}

function crearXMLHttpRequest() {
var xmlHttp = null;
if (window.ActiveXObject) {
	xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
} else if (window.XMLHttpRequest) {
	xmlHttp = new XMLHttpRequest();
}
return xmlHttp;
}

function addEvent(elemento,evento,funcion,capture) {
if (elemento.attachEvent) {
	elemento.attachEvent('on'+evento,funcion);
	return true;
} else if (elemento.addEventListener) {
	elemento.addEventListener(evento,funcion,capture);
	return true;
} else {
	return false;
}
}

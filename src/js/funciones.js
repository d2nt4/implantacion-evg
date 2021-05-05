function confirmar(texto, ruta)
{
	if(confirm(texto))
		location.href=ruta;
}
var deshabilitar=[];
//-----------------------------AJAX-----------------------------//
function buscarCSU(baseURL, tabla, valor, campo, idDiv, textoBase, permitido)
{
	var infoAjax=document.getElementById(idDiv);
	if (valor != '')
	{
		if (permitido==undefined || valor.toUpperCase() != permitido.toUpperCase())/* si el valor escrito es el valor permitido, no deshabilita el botón de enviar */
		{
			$.ajax
			({
				type: "POST",
				url: baseURL + 'C_GestionEVG/comprobarCSU',
				data: {campo:campo, valor:valor, tabla:tabla},
				success: function (datos)
				{
					if (datos == 'no')
					{
						deshabilitar[idDiv]=false;
						infoAjax.style.opacity = '0';
						infoAjax.innerHTML = '';
					}
					else
					{
						deshabilitar[idDiv]=true;
						infoAjax.style.opacity = '1';
						infoAjax.innerHTML = textoBase + valor;
					}
					comprobarBotonEnviar();
				}
			})
		}
		else
		{
			infoAjax.innerHTML = '';
			deshabilitar[idDiv]=false;
			infoAjax.style.opacity = '0';
			comprobarBotonEnviar();
		}
	}
	else
	{
		deshabilitar[idDiv]=true;
		infoAjax.style.opacity = '0';
		infoAjax.innerHTML = '';
		comprobarBotonEnviar();
	}
// Si cambio el async no haría falta poner cuatro veces la función comprobarBotonEnviar(), de hecho no haría falta la función
}

function comprobarBotonEnviar()
{
	enviar=document.getElementsByName('enviar')[0];
	enviar.disabled=false;
	for(indice in deshabilitar)
	{
		if(deshabilitar[indice])
			enviar.disabled=true;
	}
}

//-----------------------------FINAL AJAX
function info(texto)
{
	var cuadroInfo=document.getElementById("cuadroInfo")
	if(cuadroInfo.innerHTML=='')
	{
		cuadroInfo.innerHTML=texto;
		cuadroInfo.innerHTML+='<button onclick="info()">Cerrar</button>';
	}
	else
		cuadroInfo.innerHTML="";
}

function buscarUsuarios(baseURL, idPerfil, valor)
{
	if(valor!='')
		$.ajax
		({
			type: "POST",
			url: baseURL + 'C_GestionEVG/comprobarUsuarios',
			data: 'idPerfil='+idPerfil+'&valor='+valor,
			success: function (datos)
			{
				datos=JSON.parse(datos);
				document.getElementsByClassName('sugerenciaAjax')[0].innerHTML='';
				for(i=0;i<datos.length;i++)
					document.getElementsByClassName('sugerenciaAjax')[0].innerHTML+='<button onclick="escribir(\'correo\', this.innerHTML)">'+datos[i].correo+'</button><br/>';
				if(datos=='')
					document.getElementsByClassName('sugerenciaAjax')[0].innerHTML='<button>Sin coincidencias</button>';
			}
		})
	else
		document.getElementsByClassName('sugerenciaAjax')[0].innerHTML='';
}

function escribir(name, valor)
{
	document.getElementsByName(name)[0].value=valor;
}
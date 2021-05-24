/**
 * @function confirmar - Función para confirmar las distintas acciones que pueden realizarse en el sistema.
 * @param {string} texto - Texto a mostrar en el body del modal.
 * @param {string} ruta - Ruta que se envía para ejecutar una acción en la aplicación.
 * @param {string} header - Texto a mostrar en el head del modal.
 * @param {string} botonCancelar - Texto a mostrar en el botón de cancelar (izquierdo) del modal.
 * @param {string} botonConfirmar -  Texto a mostrar en el botón de confirmar (derecho) del modal.
*/
function confirmar(texto, ruta, header, botonCancelar, botonConfirmar)
{
	$('#principal').after
	(
		`
			<!--Bootstrap Modal-->
			<div id="myModal" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><b>` + header + `</b></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="eliminarModal()">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>` + texto + `</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary font-weight-bolder" data-dismiss="modal" onclick="eliminarModal()">`+ botonCancelar +`</button>
							<button type="button" class="btn btn-danger font-weight-bolder" onclick="location.href = '` + ruta + `'">` + botonConfirmar + `</button>
						</div>
					</div>
				</div>
			</div>
		`
	)
	;
}

/**
 * @function eliminarModal - Función para eliminar el modal tras cierre
*/
function eliminarModal()
{
	const body = document.getElementsByTagName('body')[0];
	const modal = document.getElementById('myModal');
	body.removeChild(modal);
}

/**
 * @function buscarCSU - Función para buscar y comprobar datos con AJAX.
 * @param {string} baseURL - URL base del proyecto.
 * @param {string} tabla - Tabla a realizar la consulta.
 * @param {string} valor - Valor a contrastar con la base de datos.
 * @param {string} campo - Campo de la tabla de la base de datos a comprobar.
 * @param {string} idHTML -  ID del elemento HTML a mostrar el resultado de la consulta.
 * @param {string} idInput - ID del input para colorear el borde de rojo cuando hay un fallo.
 * @param {string} textoBase - Resultado obtenido de la consulta.
 * @param {string} permitido - Valor para poder modificar una fila si ya existe, es decir, modificar la descripción de una aplicación en la que no modificas su nombre (si no le pasas este valor, el sistema no dejará modificar ya que existe una aplicación con este nombre).
 */
var deshabilitar = [];
function buscarCSU(baseURL, tabla, valor, campo, idHTML, idInput, textoBase, permitido)
{
	const infoAjax = document.getElementById(idHTML);
	const input = document.getElementById(idInput);
	if (valor != '')
	{
		if (permitido == undefined || valor.toUpperCase() != permitido.toUpperCase())
		{
			$.ajax
			({
				type: "POST",
				url: baseURL + 'C_GestionEVG/comprobarCSU',
				data: {campo:campo, valor:valor, tabla:tabla},
				async: true,
				success: function (datos)
				{
					if (datos == 'no')
					{
						deshabilitar[idHTML] = false;
						infoAjax.style.display = 'none';
						input.style.border = 'unset';
						infoAjax.innerHTML = '';
					}
					else
					{
						deshabilitar[idHTML] = true;
						infoAjax.style.display = 'block';
						input.style.border = '2px solid red';
						infoAjax.innerHTML = textoBase + valor;
					}
				}
			})
		}
		else
		{
			deshabilitar[idHTML] = false;
			infoAjax.style.display = 'none';
			input.style.border = 'unset';
			infoAjax.innerHTML = '';
		}
	}
	else
	{
		deshabilitar[idHTML] = true;
		infoAjax.style.display = 'none';
		input.style.border = 'unset';
		infoAjax.innerHTML = '';
	}
	comprobarBotonEnviar();
}

/**
 * @function comprobarBotonEnviar - Comprobar botón de enviar para evitar que se inserte un dato que ya existe. 
 */
function comprobarBotonEnviar()
{
	enviar = document.getElementsByName('enviar')[0];
	enviar.disabled = false;
	for(indice in deshabilitar)
	{
		if(deshabilitar[indice])
			enviar.disabled = true;
	}
}

/**
 * @function buscarUsuarios - Función para buscar usuarios en la base de datos.
 * @param {string} baseURL - URL base del proyecto.
 * @param {number} idPerfil - Identificador de la fila del usuario.
 * @param {string} valor - Input a buscar en la base de datos.
 */
 function buscarUsuarios(baseURL, idPerfil, valor)
 {
	 if(valor != '')
		 $.ajax
		 ({
			 type: "POST",
			 url: baseURL + 'C_GestionEVG/comprobarUsuarios',
			 data: 'idPerfil=' + idPerfil + '&valor=' + valor,
			 success: function (datos)
			 {
				 datos = JSON.parse(datos);
				 document.getElementsByClassName('sugerenciaAjax')[0].innerHTML = '';
				 for(let i = 0; i < datos.length; i++)
					 document.getElementsByClassName('sugerenciaAjax')[0].innerHTML += '<button onmousedown="escribir(\'correo\', this.innerHTML)">'+datos[i].correo+'</button></br>';
				 if(datos == '')
					 document.getElementsByClassName('sugerenciaAjax')[0].innerHTML = '<button>Sin coincidencias</button>';
			 }
		 })
	 else
		 document.getElementsByClassName('sugerenciaAjax')[0].innerHTML = '';
 }

/**
 * @function escribir - Función para seleccionar el correo del usuario tras la búsqueda de AJAX.
 * @param {string} name -  Elemento HTML.
 * @param {string} valor - Correo del usuario.
 */
function escribir(name, valor)
{
	document.getElementsByName(name)[0].value = valor;
}

/**
 * @function function - Función para mostrar y ocultar el menú aside.
 */
$(document).ready(function ()
{
	$('#sidebarCollapse').on('click', function ()
	{
		$('#sidebar').toggleClass('active');
		$('aside').toggleClass('show');
	});
});

/**
 * @function previsualizarImagen - Función para previsualizar la imagen antes de subirla.
 */
function previsualizarImagen(input)
{
	if (input.files && input.files[0])
	{
		var reader = new FileReader();
		reader.onload = function (e)
		{
			$('#test').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

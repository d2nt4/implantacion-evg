<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * C_GestionEVG
 * 
 * Clase que contiene todos los métodos necesario para la aplicación.
 * 
 * @author Abraham Núñez Palos y Daniel Torres Galindo
 */
class C_GestionEVG extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();

		$this -> load -> helper('form');
		$this -> load -> library('form_validation');
		$this -> load -> helper('url');
		$this -> load -> model('M_GestionEVG');
		$this -> load -> library('google');
		$this -> load -> library('excel');

		$data['google_login_url'] = $this -> google -> get_login_url();

        if($this->session->userdata('sess_logged_in') == 0 || !$idUsuario=$this->M_GestionEVG->obtenerIdUsuario($_SESSION['email']))
		{
        	redirect('Auth');
		}
		else
		{
        	$acceso = false;

			$aplicaciones = $this -> M_GestionEVG -> seleccionar('Aplicaciones a','distinct(a.url), a.nombre, a.icono',"idUsuario=".$idUsuario,['Aplicaciones_Perfiles ap','Perfiles_Usuarios pu'], ['a.idAplicacion= ap.idAplicacion','pu.idPerfil=ap.idPerfil'], ['join','join']);
			foreach($aplicaciones as $valor)
				if( $valor['nombre'] == 'GestionEVG' || $valor['nombre'] == 'AdministracionEVG' )
					$acceso=true;

			if(!$acceso)
				redirect('Grid');
		}
	}
	
	/**
	 * index
	 * 
	 * Redirige al Grid.
	 *
	 * @return void
	 */
	public function index()
	{
		redirect('Grid');

	}
	
	/**
	 * comprobarCSU
	 * 
	 * Comprueba que no se repitan los mismos valores.
	 *
	 * @return void
	 */
	public function comprobarCSU()
	{
		$numeroFilas = $this -> M_GestionEVG -> seleccionar($_POST['tabla'],$_POST['campo'],$_POST['campo']."='".$_POST['valor']."'");

		if (!empty($numeroFilas))
			echo('si');
		else
			echo('no');
	}
	
	/**
	 * comprobarUsuarios
	 * 
	 * Busca usuarios en la base de datos.
	 *
	 * @return void
	 */

	public function comprobarUsuarios()
	{
		$usuarios = $this -> M_GestionEVG -> seleccionar('Usuarios','*',"idUsuario NOT IN(
			SELECT idUsuario
			FROM Perfiles_Usuarios
			WHERE idPerfil=".$_POST['idPerfil']."
		) AND correo LIKE ('%".$_POST['valor']."%')");
		echo(json_encode($usuarios));
	}

		/*APLICACIONES*/
	
	/**
	 * verApps
	 * 
	 * Permite ver todos las aplicaciones existente.
	 *
	 * @return void
	 */

	public function verApps()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Aplicaciones','idAplicacion, nombre');
		foreach ($lista as $valor)
			$this -> listaApps[$valor['idAplicacion']] = $valor['nombre'];

		$this -> load -> view('C_Aplicaciones/V_Aplicaciones');
	}
	
	/**
	 * anadirAppForm
	 * 
	 * Muestra el formulario para añadir la aplicación.
	 *
	 * @return void
	 */

	public function anadirAppForm()
	{
		$this -> load -> view("C_Aplicaciones/V_AnadirApp");
	}
	
	/**
	 * anadirApp
	 * 
	 * Añade la aplicación a la base de datos.
	 *
	 * @return void
	 */

	public function anadirApp()
	{
		$datos["nombre"] = $_POST["nombre"];
		$datos["descripcion"] = $_POST["descripcion"];
		$datos["url"] = $_POST["url"];

		$destino = 'uploads/iconos/';
		$archivo_nombre = $_FILES["icono"]["name"];
		if (file_exists($destino . $archivo_nombre)) 
		{
			$contador = 0;
			while (file_exists($destino . ++$contador . "-" . $archivo_nombre));
			$archivo_nombre = $contador . "-" . $archivo_nombre;
		}
		$archivo_temporal = $_FILES["icono"]["tmp_name"]; /*Direccion temporal donde se va a guardar el archivo*/
		copy($archivo_temporal, $destino . $archivo_nombre); /*Copia el archivo de la carpeta temporal a la carpeta destino en el servidor*/
		$datos['icono'] = $archivo_nombre;

		$this-> M_GestionEVG-> insertar('Aplicaciones',$datos);

		$this->headerLocation("C_GestionEVG/verApps");
	}
	
	/**
	 * borrarApp
	 *
	 * Elimina la aplicación de la base de datos.
	 * 
	 * @param  integer $idAplicacion Identificador de la aplicación.
	 * @return void
	 */

	public function borrarApp($idAplicacion)
	{
		$iconoActual = $this -> M_GestionEVG -> seleccionar('Aplicaciones', 'icono', 'idAplicacion='.$idAplicacion);
		$iconoActual = $iconoActual[0]['icono'];
		if(file_exists('uploads/iconos/'.$iconoActual))
			unlink('uploads/iconos/'.$iconoActual);

		$this -> M_GestionEVG -> borrar('Aplicaciones',$idAplicacion,'idAplicacion');

		$this->headerLocation("C_GestionEVG/verApps");
	}
	
	/**
	 * modificarAppForm
	 *
	 * Muestra un formulario con los datos de la aplicación.
	 * 
	 * @param  integer $idAplicacion Identificador de la aplicación.
	 * @return void
	 */

	public function modificarAppForm($idAplicacion)
	{
		$this -> datosApp = $this -> M_GestionEVG -> seleccionar('Aplicaciones','nombre, descripcion, url, icono','idAplicacion='.$idAplicacion);
		$this -> load -> view("C_Aplicaciones/V_ModificarApp", Array('idAplicacion' => $idAplicacion));
	}
	
	/**
	 * modificarApp
	 *
	 * Actualiza los datos de la aplicación en la base de datos.
	 * 
	 * @param  integer $idAplicacion Identificador de la aplicación
	 * @return void
	 */

	public function modificarApp($idAplicacion)
	{
		$datos["nombre"] = $_POST["nombre"];
		$datos["descripcion"] = $_POST["descripcion"];
		$datos["url"] = $_POST["url"];

		if(!empty($_FILES['icono']['name']))
		{
			$iconoActual = $this -> M_GestionEVG -> seleccionar('Aplicaciones', 'icono', 'idAplicacion='.$idAplicacion);
			$iconoActual = $iconoActual[0]['icono'];
			if(file_exists('uploads/iconos/'.$iconoActual))
				unlink('uploads/iconos/'.$iconoActual);

			$destino = 'uploads/iconos/';
			$archivo_nombre = $_FILES["icono"]["name"];
			if (file_exists($destino . $archivo_nombre)) 
			{
				$contador = 0;
				while (file_exists($destino . ++$contador . "-" . $archivo_nombre));
				$archivo_nombre = $contador . "-" . $archivo_nombre;
			}
			$archivo_temporal = $_FILES["icono"]["tmp_name"]; /*Direccion temporal donde se va a guardar el archivo*/
			copy($archivo_temporal, $destino . $archivo_nombre); /*Copia el archivo de la carpeta temporal a la carpeta destino en el servidor*/
			$datos['icono'] = $archivo_nombre;
		}

		$this -> M_GestionEVG -> modificar('Aplicaciones',$datos,$idAplicacion,'idAplicacion');

		$this->headerLocation("C_GestionEVG/verApps");
	}
	
	/**
	 * perfilesAplicacion
	 *
	 * Muestra los perfiles que están asociado a la aplicación, 
	 * ademas de todos los perfiles para poder añadir o quitar perfiles.
	 * 
	 * @param  integer $idAplicacion Identificador de la aplicación.
	 * @return void
	 */

	public function perfilesAplicacion($idAplicacion)
	{
		$nombreApp = $this -> M_GestionEVG -> seleccionar('Aplicaciones','nombre, descripcion, url, icono','idAplicacion='.$idAplicacion);
		$nombreApp = $nombreApp[0]['nombre'];

		$lista = $this -> M_GestionEVG -> seleccionar('Perfiles p','p.idPerfil, p.nombre','ap.idAplicacion='.$idAplicacion, ['Aplicaciones_Perfiles ap'],['p.idPerfil = ap.idPerfil']);
		foreach($lista as $valor)
			$this -> perfilesAplicacion[$valor['idPerfil']] = $valor['nombre'];

		$lista2 = $this -> M_GestionEVG -> seleccionar('Perfiles p','p.idPerfil, p.nombre','p.idPerfil NOT IN (SELECT ap2.idPerfil FROM Aplicaciones_Perfiles ap2 WHERE ap2.idAplicacion='.$idAplicacion.')');
		foreach($lista2 as $valor)
			$this -> perfilesNoAplicacion[$valor['idPerfil']] = $valor['nombre'];

		$this -> load -> view('C_Aplicaciones/V_PerfilesAplicaciones', Array('idAplicacion'=>$idAplicacion, 'nombreApp'=>$nombreApp));
	}
	
	/**
	 * quitarPerfilAplicacion
	 *
	 * Permite quitar perfiles a una aplicación.
	 * 
	 * @param  integer $idAplicacion Identificador de la aplicación.
	 * @param  integer $idPerfil Identificador del perfil.
	 * @return void
	 */

	public function quitarPerfilAplicacion($idAplicacion, $idPerfil)
	{
		$this -> M_GestionEVG -> borrarCompuesta('Aplicaciones_Perfiles',$idPerfil, $idAplicacion, 'idPerfil', 'idAplicacion');

		$this->headerLocation("C_GestionEVG/perfilesAplicacion/".$idAplicacion);
	}
	
	/**
	 * anadirPerfilAplicacion
	 *
	 * Permite añadir perfiles a una aplicación.
	 * 
	 * @param  integer $idAplicacion Identificador de la aplicación.
	 * @param  integer $idPerfil  Identificador del perfil.
	 * @return void
	 */

	public function anadirPerfilAplicacion($idAplicacion, $idPerfil)
	{
		$this -> M_GestionEVG -> insertar('Aplicaciones_Perfiles',array('idPerfil'=>$idPerfil,'idAplicacion'=>$idAplicacion));

		$this->headerLocation("C_GestionEVG/perfilesAplicacion/".$idAplicacion);
	}

		/*PERFILES*/
	
	/**
	 * verPerfiles
	 * 
	 * Muestra los perfiles.
	 *
	 * @return void
	 */

	public function verPerfiles()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Perfiles','idPerfil, nombre');
		foreach ($lista as $valor)
			$this -> listaPerfiles[$valor['idPerfil']] = $valor['nombre'];

		$this -> load -> view('C_Perfiles/V_Perfiles');
	}
	
	/**
	 * anadirPerfilForm
	 * 
	 * Muestra el formulario para añadir un perfil.
	 *
	 * @return void
	 */

	public function anadirPerfilForm()
	{
		$this -> load -> view("C_Perfiles/V_AnadirPerfil");
	}
	
	/**
	 * anadirPerfil
	 * 
	 * Añade el perfil a la base de datos.
	 *
	 * @return void
	 */

	public function anadirPerfil()
	{
		$datos["nombre"] = $_POST["nombre"];
		$datos["descripcion"] = $_POST["descripcion"];

		$this -> M_GestionEVG -> insertar('Perfiles',$datos);

		$this->headerLocation("C_GestionEVG/verPerfiles");
	}
	
	/**
	 * borrarPerfil
	 * 
	 * Elimina el perfil de la base de datos.
	 *
	 * @param  integer $idPerfil Identificador del perfil.
	 * @return void
	 */
	
	public function borrarPerfil($idPerfil)
	{
		$this -> M_GestionEVG -> borrar('Perfiles',$idPerfil,'idPerfil');

		$this->headerLocation("C_GestionEVG/verPerfiles");
	}
	
	/**
	 * modificarPerfilForm
	 * 
	 * Muestra el formulario con los datos del perfil a modificar.
	 *
	 * @param  integer $idPerfil Identificador del perfil.
	 * @return void
	 */

	public function modificarPerfilForm($idPerfil)
	{
		$this -> datosPerfil = $this -> M_GestionEVG -> seleccionar('Perfiles','nombre, descripcion','idPerfil='.$idPerfil);
		$this -> load -> view("C_Perfiles/V_ModificarPerfil", Array('idPerfil' => $idPerfil));
	}
	
	/**
	 * modificarPerfil
	 *
	 * Actualiza los datos del perfil en la base de datos.
	 * 
	 * @param  integer $idPerfil Identificador del perfil.
	 * @return void
	 */

	public function modificarPerfil($idPerfil)
	{
		$datos["nombre"] = $_POST["nombre"];
		$datos["descripcion"] = $_POST["descripcion"];

		$this -> M_GestionEVG -> modificar('Perfiles',$datos,$idPerfil,'idPerfil');

		$this->headerLocation("C_GestionEVG/verPerfiles");
	}
	
	/**
	 * usuariosPerfil
	 *
	 * Muestra los usuario que tiene el perfil,
	 * dando la opción de añadir o quitar a los usuarios.
	 * 
	 * @param  integer $idPerfil Identificador del perfil.
	 * @return void
	 */

	public function usuariosPerfil($idPerfil)
	{
		$nombre = $this -> M_GestionEVG -> seleccionar('Perfiles','nombre, descripcion','idPerfil='.$idPerfil);
		$nombre = $nombre[0]['nombre'];

		$lista = $this -> M_GestionEVG -> seleccionar('Usuarios u','u.idUsuario, u.correo','pu.idPerfil='.$idPerfil,['Perfiles_Usuarios pu'],['pu.idUsuario = u.idUsuario']);
		foreach($lista as $valor)
			$this -> usuariosPerfil[$valor['idUsuario']] = $valor['correo'];

		$this -> load -> view('C_Perfiles/V_UsuariosPerfil', Array('idPerfil' => $idPerfil, 'nombre' => $nombre));
	}
	
	/**
	 * quitarUsuarioPerfil
	 *
	 * Quita usuarios del perfil
	 * 
	 * @param  integer $idPerfil Identificador del perfil.
	 * @param  integer $idUsuario Identificador del usuario.
	 * @return void
	 */

	public function quitarUsuarioPerfil($idPerfil,$idUsuario)
	{
		$this -> M_GestionEVG -> borrarCompuesta('Perfiles_Usuarios',$idPerfil, $idUsuario, 'idPerfil', 'idUsuario');

		$this->headerLocation("C_GestionEVG/usuariosPerfil/".$idPerfil);
	}
	
	/**
	 * anadirUsuarioPerfil
	 *
	 * Añade usuario al perfil.
	 * 
	 * @param  int $idPerfil Identificador del perfil
	 * @return void
	 */

	public function anadirUsuarioPerfil($idPerfil)
	{
		if($idUsuario = $this -> M_GestionEVG -> obtenerIdUsuario($_POST['correo']))
		{
			$perfil = $this -> M_GestionEVG -> seleccionar('Perfiles_Usuarios', '*', 'idUsuario='.$idUsuario.' and idPerfil='.$idPerfil);
			if(empty($perfil[0]))
				$this -> M_GestionEVG -> insertar('Perfiles_Usuarios',array('idPerfil'=>$idPerfil,'idUsuario'=>$idUsuario));
		}

		$this->headerLocation("C_GestionEVG/usuariosPerfil/".$idPerfil);
	}



		/*USUARIOS*/
	
	/**
	 * verUsuarios
	 * 
	 * Muestra los usuarios existentes.
	 *
	 * @return void
	 */

	public function verUsuarios()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Usuarios','idUsuario, correo, bajaTemporal');
		foreach ($lista as $valor)
		{
			$this -> listaUsuarios[$valor['idUsuario']] = $valor['correo'];
			$this -> listaBajaTemporal[$valor['idUsuario']] = $valor['bajaTemporal'];
		}

		$this -> load -> view('C_Usuarios/V_Usuarios');
	}
	
	/**
	 * anadirUsuarioForm
	 * 
	 * Muestra el formulario para añadir a un usuario.
	 *
	 * @return void
	 */

	public function anadirUsuarioForm()
	{
		$this -> load -> view("C_Usuarios/V_AnadirUsuario");
	}
	
	/**
	 * anadirUsuario
	 * 
	 * Añade un usuario a la base de datos.
	 *
	 * @return void
	 */

	public function anadirUsuario()
	{
		$datos["nombre"] = $_POST["nombre"];
		$datos["correo"] = $_POST["correo"];

		$idUsuario = $this -> M_GestionEVG -> insertar('Usuarios',$datos);

		$idPerfil = $this -> M_GestionEVG -> seleccionar('Perfiles', 'idPerfil', "nombre='profesor'");
		if(isset($_POST['profesor']))
			$this -> M_GestionEVG -> insertar('Perfiles_Usuarios', Array('idPerfil' => $idPerfil[0]['idPerfil'],'idUsuario' => $idUsuario));

		$this->headerLocation("C_GestionEVG/verUsuarios");
	}
	
	/**
	 * borrarUsuario
	 * 
	 * Elimina a un usuario de la base de datos.
	 *
	 * @param  integer $idUsuario Identificador del usuario.
	 * @return void
	 */
	public function borrarUsuario($idUsuario)
	{
		$this -> M_GestionEVG -> borrar('Usuarios', $idUsuario, 'idUsuario');

		$this->headerLocation("C_GestionEVG/verUsuarios");
	}
	
	/**
	 * modificarUsuarioForm
	 * 
	 * Muestra un formulario para modificar los datos del usuario.
	 *
	 * @param  integer $idUsuario Identificador del usuario.
	 * @return void
	 */

	public function modificarUsuarioForm($idUsuario)
	{
		$this -> datosUsuario = $this -> M_GestionEVG -> seleccionar('Usuarios','nombre, correo, bajaTemporal','idUsuario='.$idUsuario);
		$this -> load -> view("C_Usuarios/V_ModificarUsuario", Array('idUsuario' => $idUsuario));
	}
	
	/**
	 * modificarUsuario
	 * 
	 * Actualiza los datos del usuario.
	 *
	 * @param  integer $idUsuario Identificador del usuario.
	 * @return void
	 */

	public function modificarUsuario($idUsuario)
	{
		$datos["nombre"] = $_POST["nombre"];
		$datos["correo"] = $_POST["correo"];
		if(isset($_POST["bajaTemporal"]))
			$datos["bajaTemporal"] = 1;
		else
			$datos["bajaTemporal"] = 0;

		$this -> M_GestionEVG -> modificar('Usuarios',$datos,$idUsuario,'idUsuario');

		$this->headerLocation("C_GestionEVG/verUsuarios");
	}
	
	/**
	 * importarUsuariosForm
	 * 
	 * Muestrea el formualario para importar a los usuarios.
	 *
	 * @return void
	 */

	public function importarUsuariosForm()
	{
		$this -> load -> view('C_Usuarios/V_ImportarUsuarios');
	}
	
	/**
	 * importarUsuarios
	 * 
	 * Importa a los usuarios de un documento excel añadiendo los datos a la base de datos.
	 *
	 * @return void
	 */

	public function importarUsuarios()
	{
		$destino = 'uploads/'; /*Lugar donde se guardará el archivo subido al servidor*/
		$archivo_nombre = $_FILES["archivo"]["name"]; /*Guarda el nombre del archivo*/
		if(file_exists($destino.$archivo_nombre)){
			$contador = 0;
			while(file_exists($destino.++$contador."-".$archivo_nombre));
			$archivo_nombre = $contador."-".$archivo_nombre;
		}
		$archivo_temporal = $_FILES["archivo"]["tmp_name"]; /*Direccion temporal donde se va a guardar el archivo*/
		copy($archivo_temporal,$destino.$archivo_nombre); /*Copia el archivo de la carpeta temporal a la carpeta destino en el servidor*/

		$object = PHPExcel_IOFactory::load($_FILES["archivo"]["tmp_name"]);
		foreach($object -> getWorksheetIterator() as $worksheet) {
			$highestRow = $worksheet->getHighestRow();
			for ($row = 2; $row <= $highestRow; $row++){
				$nombre = $worksheet -> getCellByColumnAndRow(0, $row) -> getValue();
				if(empty($nombre))/* por si la tabla tiene una longitud máxima mayor que los datos que tiene*/
					break;
				$correo = $this -> M_GestionEVG -> seleccionar('Usuarios', 'correo', "correo='".$worksheet -> getCellByColumnAndRow(1, $row) -> getValue()."'");
				if(empty($correo[0]['correo']))
				{
					$datos[$row]['nombre'] = $nombre;
					$datos[$row]['correo'] = $worksheet -> getCellByColumnAndRow(1, $row) -> getValue();
					$datos[$row]['profesor'] = $worksheet -> getCellByColumnAndRow(2, $row) -> getValue();
				}
			}
		}
		foreach($datos as $valor)
		{
			$idUsuario = $this -> M_GestionEVG -> insertar('Usuarios', Array('nombre' => $valor['nombre'], 'correo' => $valor['correo']));
			if($valor['profesor'] == 'si') 
			{
				$idPerfil = $this -> M_GestionEVG -> seleccionar('Perfiles', 'idPerfil', "nombre='Profesor'");
				$this -> M_GestionEVG -> insertar('Perfiles_Usuarios', Array('idPerfil' => $idPerfil[0]['idPerfil'], 'idUsuario' => $idUsuario));
			}
		}

		$this->headerLocation("C_GestionEVG/verUsuarios");
	}

		/*ETAPAS*/
	
	/**
	 * verEtapas
	 * 
	 * Muestra las etapas existente.
	 *
	 * @return void
	 */

	public function verEtapas()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Etapas','idEtapa, codEtapa');
		foreach ($lista as $valor)
			$this -> listaEtapas[$valor['idEtapa']] = $valor['codEtapa'];

		$this -> load -> view('C_Etapas/V_Etapas');
	}
	
	/**
	 * anadirEtapaForm
	 * 
	 * Muestra un formualario para añadir las etapas.
	 *
	 * @return void
	 */
	
	public function anadirEtapaForm()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Usuarios','idUsuario, correo');
		$this -> usuarios = array(0=>'Ninguno');
		foreach ($lista as $valor)
			$this -> usuarios[$valor['idUsuario']] = $valor['correo'];

		$this -> load -> view("C_Etapas/V_AnadirEtapa");
	}
	
	/**
	 * anadirEtapa
	 * 
	 * Añade la etapa a la base de datos.
	 *
	 * @return void
	 */

	public function anadirEtapa()
	{
		$datos["codEtapa"] = $_POST["codEtapa"];
		$datos["nombre"] = $_POST["nombre"];
		if($_POST['idCoordinador'] != 0)
			$datos["idCoordinador"] = $_POST["idCoordinador"];

		$this -> M_GestionEVG -> insertar('Etapas',$datos);

		$this->headerLocation("C_GestionEVG/verEtapas");
	}
	
	/**
	 * borrarEtapa
	 *
	 * Borra la etapa de la base de datos.
	 * 
	 * @param  integer $idEtapa Identificador de la etapa.
	 * @return void
	 */

	public function borrarEtapa($idEtapa)
	{
		$this -> M_GestionEVG -> borrar('Etapas',$idEtapa,'idEtapa');

		$this->headerLocation("C_GestionEVG/verEtapas");
	}
	
	/**
	 * modificarEtapaForm
	 * 
	 * Muestra un formulario para modificar los datos de una etapa.
	 *
	 * @param  integer $idEtapa Identificador de la etapa.
	 * @return void
	 */

	public function modificarEtapaForm($idEtapa)
	{
		$this -> datosEtapa = $this -> M_GestionEVG -> seleccionar('Etapas','codEtapa, nombre, idCoordinador','idEtapa='.$idEtapa);

		$lista = $this -> M_GestionEVG -> seleccionar('Usuarios','idUsuario, correo');
		$this -> usuarios = array(0=>'Ninguno');
		foreach($lista as $valor)
			$this -> usuarios[$valor['idUsuario']] = $valor['correo'];

		$this -> load -> view("C_Etapas/V_ModificarEtapa", Array('idEtapa' => $idEtapa ));
	}
	
	/**
	 * modificarEtapa
	 *
	 * Actualiza la etapa de la base de datos.
	 * 
	 * @param  integer $idEtapa Identificador de la etapa.
	 * @return void
	 */

	public function modificarEtapa($idEtapa)
	{
		$datos["codEtapa"] = $_POST["codEtapa"];
		$datos["nombre"] = $_POST["nombre"];
		if($_POST['idCoordinador'] != 0)
			$datos["idCoordinador"] = $_POST["idCoordinador"];
		else
			$datos['idCoordinador'] = null;

		$this -> M_GestionEVG -> modificar('Etapas',$datos,$idEtapa,'idEtapa');

		$this->headerLocation("C_GestionEVG/verEtapas");
	}
	
	/**
	 * etapaPadre
	 *
	 * Muestra las etapas padres a la que pertenece,
	 * ademas de permitir añadir o quitar de una etapa padre.
	 * 
	 * @param  integer $idEtapa Identificador de la etapa.
	 * @return void
	 */

	public function etapaPadre($idEtapa)
	{
		$codEtapa = $this -> M_GestionEVG->seleccionar('Etapas','codEtapa, nombre, idCoordinador','idEtapa='.$idEtapa);
		$codEtapa = $codEtapa[0]['codEtapa'];

		$lista = $this -> M_GestionEVG -> seleccionar('Etapas e','e.idEtapa, S.idEtapaPadre,E2.codEtapa','e.idEtapa='.$idEtapa,['Subetapas S','Etapas E2'], ['e.idEtapa = S.idEtapa','S.idEtapaPadre=E2.idEtapa'],['join','join']);
		foreach($lista as $valor)
			$this -> etapasPadre[$valor['idEtapaPadre']] = $valor['codEtapa'];

		$lista2 = $this -> M_GestionEVG->seleccionar('Etapas e','e.idEtapa, e.codEtapa','e.idEtapa!='.$idEtapa.' AND e.idEtapa NOT IN (SELECT s2.idEtapaPadre FROM Etapas e2 INNER JOIN Subetapas s2 ON e2.idEtapa = s2.idEtapa WHERE e2.idEtapa='.$idEtapa.' )',['Subetapas s'], ['e.idEtapa = s.idEtapa'],['left']);
		foreach($lista2 as $valor)
			$this -> etapasNoPadre[$valor['idEtapa']] = $valor['codEtapa'];

		$this -> load -> view('C_Etapas/V_EtapasPadre', Array('idEtapa' => $idEtapa, 'codEtapa' => $codEtapa));
	}
	
	/**
	 * quitarEtapaPadre
	 * 
	 * Quita una etapa padre.
	 *
	 * @param  integer $idEtapa Identificador de la etapa.
	 * @param  integer $idEtapaPadre Identificador de la etapaPadre.
	 * @return void
	 */

	public function quitarEtapaPadre($idEtapa, $idEtapaPadre)
	{
		$this -> M_GestionEVG -> borrarCompuesta('Subetapas',$idEtapa, $idEtapaPadre, 'idEtapa', 'idEtapaPadre');

		$this->headerLocation("C_GestionEVG/etapaPadre/".$idEtapa);
	}
	
	/**
	 * anadirEtapaPadre
	 * 
	 * Añade una etapa padre.
	 *
	 * @param  integer $idEtapa Identificador de la etapa.
	 * @param  integer $idEtapaPadre Identificador de la etapaPadre.
	 * @return void
	 */

	public function anadirEtapaPadre($idEtapa, $idEtapaPadre)
	{
		$this -> M_GestionEVG -> insertar('Subetapas',array('idEtapa' => $idEtapa,'idEtapaPadre' => $idEtapaPadre));

		$this->headerLocation("C_GestionEVG/etapaPadre/".$idEtapa);
	}

		/*CURSOS*/

	
	/**
	 * verCursos
	 * 
	 * Muestra los cursos disponibles.
	 *
	 * @return void
	 */

	public function verCursos()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Cursos','idCurso, codCurso');
		foreach ($lista as $valor)
			$this -> listaCursos[$valor['idCurso']] = $valor['codCurso'];

		$this -> load -> view('C_Cursos/V_Cursos');
	}
	
	/**
	 * anadirCursoForm
	 * 
	 * Muestra un formulario para añadir un curso.
	 *
	 * @return void
	 */

	public function anadirCursoForm()
	{
		$this -> load -> view("C_Cursos/V_AnadirCurso");
	}
	
	/**
	 * anadirCurso
	 *
	 * Añade un curso a la base de datos.
	 * 
	 * @return void
	 */

	public function anadirCurso()
	{
		$datos = array();
		$datos["codCurso"] = $_POST["codCurso"];
		$datos["nombre"] = $_POST["nombre"];
		if(!empty($_POST['idCursoColegio']))
			$datos["idCursoColegio"] = $_POST["idCursoColegio"];

		$this -> M_GestionEVG -> insertar('Cursos',$datos);

		$this->headerLocation("C_GestionEVG/verCursos");
	}
	
	/**
	 * borrarCurso
	 *
	 * Borra un curso de la base de datos.
	 * 
	 * @param  integer $idCurso Identificador del curso.
	 * @return void
	 */

	public function borrarCurso($idCurso)
	{
		$this -> M_GestionEVG -> borrar('Cursos',$idCurso,'idCurso');

		$this->headerLocation("C_GestionEVG/verCursos");
	}
	
	/**
	 * modificarCursoForm
	 * 
	 * Muestra un formulario que permite editar los datos del curso.
	 *
	 * @param  integer $idCurso Identificador del curso.
	 * @return void
	 */
	public  function modificarCursoForm($idCurso)
	{
		$this -> datosCurso = $this -> M_GestionEVG -> seleccionar('Cursos','idCursoColegio, codCurso, nombre, idEtapa','idCurso='.$idCurso);
		$this ->load -> view("C_Cursos/V_ModificarCurso", Array('idCurso' => $idCurso));
	}
	
	/**
	 * modificarCurso
	 * 
	 * Actualiza los datos del curso de la base de datos.
	 *
	 * @param  integer $idCurso Identificador del curso.
	 * @return void
	 */

	public function modificarCurso($idCurso)
	{
		$datos["codCurso"] = $_POST["codCurso"];
		$datos["nombre"] = $_POST["nombre"];
		$datos["idCursoColegio"] = $_POST["idCursoColegio"];

		$this -> M_GestionEVG -> modificar('Cursos',$datos,$idCurso,'idCurso');

		$this->headerLocation("C_GestionEVG/verCursos");
	}
	
	/**
	 * asignarEtapaCursoForm
	 * 
	 * Formulario para asignar una etapa a un curso.
	 *
	 * @param  integer $idCurso Identificador del curso.
	 * @return void
	 */

	public function asignarEtapaCursoForm($idCurso)
	{
		$codCurso = $this -> M_GestionEVG -> seleccionar('Cursos','idCursoColegio, codCurso, nombre, idEtapa','idCurso='.$idCurso);
		$idEtapa = $codCurso[0]['idEtapa'];
		$codCurso = $codCurso[0]['codCurso'];

		$lista = $this -> M_GestionEVG -> seleccionar('Etapas','idEtapa, codEtapa');
		$this -> etapas = Array(0 => 'Ninguna');
		foreach($lista as $valor)
			$this -> etapas[$valor['idEtapa']] = $valor['codEtapa'];

		$this -> load -> view('C_Cursos/V_EtapasCurso', Array('idCurso' => $idCurso, 'codCurso' => $codCurso, 'idEtapa' => $idEtapa));
	}
	
	/**
	 * asignarEtapaCurso
	 * 
	 * Asigna la etapa al curso en la base de datos.
	 *
	 * @param  integer $idCurso Identificador del curso.
	 * @return void
	 */

	public function asignarEtapaCurso($idCurso)
	{
		if($_POST['etapa']==0)
			$datos['idEtapa'] = null;
		else
			$datos["idEtapa"] = $_POST["etapa"];

		$this -> M_GestionEVG -> modificar('Cursos',$datos,$idCurso,'idCurso');

		$this->headerLocation("C_GestionEVG/verCursos");
	}
	
	/**
	 * importarCursosForm
	 * 
	 * Muestra un formulario para importar los cursos.
	 *
	 * @return void
	 */

	public function importarCursosForm()
	{
		$this -> load -> view('C_Cursos/V_ImportarCursos');
	}
	
	/**
	 * importarCursos
	 * 
	 * Importa un curso desde un documento excel añadiendo los datos a la base de datos.
	 *
	 * @return void
	 */

	public function importarCursos()
	{
		$destino = 'uploads/'; /*Lugar donde se guardará el archivo subido al servidor*/
		$archivo_nombre = $_FILES["archivo"]["name"]; /*Guarda el nombre del archivo*/
		if(file_exists($destino.$archivo_nombre)){
			$contador = 0;
			while(file_exists($destino.++$contador."-".$archivo_nombre));
			$archivo_nombre = $contador."-".$archivo_nombre;
		}
		$archivo_temporal = $_FILES["archivo"]["tmp_name"]; /*Direccion temporal donde se va a guardar el archivo*/
		copy($archivo_temporal,$destino.$archivo_nombre); /*Copia el archivo de la carpeta temporal a la carpeta destino en el servidor*/

		$object = PHPExcel_IOFactory::load($_FILES["archivo"]["tmp_name"]);
		foreach($object -> getWorksheetIterator() as $worksheet) {
			$highestRow = $worksheet->getHighestRow();
			for ($row = 2; $row <= $highestRow; $row++){
				$codCurso = $worksheet -> getCellByColumnAndRow(0, $row) -> getValue();
				if(empty($codCurso))/* por si la tabla tiene una longitud máxima mayor que los datos que tiene*/
					break;
				$codCursoComprobar = $this -> M_GestionEVG -> seleccionar('Cursos', 'codCurso', "codCurso='".$codCurso."'");
				if(empty($codCursoComprobar[0]['codCurso'])) {
					$datos[$row]['codCurso'] = $codCurso;
					$datos[$row]['nombre'] = $worksheet -> getCellByColumnAndRow(1, $row) -> getValue();
				}
			}
		}
		foreach($datos as $valor)
			$this -> M_GestionEVG -> insertar('Cursos', Array('nombre' => $valor['nombre'], 'codCurso' => $valor['codCurso']));

		$this->headerLocation("C_GestionEVG/verCursos");

	}

		/*DEPARTAMENTOS*/
	
	/**
	 * verDepartamentos
	 * 
	 * Muestra los departamento existentes.
	 *
	 * @return void
	 */

	public function verDepartamentos()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('FP_Departamentos','idDepartamento, nombre');
		foreach ($lista as $valor)
			$this -> listaDepartamentos[$valor['idDepartamento']] = $valor['nombre'];

		$this -> load -> view('C_Departamentos/V_Departamentos');
	}
	
	/**
	 * anadirDepartamentoForm
	 * 
	 * Muestra un formulario para añadir un departamento.
	 *
	 * @return void
	 */

	public function anadirDepartamentoForm()
	{
		$this -> load -> view("C_Departamentos/V_AnadirDepartamento");
	}
	
	/**
	 * anadirDepartamento
	 * 
	 * Añade un departamento a la base de datos.
	 *
	 * @return void
	 */

	public function anadirDepartamento()
	{
		$datos["nombre"] = $_POST["nombre"];

		$this -> M_GestionEVG -> insertar('FP_Departamentos',$datos);

		$this->headerLocation("C_GestionEVG/verDepartamentos");
	}
	
	/**
	 * borrarDepartamento
	 *
	 * Eliminar un departamento a la base de datos.
	 * 
	 * @param  integer $idDepartamento Identificador del departamento.
	 * @return void
	 */

	public function borrarDepartamento($idDepartamento)
	{
		$this -> M_GestionEVG -> borrar('FP_Departamentos',$idDepartamento,'idDepartamento');

		$this->headerLocation("C_GestionEVG/verDepartamentos");
	}
	
	/**
	 * modificarDepartamentoForm
	 * 
	 * Muestra un formulario con los datos de un departamento.
	 *
	 * @param  integer $idDepartamento Identificador del departamento.
	 * @return void
	 */

	public  function modificarDepartamentoForm($idDepartamento)
	{
		$this -> datosDepartamento = $this -> M_GestionEVG -> seleccionar('FP_Departamentos','nombre','idDepartamento='.$idDepartamento);
		$this -> load -> view("C_Departamentos/V_ModificarDepartamento", Array('idDepartamento' => $idDepartamento));
	}
	
	/**
	 * modificarDepartamento
	 * 
	 * Actualiza los datos de un departameto en la base de datos.
	 *
	 * @param  integer $idDepartamento Identificador del departamento.
	 * @return void
	 */
	public function modificarDepartamento($idDepartamento)
	{
		$datos["nombre"] = $_POST["nombre"];

		$this -> M_GestionEVG -> modificar('FP_Departamentos',$datos,$idDepartamento,'idDepartamento');

		$this->headerLocation("C_GestionEVG/verDepartamentos");
	}

		/*FAMILIAS PROFESIONALES*/
	
	/**
	 * verFamilias
	 * 
	 * Muestra las familias profesionales existentes.
	 *
	 * @return void
	 */

	public function verFamilias()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('FP_FamiliasProfesionales','idFamilia, nombre');
		foreach ($lista as $valor)
			$this -> listaFamilias[$valor['idFamilia']] = $valor['nombre'];

		$this -> load -> view('C_Familias/V_Familias');
	}
	
	/**
	 * anadirFamiliaForm
	 * 
	 * Muestra un formulario para añadir familia profesionales.
	 *
	 * @return void
	 */

	public function anadirFamiliaForm()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('FP_Departamentos','idDepartamento, nombre');
		$this -> departamentos = array(0 => 'Ninguno');
		foreach ($lista as $valor)
			$this -> departamentos[$valor['idDepartamento']] = $valor['nombre'];

		$this -> load -> view("C_Familias/V_AnadirFamilia");
	}
	
	/**
	 * anadirFamilia
	 *
	 * Añade una familia profesional a la base de datos.
	 * 
	 * @return void
	 */

	public function anadirFamilia()
	{
		$datos["nombre"] = $_POST["nombre"];
		if($_POST['departamento'] != 0)
			$datos["idDepartamento"] = $_POST["departamento"];

		$this -> M_GestionEVG -> insertar('FP_FamiliasProfesionales',$datos);

		$this->headerLocation("C_GestionEVG/verFamilias");
	}
	
	/**
	 * borrarFamilia
	 * 
	 * Borra una familia profesional de la base de datos.
	 *
	 * @param  integer $idFamilia Identificador de la familia profesional.
	 * @return void
	 */

	public function borrarFamilia($idFamilia)
	{
		$this -> M_GestionEVG -> borrar('FP_FamiliasProfesionales',$idFamilia,'idFamilia');

		$this->headerLocation("C_GestionEVG/verFamilias");
	}
	
	/**
	 * modificarFamiliaForm
	 * 
	 * Muestra un fomulario con los datos de una familia profesional para modificar.
	 *
	 * @param  mixed $idFamilia Identificador de la familia profesional.
	 * @return void
	 */

	public function modificarFamiliaForm($idFamilia)
	{
		$this -> datosFamilia = $this -> M_GestionEVG -> seleccionar('FP_FamiliasProfesionales','idFamilia, nombre, idDepartamento','idFamilia='.$idFamilia);

		$lista = $this -> M_GestionEVG -> seleccionar('FP_Departamentos','idDepartamento, nombre');
		$this -> departamentos = array(0 => 'Ninguno');
		foreach($lista as $valor)
			$this -> departamentos[$valor['idDepartamento']] = $valor['nombre'];

		$this -> load -> view("C_Familias/V_ModificarFamilia", Array('idFamilia' => $idFamilia, 'idDepartamento' => $this->datosFamilia[0]['idDepartamento']));
	}
	
	/**
	 * modificarFamilia
	 * 
	 * Actualiza los datos de una familia profesional.
	 *
	 * @param  integer $idFamilia Identificador de la familia profesional.
	 * @return void
	 */

	public function modificarFamilia($idFamilia)
	{
		$datos["nombre"] = $_POST["nombre"];
		if($_POST['departamento'] != 0)
			$datos["idDepartamento"] = $_POST["departamento"];
		else
			$datos['idDepartamento'] = null;

		$this -> M_GestionEVG -> modificar('FP_FamiliasProfesionales',$datos,$idFamilia,'idFamilia');

		$this->headerLocation("C_GestionEVG/verFamilias");
	}

		/*CICLOS*/
	
	/**
	 * verCiclos
	 * 
	 * Muestra los ciclos existentes.
	 *
	 * @return void
	 */

	public function verCiclos()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('FP_Ciclos','idCiclo, codCiclo');

		foreach ($lista as $valor)
			$this -> listaCiclos[$valor['idCiclo']] = $valor['codCiclo'];

		$this -> load -> view('C_Ciclos/V_Ciclos');
	}
	
	/**
	 * anadirCicloForm
	 * 
	 * Muestra el formulario para añadir los ciclos.
	 *
	 * @return void
	 */

	public function anadirCicloForm()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('FP_FamiliasProfesionales','idFamilia, nombre');

		$this -> familias = array(0 => 'Ninguna');
		foreach ($lista as $valor)
			$this -> familias[$valor['idFamilia']] = $valor['nombre'];

		$this -> load -> view("C_Ciclos/V_AnadirCiclo");
	}
	
	/**
	 * anadirCiclo
	 * 
	 * Añade los ciclos a la base de datos.
	 *
	 * @return void
	 */

	public function anadirCiclo()
	{
		$datos["nombre"] = $_POST["nombre"];
		$datos["codCiclo"] = $_POST["codCiclo"];
		if($_POST['familia'] != 0)
			$datos["idFamilia"] = $_POST["familia"];

		$this -> M_GestionEVG -> insertar('FP_Ciclos',$datos);

		$this->headerLocation("C_GestionEVG/verCiclos");
	}
	
	/**
	 * borrarCiclo
	 *
	 * Elimina el ciclo de la base de datos.
	 * 
	 * @param  integer $idCiclo Identificador del ciclo.
	 * @return void
	 */

	public function borrarCiclo($idCiclo)
	{
		$this -> M_GestionEVG -> borrar('FP_Ciclos',$idCiclo,'idCiclo');

		$this->headerLocation("C_GestionEVG/verCiclos");
	}
	
	/**
	 * modificarCicloForm
	 * 
	 * Muestra el formulario para modificar los datos de un ciclo.
	 *
	 * @param  integer $idCiclo Identificador del ciclo.
	 * @return void
	 */

	public function modificarCicloForm($idCiclo)
	{
		$this -> datosCiclo = $this -> M_GestionEVG -> seleccionar('FP_Ciclos','idCiclo, codCiclo, nombre, idFamilia','idCiclo='.$idCiclo);

		$lista = $this -> M_GestionEVG -> seleccionar('FP_FamiliasProfesionales','idFamilia, nombre');
		$this -> familias = array(0 => 'Ninguna');
		foreach($lista as $valor)
			$this -> familias[$valor['idFamilia']] = $valor['nombre'];

		$this -> load -> view("C_Ciclos/V_ModificarCiclo", Array('idCiclo' => $idCiclo, 'idFamilia' => $this -> datosCiclo[0]['idFamilia']));
	}
	
	/**
	 * modificarCiclo
	 *
	 * Actualiza los datos de un ciclo de la base de datos.
	 * 
	 * @param  integer $idCiclo Identificador del ciclo.
	 * @return void
	 */

	public function modificarCiclo($idCiclo)
	{
		$datos["codCiclo"] = $_POST["codCiclo"];
		$datos["nombre"] = $_POST["nombre"];
		if($_POST['familia'] != 0)
			$datos["idFamilia"] = $_POST["familia"];
		else
			$datos['idFamilia'] = null;

		$this -> M_GestionEVG -> modificar('FP_Ciclos',$datos,$idCiclo,'idCiclo');

		$this->headerLocation("C_GestionEVG/verCiclos");
	}
	
	/**
	 * cursosCiclo
	 * 
	 * Muestra los cursos que pertenece los ciclos,
	 * permitiendo quitar y añadir cursos.
	 *
	 * @param  integer $idCiclo Identificador del ciclo.
	 * @return void
	 */

	public function cursosCiclo($idCiclo)
	{
		$codCiclo = $this -> M_GestionEVG -> seleccionar('FP_Ciclos','idCiclo, codCiclo, nombre, idFamilia','idCiclo='.$idCiclo);
		$codCiclo = $codCiclo[0]['codCiclo'];

		$lista = $this -> M_GestionEVG -> seleccionar('Cursos cu','cu.idCurso, cu.codCurso','cc.idCiclo='.$idCiclo, ['FP_Ciclos_Cursos cc'], ['cu.idCurso = cc.idCurso']);
		foreach($lista as $valor)
			$this -> ciclosCurso[$valor['idCurso']] = $valor['codCurso'];

		$lista2 = $this -> M_GestionEVG -> seleccionar('Cursos cu','cu.idCurso, cu.codCurso','cu.idCurso NOT IN (SELECT cc2.idCurso FROM FP_Ciclos_Cursos cc2 WHERE cc2.idCiclo='.$idCiclo.')');
		foreach($lista2 as $valor)
			$this -> cursosNoCiclo[$valor['idCurso']] = $valor['codCurso'];

		$this -> load -> view('C_Ciclos/V_CursosCiclos', Array('idCiclo' => $idCiclo, 'codCiclo' => $codCiclo));
	}
	
	/**
	 * quitarCursoCiclo
	 * 
	 * Quita el curso de un ciclo.
	 *
	 * @param  integer $idCiclo Identificador del ciclo.
	 * @param  integer $idCurso Identificador del curso.
	 * @return void
	 */

	public function quitarCursoCiclo($idCiclo, $idCurso)
	{
		$this -> M_GestionEVG -> borrarCompuesta('FP_Ciclos_Cursos',$idCurso, $idCiclo, 'idCurso', 'idCiclo');

		$this->headerLocation("C_GestionEVG/cursosCiclo/".$idCiclo);
	}
	
	/**
	 * anadirCursoCiclo
	 *
	 * Añade el curso para un ciclo.
	 * 
	 * @param  integer $idCiclo Identificador del ciclo.
	 * @param  integer $idCurso Identificador del curso.
	 * @return void
	 */

	public function anadirCursoCiclo($idCiclo, $idCurso)
	{
		$this -> M_GestionEVG -> insertar('FP_Ciclos_Cursos',array('idCurso' => $idCurso,'idCiclo' => $idCiclo));

		$this->headerLocation("C_GestionEVG/cursosCiclo/".$idCiclo);
	}

	/*SECCIONES*/
	
	/**
	 * verSecciones
	 *
	 * Muestra las secciones existentes.
	 * 
	 * @return void
	 */

	public function verSecciones()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Secciones','idSeccion, codSeccion');

		foreach ($lista as $valor)
			$this -> listaSecciones[$valor['idSeccion']] = $valor['codSeccion'];

		$this -> load-> view('C_Secciones/V_Secciones');
	}
	
	/**
	 * anadirSeccionForm
	 * 
	 * Muestra el formulario para añadir las secciones.
	 *
	 * @return void
	 */

	public function anadirSeccionForm()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Cursos','idCurso, codCurso');
		$this -> cursos = array(0 => 'Ninguno');
		foreach ($lista as $valor)
			$this -> cursos[$valor['idCurso']] = $valor['codCurso'];

		$this -> load -> view("C_Secciones/V_AnadirSeccion");
	}
	
	/**
	 * anadirSeccion
	 * 
	 * Añade la seccion a la base de datos.
	 *
	 * @return void
	 */

	public function anadirSeccion()
	{
		$datos["codSeccion"] = $_POST["codSeccion"];
		$datos["nombre"] = $_POST["nombre"];
		if($_POST['curso'] != 0)
			$datos["idCurso"] = $_POST["curso"];
		if(!empty($_POST['idSeccionColegio']))
			$datos["idSeccionColegio"] = $_POST["idSeccionColegio"];

		$this -> M_GestionEVG -> insertar('Secciones',$datos);

		$this->headerLocation("C_GestionEVG/verSecciones");
	}
	
	/**
	 * borrarSeccion
	 *
	 * Elimina una sección de la base de datos.
	 * 
	 * @param  integer $idSeccion Identificador de la seccion.
	 * @return void
	 */

	public function borrarSeccion($idSeccion)
	{
		$alumnos = $this -> M_GestionEVG -> seleccionar('Alumnos', '*', 'idSeccion='.$idSeccion);
		if(!empty($alumnos))
			echo '
				<script>
					alert("No se puede borrar la sección porque tiene alumnos");
					location.href="'.base_url().'C_GestionEVG/verSecciones";
				</script>
			';
		else
		{
			$this -> M_GestionEVG -> borrar('Secciones',$idSeccion,'idSeccion');

			$this->headerLocation("C_GestionEVG/verSecciones");
		}
	}
	
	/**
	 * modificarSeccionForm
	 *
	 * Muestra el formulario para modificar los datos de una sección.
	 * 
	 * @param  integer $idSeccion Identificador de la seccion.
	 * @return void
	 */

	public function modificarSeccionForm($idSeccion){
		$this -> datosSeccion = $this -> M_GestionEVG -> seleccionar('Secciones','idSeccion, idSeccionColegio, codSeccion, nombre, idCurso','idSeccion='.$idSeccion);

		$lista = $this -> M_GestionEVG -> seleccionar('Cursos','idCurso, codCurso');
		$this -> cursos = Array(0 => 'Ninguno');
		foreach($lista as $valor)
			$this -> cursos[$valor['idCurso']] = $valor['codCurso'];

		$this -> load -> view("C_Secciones/V_ModificarSeccion", Array('idSeccion' => $idSeccion, 'idCurso' => $this -> datosSeccion[0]['idCurso']));
	}
	
	/**
	 * modificarSeccion
	 *
	 * Actualiza los datos de una sección en la base de datos.
	 * 
	 * @param  integer $idSeccion Identificador de la seccion.
	 * @return void
	 */

	public function modificarSeccion($idSeccion)
	{
		$datos["codSeccion"] = $_POST["codSeccion"];
		$datos["nombre"] = $_POST["nombre"];
		if($_POST['curso'] == 0)
			$datos['idCurso'] = null;
		else
			$datos["idCurso"] = $_POST["curso"];
		if(!empty($_POST['idSeccionColegio']))
			$datos["idSeccionColegio"] = $_POST["idSeccionColegio"];
		else
			$datos["idSeccionColegio"] = null;

		$this -> M_GestionEVG -> modificar('Secciones',$datos,$idSeccion,'idSeccion');

		$this->headerLocation("C_GestionEVG/verSecciones");
	}
	
	/**
	 * asignarTutorForm
	 * 
	 * Muestra el formulario para seleccionar al tutor de la sección.
	 *
	 * @param  integer $idSeccion Identificador de la seccion.
	 * @return void
	 */

	public function asignarTutorForm($idSeccion)
	{
		$codSeccion = $this -> M_GestionEVG -> seleccionar('Secciones','idSeccion, idSeccionColegio, codSeccion, nombre, idCurso','idSeccion='.$idSeccion);
		$codSeccion = $codSeccion[0]['codSeccion'];
		$idTutorActual = $this -> M_GestionEVG -> seleccionar('Secciones','idTutor',"idSeccion=".$idSeccion);
		if(isset($idTutorActual[0]['idTutor'])) 
		{
			$idTutorActual = $idTutorActual[0]['idTutor'];
			$nombreTutor = $this -> M_GestionEVG -> seleccionar('Usuarios', 'correo', 'idUsuario='.$idTutorActual);
			$nombreTutor = $nombreTutor[0]['correo'];
		} 
		else 
		{
			$idTutorActual = 0;
			$nombreTutor = 'No hay tutor';
		}

		$lista = $this -> M_GestionEVG -> seleccionar('Usuarios','idUsuario, correo',"idUsuario IN (SELECT idUsuario FROM Perfiles_Usuarios WHERE idPerfil=( SELECT idPerfil FROM Perfiles WHERE nombre='profesor')AND idUsuario NOT IN (SELECT idUsuario FROM Perfiles_Usuarios WHERE idPerfil=(SELECT idPerfil FROM Perfiles WHERE nombre='tutor')))",null,null,null,'correo');
		$this -> profesores = array(0 => 'Ninguno');
		foreach ($lista as $valor)
			$this -> profesores[$valor['idUsuario']] = $valor['correo'];

		$this -> load -> view('C_Secciones/V_AsignarTutor', Array('idSeccion' => $idSeccion, 'codSeccion' => $codSeccion, 'idTutorActual' => $idTutorActual, 'nombreTutor' => $nombreTutor));
	}
	
	/**
	 * anadirQuitarTutor
	 * 
	 * Permite añadir y quitar el tutor de la sección.
	 *
	 * @param  integer $idSeccion Identificador de la seccion.
	 * @param  integer $idTutorActual Identificador del usuario.
	 * @return void
	 */

	public function anadirQuitarTutor($idSeccion, $idTutorActual)
	{
		$idPerfilTutor = $this -> M_GestionEVG -> seleccionar('Perfiles','idPerfil',"nombre='tutor'");
		$idPerfilTutor = $idPerfilTutor[0]['idPerfil'];
		if($_POST['tutor'] == 0)
		{
			$this -> M_GestionEVG -> modificar('Secciones', array('idtutor' => null), $idSeccion, 'idSeccion');
		}
		else
		{
			$this -> M_GestionEVG -> modificar('Secciones', Array('idtutor' => $_POST["tutor"]), $idSeccion, 'idSeccion');
			$this -> M_GestionEVG -> insertar('Perfiles_Usuarios',Array('idUsuario' => $_POST["tutor"], 'idPerfil' => $idPerfilTutor));
		}

		$this -> M_GestionEVG -> borrarCompuesta('Perfiles_Usuarios', $idTutorActual, $idPerfilTutor, 'idUsuario', 'idPerfil');

		$this->headerLocation("C_GestionEVG/verSecciones");
	}
	
	/**
	 * importarSeccionesForm
	 *
	 * Muestra el formulario para importar secciones.
	 * 
	 * @return void
	 */

	public function importarSeccionesForm()
	{
		$this -> load -> view('C_Secciones/V_ImportarSecciones');
	}
	
	/**
	 * importarSecciones
	 * 
	 * Importa secciones desde un documento excel añadiendo los datos a la base de datos.
	 *
	 * @return void
	 */

	public function importarSecciones()
	{
		$destino = 'uploads/'; /*Lugar donde se guardará el archivo subido al servidor*/
		$archivo_nombre = $_FILES["archivo"]["name"]; /*Guarda el nombre del archivo*/
		if(file_exists($destino.$archivo_nombre))
		{
			$contador = 0;
			while(file_exists($destino.++$contador."-".$archivo_nombre));
			$archivo_nombre = $contador."-".$archivo_nombre;
		}
		$archivo_temporal = $_FILES["archivo"]["tmp_name"]; /*Direccion temporal donde se va a guardar el archivo*/
		copy($archivo_temporal,$destino.$archivo_nombre); /*Copia el archivo de la carpeta temporal a la carpeta destino en el servidor*/

		$object = PHPExcel_IOFactory::load($_FILES["archivo"]["tmp_name"]);
		foreach($object -> getWorksheetIterator() as $worksheet) {
			$highestRow = $worksheet -> getHighestRow();
			for ($row = 2; $row <= $highestRow; $row++)
			{
				$codSeccion = $worksheet -> getCellByColumnAndRow(0, $row) -> getValue();
				if(empty($codSeccion))/* por si la tabla tiene una longitud máxima mayor que los datos que tiene*/
					break;
				$codSeccionComprobar = $this -> M_GestionEVG->seleccionar('Secciones', 'codSeccion', "codSeccion='".$codSeccion."'");
				if(empty($codSeccionComprobar[0]['codSeccion'])) {
					$datos[$row]['codSeccion'] = $codSeccion;
					$datos[$row]['nombre'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				}
			}
		}
		foreach($datos as $valor)
			$this -> M_GestionEVG -> insertar('Secciones', $valor);

		$this->headerLocation("C_GestionEVG/verSecciones");

	}

	/*ALUMNOS*/
	
	/**
	 * verAlumnos
	 * 
	 * Muestra las etapas exitentes.
	 *
	 * @return void
	 */
	
	public function verAlumnos()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Etapas','idEtapa, codEtapa');
		foreach ($lista as $valor)
			$this -> listaEtapas[$valor['idEtapa']] = $valor['codEtapa'];

		$this -> load -> view('C_Alumnos/V_Alumnos');
	}
	
	/**
	 * verSeccionesEtapa
	 *
	 * Muestra las secciones existetes, segun la etapa.
	 * 
	 * @param  integer $idEtapa Identificador de la etapa.
	 * @return void
	 */

	public function verSeccionesEtapa($idEtapa)
	{
		$codEtapa = $this -> M_GestionEVG -> seleccionar('Etapas','codEtapa','idEtapa='.$idEtapa);
		$codEtapa = $codEtapa[0]['codEtapa'];

		$lista = $this -> M_GestionEVG -> seleccionar('Secciones s','s.idSeccion, s.codSeccion',"e.idEtapa = ".$idEtapa,['Cursos c','Etapas e'], ['s.idCurso=c.idCurso','c.idEtapa=e.idEtapa'],['join','join']);
		foreach ($lista as $valor)
			$this -> listaSecciones[$valor['idSeccion']] = $valor['codSeccion'];

		$this -> load -> view('C_Alumnos/V_AlumnosSecciones', Array('codEtapa' => $codEtapa, 'idEtapa' => $idEtapa));
	}
	
	/**
	 * verAlumnosSeccion
	 *
	 * Muestra los alumnos existentes, segun la sección.
	 * 
	 * @param  integer $idSeccion Identificador de la seccion.
	 * @param  integer $idEtapa Identificador de la etapa.
	 * @return void
	 */

	public function verAlumnosSeccion($idSeccion,$idEtapa)
	{
		$codSeccion = $this -> M_GestionEVG -> seleccionar('Secciones','codSeccion','idSeccion='.$idSeccion);
		$codSeccion = $codSeccion[0]['codSeccion'];

		$lista = $this -> M_GestionEVG -> seleccionar('Alumnos','idAlumno, nombre','idSeccion='.$idSeccion);
		foreach ($lista as $valor)
			$this -> listaAlumnos[$valor['idAlumno']] = $valor['nombre'];

		$this -> load -> view('C_Alumnos/V_AlumnosClase', Array('codSeccion' => $codSeccion, 'idEtapa' => $idEtapa));
	}
	
	/**
	 * anadirAlumnoForm
	 *
	 * Muestra el formulario para añadir un alumno.
	 * 
	 * @return void
	 */

	public function anadirAlumnoForm()
	{
		$lista = $this -> M_GestionEVG -> seleccionar('Secciones','idSeccion, codSeccion');
		foreach ($lista as $valor)
			$this -> secciones[$valor['idSeccion']] = $valor['codSeccion'];

		$this -> load -> view("C_Alumnos/V_AnadirAlumno");
	}
	
	/**
	 * anadirAlumno
	 * 
	 * Añade el alumno a la base de datos.
	 *
	 * @return void
	 */

	public function anadirAlumno()
	{
		$datos["NIA"] = $_POST["nia"];
		$datos["nombre"] = $_POST["nombre"];
		$datos["idSeccion"] = $_POST["secciones"];
		if(!empty($_POST["correo"]))
			$datos["correo"] = $_POST["correo"];
		$datos["sexo"] = $_POST["sexo"];
		$datos["telefono"] = $_POST["telefono"];

		$this -> M_GestionEVG -> insertar('Alumnos',$datos);

		$this->headerLocation("C_GestionEVG/verAlumnos");
	}
	
	/**
	 * borrarAlumno
	 *
	 * Elimina el alumno de la base de datos.
	 * 
	 * @param  integer $idAlumno Identificador del alumno.
	 * @return void
	 */

	public function borrarAlumno($idAlumno)
	{
		$this -> M_GestionEVG -> borrar('Alumnos',$idAlumno,'idAlumno');

		$this->headerLocation("C_GestionEVG/verAlumnos");
	}
	
	/**
	 * modificarAlumnoForm
	 *
	 * Muestra un formulario para modificar los datos de un alumno.
	 * 
	 * @param  integer $idAlumno Identificador del alumno.
	 * @param  integer $idEtapa Identificador del etapa.
	 * @return void
	 */

	public function modificarAlumnoForm($idAlumno, $idEtapa)
	{
		$this -> datosAlumno = $this -> M_GestionEVG -> seleccionar('Alumnos','*','idAlumno='.$idAlumno);

		$lista = $this -> M_GestionEVG -> seleccionar('Secciones','idSeccion, codSeccion');
		foreach($lista as $valor)
			$this -> secciones[$valor['idSeccion']] = $valor['codSeccion'];

		$this -> load -> view("C_Alumnos/V_ModificarAlumno", Array('idAlumno' => $idAlumno, 'idEtapa' => $idEtapa));
	}
	
	/**
	 * modificarAlumno
	 * 
	 * Actualiza los datos del alumno en la base de datos.
	 *
	 * @param  integer $idAlumno Identificador del alumno.
	 * @param  integer $idSeccion Identificador del seccion.
	 * @param  integer $idEtapa Identificador del etapa.
	 * @return void
	 */

	public function modificarAlumno($idAlumno, $idSeccion, $idEtapa)
	{
		$datos["NIA"] = $_POST["nia"];
		$datos["nombre"] = $_POST["nombre"];
		$datos["idSeccion"] = $_POST["secciones"];
		if(!empty($_POST["correo"]))
			$datos["correo"] = $_POST["correo"];
		else
			$datos["correo"] = null;
		$datos["sexo"] = $_POST["sexo"];
		$datos["telefono"] = $_POST["telefono"];

		$this -> M_GestionEVG -> modificar('Alumnos',$datos,$idAlumno,'idAlumno');

		$this->headerLocation('C_GestionEVG/verAlumnosSeccion/'.$idSeccion.'/'.$idEtapa);
	}
	
	/**
	 * importarAlumnosForm
	 * 
	 * Muestra el formulario para importar alumnos.
	 *
	 * @return void
	 */

	public function importarAlumnosForm()
	{
		$this -> secciones = $this -> M_GestionEVG -> seleccionar('Secciones', '*', '1=1');
		$this -> load -> view('C_Alumnos/V_ImportarAlumnos');
	}
	
	/**
	 * importarAlumnos
	 * 
	 * Importa alumnos desde un documento excel añadiendo los datos a la base de datos.
	 *
	 * @return void
	 */

	public function importarAlumnos()
	{
		$destino = 'uploads/'; /*Lugar donde se guardará el archivo subido al servidor*/
		$archivo_nombre = $_FILES["archivo"]["name"]; /*Guarda el nombre del archivo*/
		if(file_exists($destino.$archivo_nombre))
		{
			$contador = 0;
			while(file_exists($destino.++$contador."-".$archivo_nombre));
			$archivo_nombre = $contador."-".$archivo_nombre;
		}
		$archivo_temporal = $_FILES["archivo"]["tmp_name"]; /*Direccion temporal donde se va a guardar el archivo*/
		copy($archivo_temporal,$destino.$archivo_nombre); /*Copia el archivo de la carpeta temporal a la carpeta destino en el servidor*/

		$object = PHPExcel_IOFactory::load($_FILES["archivo"]["tmp_name"]);
		foreach($object -> getWorksheetIterator() as $worksheet) {
			$highestRow = $worksheet -> getHighestRow();
			for ($row = 2; $row <= $highestRow; $row++){
				$nia = $worksheet -> getCellByColumnAndRow(1, $row) -> getValue();
				/* por si la tabla tiene una longitud máxima mayor que los datos que tiene*/
				if(empty($nia))
					break;
				$niaComprobar = $this -> M_GestionEVG -> seleccionar('Alumnos', 'nia', "nia=".$nia);
				$estado = $worksheet -> getCellByColumnAndRow(9, $row) -> getValue();
				if(empty($niaComprobar[0]['nia']) && $estado != 'Trasladada' && $estado != 'Obtiene Título' && $estado != 'Anulada')
				{
					$datos[$row]['nia'] = $nia;
					$datos[$row]['nombre'] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$datos[$row]['telefono'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$datos[$row]['correo'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

					if($worksheet -> getCellByColumnAndRow(8, $row) -> getValue() == 'H')
						$datos[$row]['sexo'] = 'm';
					else
						$datos[$row]['sexo'] = 'f';

					if($worksheet -> getCellByColumnAndRow(6, $row) -> getValue() != '')
						$datos[$row]['correo'] = $worksheet -> getCellByColumnAndRow(6, $row) -> getValue();

					$idSeccion = $this -> M_GestionEVG -> seleccionar('Secciones', 'idSeccion', "codSeccion='".$worksheet -> getCellByColumnAndRow(7, $row) -> getValue()."'");
					$datos[$row]['idSeccion'] = $idSeccion[0]['idSeccion'];
				}
				else if($estado=='Trasladada' || $estado=='Obtiene Título' || $estado=='Anulada')
				{
					$this -> M_GestionEVG -> borrar('Alumnos', $nia, 'nia');
				}
			}
		}
		/* recorrer el array con los datos del excel que no estén en la base de datos para insertarlos */
		foreach($datos as $valor)
			$this -> M_GestionEVG -> insertar('Alumnos', $valor);

		$this->headerLocation('C_GestionEVG/verAlumnos');
	}

	/*LISTADO TUTORES*/
	
	/**
	 * listadoTutores
	 * 
	 * Genera un pdf, que contiene el listado de los tutores con su sección correspondiente.
	 *
	 * @return void
	 */

	public function listadoTutores()
	{
		include('application/FPDF/fpdf.php');

		$datos = $this -> M_GestionEVG -> seleccionar('Secciones s','s.codSeccion, u.correo',null,['Usuarios u'],['s.idTutor=u.idUsuario'],['left']);
		foreach ($datos as $valor)
			$this -> listaTutores[$valor['codSeccion']] = $valor['correo'];

		if(!empty($this -> listaTutores)) 
		{
			$pdf = new FPDF(); /*Crea el objeto FPDP*/
			$pdf -> SetDrawColor(68, 45, 235); /*color de los border*/
			$pdf -> SetTextColor(68, 45, 235); /*color del texto*/
			$pdf -> AddPage(); /*Añade una página*/
			$pdf -> SetFont('Arial', 'B', 10); /*Establece el estilo de letra*/
			$pdf -> Write(20, 'LISTADO DE TUTORES'); /*Escribe LISTADO DE TUTORES*/
			$pdf -> Ln(15); /*Salto de linea*/
			$pdf -> Cell(50, 10, 'SECCION', 1, 0, 'C'); /*$pdf->Cell(ancho,alto,valor a escribir,borde,salto de lina,'alineamiento');*/
			$pdf -> Cell(50, 10, 'TUTOR', 1, 1, 'C');


			foreach ($this -> listaTutores as $indice => $valor) 
			{
				$pdf -> Cell(50, 10, $indice, 1, 0, 'C');
				if (!empty($valor))
					$pdf -> Cell(50, 10, $valor, 1, 1, 'C');
				else
					$pdf -> Cell(50, 10, '-', 1, 1, 'C');
			}
			$pdf -> Output();
		}
		else
		{
			echo
			('
			<script>
				alert("no hay secciones creadas");
				window.close();
			</script>
			');
		}
	}

	/* NUEVO CURSO */
	
	/**
	 * nuevoCurso
	 * 
	 * Elimina a todos los alumnos de la base de datos.
	 *
	 * @return void
	 */
	public function nuevoCurso()
	{
		$this -> M_GestionEVG -> borrar('Alumnos', 1, 1);
		
		$this->headerLocation('C_GestionEVG/importarAlumnosForm'); 
	}

	/*Redirecionar localizaciones*/
	
	/**
	 * headerLocation
	 *
	 * Metodo para redireccionar.
	 * 
	 * @param  string $location Ruta para redirigir a una direccion.
	 * @return void
	 */
	public function headerLocation($location){
		header('Location:'.base_url().$location);
	}

}
?>

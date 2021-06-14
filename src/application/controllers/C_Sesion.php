<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sesión
 * 
 * Clase para ver el usuario que ha iniciado sesión en la aplicación
 * 
 * @author Abraham Núñez Palos y Daniel Torres Galindo
 */
class C_Sesion extends CI_Controller
{	
	/**
	 * __construct
	 * 
	 * Carga las librerias y los modelos ademas de comprobar si tienes iniciado sesión.
	 *
	 * @return void
	 */
	
	function __construct()
	{
		parent::__construct();

		$this -> load -> model('M_General');
		$this -> load -> library('google');
		$this -> load -> library('session');

		if($this -> session -> userdata('sess_logged_in') == 0 || !$idUsuario = $this -> M_General -> obtenerIdUsuario($_SESSION['email']))
			redirect('Auth');

		$this -> load -> model('M_General');
	}

	/**
	 * userID
	 *
	 * Crea la sesión del usuario que ha iniciado sesión.
	 *
	 * @return void
	 */
	function userID()
	{
		$this -> datosUsuario = $this -> M_General -> seleccionar('Usuarios','idUsuario, nombre, correo','correo="'.$_SESSION['email'].'"');

		$userData = array
		(
			'id' => $this -> datosUsuario[0]['idUsuario'],
			'username'  => $this -> datosUsuario[0]['nombre'],
			'logged_in' => TRUE
		);

		$this -> session -> set_userdata($userData);

		$this -> load -> view('V_Sesion');
	}

}

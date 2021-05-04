<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grid extends CI_Controller
{
	function __construct(){
		parent::__construct();

		$this->load->model('M_GestionEVG');
		$this->load->library('google');

		if($this->session->userdata('sess_logged_in') == 0 || !$idUsuario=$this->M_GestionEVG->obtenerIdUsuario($_SESSION['email']))
			redirect('Auth');

		$this->load->model('M_GestionEVG');
	}

	public function index(){
		$idUsuario=$this->M_GestionEVG->obtenerIdUsuario($_SESSION['email']);
		$this->aplicaciones=$this->M_GestionEVG->aplicacionesPermitidas($idUsuario);
		$this->load->view('V_Grid');
	}
}

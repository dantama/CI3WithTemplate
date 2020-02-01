<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function error403()
	{
		$this->load->view('template/header');
		$this->load->view('errors/html/error-403');
		$this->load->view('template/footer_error');
	}

	public function error404()
	{
		$this->load->view('template/header');
		$this->load->view('errors/html/error-404');
		$this->load->view('template/footer_error');
	}

	public function error405()
	{
		$this->load->view('template/header');
		$this->load->view('errors/html/error-405');
		$this->load->view('template/footer_error');
	}

	public function error500()
	{
		$this->load->view('template/header');
		$this->load->view('errors/html/error-500');
		$this->load->view('template/footer_error');
	}

}

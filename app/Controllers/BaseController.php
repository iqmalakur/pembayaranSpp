<?php

namespace App\Controllers;

use App\Models\PetugasModel;
use App\Models\SiswaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];
	protected $role = '';
	protected $user = '';
	protected $controller = '';
	protected $data = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------

		$this->controller = explode("\\", get_class($this))[2];

		$this->session = \Config\Services::session();

		if ($this->session->login) {
			$this->role = $this->session->user['role'];
			$username = $this->session->user['username'];

			if ($this->role == 'siswa') {
				$model = new SiswaModel();
			} else {
				$model = new PetugasModel();
			}

			$this->user = $model->find($username);
		}

		$this->data = [
			"controller" => $this->controller,
			"role" => $this->role,
			"user" => $this->user,
		];
	}
}

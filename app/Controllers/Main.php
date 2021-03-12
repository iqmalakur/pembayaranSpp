<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Main extends BaseController
{
	public function index()
	{
		if (!$this->session->login) {
			$this->session->setFlashdata('loginInfo', false);
			return redirect()->to('/login');
		}

		$data = [
			"title" => "Dashboard",
			"controller" => $this->controller,
			"role" => $this->role,
			"loginStatus" => $this->session->get('success'),
		];

		return view("main/index", $data);
	}

	public function payment()
	{
		if (!$this->session->login) {
			$this->session->setFlashdata('loginInfo', false);
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] === 'siswa') {
			return view('errors/html/error_404');
		}

		$data = [
			"title" => "Pembayaran Spp",
			"controller" => $this->controller,
			"role" => $this->role,
		];

		return view("main/payment", $data);
	}

	public function pay($data)
	{
		// Proses Pembayaran
	}

	public function report($data)
	{
		// Generate Laporan
	}

	public function receipt($data)
	{
		if (!$this->session->login) {
			$this->session->setFlashdata('loginInfo', false);
			return redirect()->to('/login');
		}
		// Kuitansi
	}
}

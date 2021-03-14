<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Main extends BaseController
{
	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		$this->data['title'] = "dashboard";
		$this->data['loginStatus'] = $this->session->get('success');

		return view("main/index", $this->data);
	}

	public function payment()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] === 'siswa') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Pembayaran Spp";

		return view("main/payment", $this->data);
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
		echo "Kuitansi";
		if (!$this->session->login) {
			return redirect()->to('/login');
		}
		// Kuitansi
	}
}

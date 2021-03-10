<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Main extends BaseController
{
	public function index()
	{
		$data = [
			"title" => "Dashboard",
			"controller" => explode("\\", get_class($this))[2],
			"role" => $this->role,
		];

		return view("main/index", $data);
	}

	public function payment()
	{
		$data = [
			"title" => "Pembayaran Spp",
			"controller" => explode("\\", get_class($this))[2],
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
		// Kuitansi
	}
}

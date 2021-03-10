<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function index()
	{
		$data = [
			"title" => "Login",
			"controller" => explode("\\", get_class($this))[2],
			"role" => $this->role,
		];

		return view("login/index", $data);
	}

	public function login()
	{
		// Proses Login
	}

	public function logout()
	{
		// Proses Logout
	}
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Petugas extends BaseController
{
	public function index()
	{
		if (!$this->session->login) {
			$this->session->setFlashdata('loginInfo', false);
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Petugas";

		return view("petugas/index", $this->data);
	}

	public function create()
	{
		// Create Data
	}

	public function save($data)
	{
		// Save Data
	}

	public function edit($data)
	{
		// Edit Data
	}

	public function update($data)
	{
		// Update Data
	}

	public function delete($data)
	{
		// Delete Data
	}
}

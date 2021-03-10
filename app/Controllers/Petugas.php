<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Petugas extends BaseController
{
	public function index()
	{
		$data = [
			"title" => "Petugas",
			"controller" => explode("\\", get_class($this))[2],
			"role" => $this->role,
		];

		return view("petugas/index", $data);
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

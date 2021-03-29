<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	// Validasi Login
	public $login = [
		'username' => 'required|alpha_numeric|max_length[25]',
		'password' => 'required|max_length[32]'
	];

	// Validasi Jurusan
	public $jurusan = [
		'nama_jurusan' => 'required|alpha_space|max_length[50]',
		'alias' => 'required|alpha_space|max_length[5]'
	];

	// Validasi Kelas
	public $kelas = [
		'nama_kelas' => 'required|alpha_numeric_space|max_length[10]'
	];

	// Validasi Spp
	public $spp = [
		'tahun' => 'required',
		'nominal' => 'required|numeric|max_length[11]'
	];

	// Validasi Petugas
	public $petugas = [
		'username' => 'required|alpha_numeric|max_length[25]',
		'password' => 'required|max_length[32]',
		'nama_petugas' => 'required|alpha_space|max_length[35]',
	];

	// Validasi Edit Petugas
	public $editPetugas = [
		'username' => 'required|alpha_numeric|max_length[25]',
		'editPassword' => 'max_length[32]',
		'nama_petugas' => 'required|alpha_space|max_length[35]',
	];

	// Validasi Siswa
	public $siswa = [
		'nisn' => 'required|numeric|max_length[10]|min_length[10]',
		'nis' => 'required|numeric|max_length[8]|min_length[8]',
		'nama' => 'required|alpha_space|max_length[35]',
		'alamat' => 'required',
		'no_telp' => 'required|numeric|max_length[13]',
	];

	// Validasi Pembayaran
	public $pembayaran = [
		'nisn' => 'required',
	];
}

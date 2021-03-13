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
}

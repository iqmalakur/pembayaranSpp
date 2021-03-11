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

	public $login_errors = [
		'username' => [
			'required'      => 'Username wajib diisi',
			'alpha_numeric' => 'Username hanya boleh diisi dengan huruf dan angka',
			'max_length'    => 'Username maksimal terdiri dari 25 karakter'
		],
		'password' => [
			'required'      => 'Password wajib diisi',
			'max_length'    => 'Password maksimal terdiri dari 32 karakter'
		]
	];
}

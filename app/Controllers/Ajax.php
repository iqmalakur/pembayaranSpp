<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\PembayaranModel;
use App\Models\PetugasModel;
use App\Models\SiswaModel;
use App\Models\SppModel;

class Ajax extends BaseController
{
	protected $model;
	protected $siswaModel;
	protected $jurusanModel;

	public function __construct()
	{
		$this->pembayaranModel = new PembayaranModel();
		$this->siswaModel = new SiswaModel();
		$this->jurusanModel = new JurusanModel();
		$this->kelasModel = new KelasModel();
		$this->sppModel = new SppModel();
		$this->petugasModel = new PetugasModel();
	}

	public function pembayaran()
	{
		$keyword = $this->request->getPost("keyword");
		return view('ajax/pembayaran', ['siswa' => $this->siswaModel->searchAjax($keyword)]);
	}

	public function siswa()
	{
		$nisn = $this->request->getPost("nisn");
		return view('ajax/siswa', ['siswa' => $this->pembayaranModel->getPembayaran($nisn)]);
	}

	public function laporan()
	{
		$spp = implode("/", explode("-", $this->request->getPost('tahun')));

		$data = [
			'pembayaran' => $this->pembayaranModel->laporan($spp),
			'total' => $this->pembayaranModel->getSum($spp),
		];

		return view('ajax/laporan', $data);
	}

	public function dataSiswa()
	{
		$siswa = $this->siswaModel->get($this->request->getPost("nisn"));
		return json_encode($siswa);
	}

	public function sidebar()
	{
		$this->session->set('sidebar', $this->request->getPost('sidebar'));
	}

	// Searching
	public function cariJurusan()
	{
		return view(
			"ajax/cariJurusan",
			['jurusan' => $this->jurusanModel->cari(
				$this->request->getPost('keyword')
			)]
		);
	}

	public function cariKelas()
	{
		return view(
			"ajax/cariKelas",
			['kelas' => $this->kelasModel->cari(
				$this->request->getPost('keyword')
			)]
		);
	}

	public function cariSpp()
	{
		return view(
			"ajax/cariSpp",
			['spp' => $this->sppModel->cari(
				$this->request->getPost('keyword')
			)]
		);
	}

	public function cariPetugas()
	{
		return view(
			"ajax/cariPetugas",
			[
				'petugas' => $this->petugasModel->cari(
					$this->request->getPost('keyword')
				),
				'user' => $this->user
			]
		);
	}

	public function cariSiswa()
	{
		return view(
			"ajax/cariSiswa",
			['siswa' => $this->siswaModel->cari(
				$this->request->getPost('keyword')
			)]
		);
	}
}

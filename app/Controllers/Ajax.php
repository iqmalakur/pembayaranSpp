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
	protected $pembayaranModel;
	protected $siswaModel;
	protected $jurusanModel;
	protected $kelasModel;
	protected $sppModel;
	protected $petugasModel;

	public function __construct()
	{
		$this->pembayaranModel = new PembayaranModel();
		$this->siswaModel = new SiswaModel();
		$this->jurusanModel = new JurusanModel();
		$this->kelasModel = new KelasModel();
		$this->sppModel = new SppModel();
		$this->petugasModel = new PetugasModel();
	}

	// AJAX cari siswa pada entri pembayaran spp
	// =========================================
	public function pembayaran()
	{
		$keyword = $this->request->getPost("keyword");
		return view(
			'ajax/pembayaran',
			[
				'siswa' => $this->siswaModel->cari($keyword),
				'keyword' => $keyword,
			]
		);
	}

	public function siswa()
	{
		$nisn = $this->request->getPost("nisn");
		$data = ['siswa' => $this->pembayaranModel->getPembayaran($nisn)];

		helper('pembayaran');

		foreach ($data['siswa'] as $item) {
			$item->bulan_dibayar = getBulan($item->bulan_dibayar);
		}

		return view('ajax/siswa', $data);
	}

	public function dataSiswa()
	{
		$siswa = $this->siswaModel->get($this->request->getPost("nisn"));
		return json_encode($siswa);
	}
	// =========================================

	// AJAX data pembayaran pada halaman laporan
	public function laporan()
	{
		$spp = implode("/", explode("-", $this->request->getPost('tahun')));

		helper('pembayaran');

		$data = [
			'pembayaran' => $this->pembayaranModel->laporan($spp),
			'total' => $this->pembayaranModel->getSum($spp),
		];

		return view('ajax/laporan', $data);
	}

	// AJAX untuk membuat session untuk menyimpan keadaan sidebar
	public function sidebar()
	{
		$this->session->set('sidebar', $this->request->getPost('sidebar'));
	}

	// Searching
	public function cariJurusan()
	{
		return view(
			"ajax/cariJurusan",
			[
				'jurusan' => $this->jurusanModel->cari(
					$this->request->getPost('keyword')
				),
				'keyword' => $this->request->getPost('keyword')
			]
		);
	}

	public function cariKelas()
	{
		return view(
			"ajax/cariKelas",
			[
				'kelas' => $this->kelasModel->cari(
					$this->request->getPost('keyword')
				),
				'keyword' => $this->request->getPost('keyword')
			]
		);
	}

	public function cariSpp()
	{
		return view(
			"ajax/cariSpp",
			[
				'spp' => $this->sppModel->cari(
					$this->request->getPost('keyword')
				),
				'keyword' => $this->request->getPost('keyword')
			]
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
				'user' => $this->user,
				'keyword' => $this->request->getPost('keyword')
			]
		);
	}

	public function cariSiswa()
	{
		return view(
			"ajax/cariSiswa",
			[
				'siswa' => $this->siswaModel->cari(
					$this->request->getPost('keyword')
				),
				'keyword' => $this->request->getPost('keyword')
			]
		);
	}
}

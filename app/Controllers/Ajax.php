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
	public function pembayaran($keyword)
	{
		if ($keyword == "-1") {
			$keyword = "";
		}

		return view(
			'ajax/pembayaran',
			[
				'siswa' => $this->siswaModel->pembayaran($keyword),
				'keyword' => $keyword,
			]
		);
	}

	public function siswa($nisn)
	{
		if ($nisn == "-1") {
			$nisn = "";
		}

		$data = ['siswa' => $this->pembayaranModel->getPembayaran($nisn)];

		helper('pembayaran');

		foreach ($data['siswa'] as $item) {
			$item->bulan_dibayar = getBulan($item->bulan_dibayar);
		}

		return view('ajax/siswa', $data);
	}

	public function dataSiswa($nisn)
	{
		if ($nisn == "-1") {
			$nisn = "";
		}

		$siswa = $this->siswaModel->get($nisn);
		return json_encode($siswa);
	}
	// =========================================

	// AJAX data pembayaran pada halaman laporan
	public function laporan($tahun)
	{
		if ($tahun == "-1") {
			$tahun = "";
		}

		$spp = implode("/", explode("-", $tahun));

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
	public function cariJurusan($keyword)
	{
		if ($keyword == "-1") {
			$keyword = "";
		}

		return view(
			"ajax/cariJurusan",
			[
				'jurusan' => $this->jurusanModel->cari($keyword),
				'keyword' => $keyword
			]
		);
	}

	public function cariKelas($keyword)
	{
		if ($keyword == "-1") {
			$keyword = "";
		}

		return view(
			"ajax/cariKelas",
			[
				'kelas' => $this->kelasModel->cari($keyword),
				'keyword' => $keyword
			]
		);
	}

	public function cariSpp($keyword)
	{
		if ($keyword == "-1") {
			$keyword = "";
		}

		return view(
			"ajax/cariSpp",
			[
				'spp' => $this->sppModel->cari($keyword),
				'keyword' => $keyword
			]
		);
	}

	public function cariPetugas($keyword)
	{
		if ($keyword == "-1") {
			$keyword = "";
		}

		return view(
			"ajax/cariPetugas",
			[
				'petugas' => $this->petugasModel->cari($keyword),
				'user' => $this->user,
				'keyword' => $keyword
			]
		);
	}

	public function cariSiswa($keyword)
	{
		if ($keyword == "-1") {
			$keyword = "";
		}

		return view(
			"ajax/cariSiswa",
			[
				'siswa' => $this->siswaModel->cari($keyword),
				'keyword' => $keyword
			]
		);
	}
}

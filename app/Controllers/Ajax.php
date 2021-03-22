<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;

class Ajax extends BaseController
{
	protected $model;
	protected $siswaModel;

	public function __construct()
	{
		$this->pembayaranModel = new PembayaranModel();
		$this->siswaModel = new SiswaModel();
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
}

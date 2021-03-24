<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;
use App\Models\SppModel;

class Main extends BaseController
{
	protected $model;
	protected $siswaModel;
	protected $sppModel;

	public function __construct()
	{
		$this->model = new PembayaranModel();
		$this->siswaModel = new SiswaModel();
		$this->sppModel = new SppModel();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		$kelasModel = new KelasModel();

		$this->data['loginStatus'] = $this->session->get('success');

		if ($this->session->user['role'] === 'siswa') {
			$this->data['pembayaran'] = $this->model->getPembayaran($this->user->nisn);
			$this->data['title'] = "Sistem Pembayaran Spp";

			return view("main/home", $this->data);
		} else {
			$this->data['title'] = "Dashboard";
			$this->data['countPembayaran'] = $this->model->getCount();
			$this->data['pembayaran'] = json_encode($this->model->getReport());
			$this->data['siswa'] = $this->siswaModel->getCount();
			$this->data['kelas'] = $kelasModel->getCount();
			$this->data['diagram'] = true;

			return view("main/index", $this->data);
		}
	}

	public function payment()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] === 'siswa') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Pembayaran Spp";
		$this->data['bulan'] = date('M');
		$this->data['siswa'] = $this->siswaModel->get();
		$this->data['sppSiswa'] = $this->session->nisn != null ? $this->siswaModel->get($this->session->nisn) : false;
		$this->data['pembayaran'] = $this->model->getPembayaran($this->session->nisn);

		return view("main/pembayaran", $this->data);
	}

	public function pay()
	{
		$data = $this->request->getPost(['nisn', 'id_spp', 'bulan_dibayar', 'jumlah_bayar']);
		$data['tahun_dibayar'] = $this->request->getPost('tahun') . '/' . $this->request->getPost('tahun2');

		helper(['form', 'url', 'date']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'pembayaran')) {
			$this->session->setFlashdata('message', [
				'icon' => "error",
				'title' => "Tidak dapat menambahkan data!",
				'text' => "Silahkan cari Siswa terlebih dahulu!"
			]);

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/pembayaran');
		} else {
			if ($this->model->bulanSpp($data['nisn'], $data['bulan_dibayar'], $data['tahun_dibayar'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "Spp {$data['bulan_dibayar']} - {$data['tahun_dibayar']} untuk Siswa dengan NISN {$data['nisn']} telah dibayar"
				]);

				$this->session->setFlashdata('nisn', $data['nisn']);

				// Kembali ke halaman login dan mengirimkan input sebelumnya
				return redirect()->to('/pembayaran');
			}

			$data['petugas'] = $this->session->user['username'];
			$data['tgl_bayar'] = date('Y-m-d', now("Asia/Jakarta"));

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Menambahkan');
			$this->session->setFlashdata('nisn', $data['nisn']);

			return redirect()->to("/pembayaran");
		}
	}

	public function report()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Laporan Pembayaran Spp";
		$this->data['spp'] = $this->model->getTahun();
		$this->data['pembayaran'] = $this->model->laporan($this->data['spp'][0]->tahun_dibayar);
		$this->data['total'] = $this->model->getSum($this->data['spp'][0]->tahun_dibayar);

		return view('main/laporan', $this->data);
	}

	public function receipt($id)
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		$id = (int)$id;

		helper(['pembayaran', 'date']);

		if ($id == 0) {
			return view('errors/html/error_404');
		}

		return view("main/kuitansi", ['pembayaran' => $this->model->get($id), 'role' => $this->role]);
	}

	public function print($tahun)
	{
		$spp = implode("/", explode("-", $tahun));

		$data = [
			'title' => "Laporan-Spp-Tahun-$tahun.pdf",
			'pembayaran' => $this->model->laporan($spp),
			'total' => $this->model->getSum($spp),
			'tahun' => $spp,
		];

		return view("main/printLaporan", $data);
	}
}

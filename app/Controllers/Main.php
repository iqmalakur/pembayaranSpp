<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;

class Main extends BaseController
{
	protected $model;
	protected $siswaModel;

	public function __construct()
	{
		$this->model = new PembayaranModel();
		$this->siswaModel = new SiswaModel();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] === 'siswa') {
			$this->data['title'] = "Sistem Pembayaran Spp";
		} else {
			$this->data['title'] = "Dashboard";
		}

		$this->data['loginStatus'] = $this->session->get('success');
		$this->data['pembayaran'] = $this->model->get();

		return view("main/index", $this->data);
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
		$this->data['pembayaran'] = $this->model->get();

		return view("main/payment", $this->data);
	}

	public function pay()
	{
		$data = $this->request->getPost(['nisn', 'id_spp', 'bulan_dibayar', 'tahun_dibayar', 'jumlah_bayar']);

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

				// Kembali ke halaman login dan mengirimkan input sebelumnya
				return redirect()->to('/pembayaran');
			}

			$data['petugas'] = $this->session->user['username'];
			$data['tgl_bayar'] = date('Y-m-d', now("Asia/Jakarta"));

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Menambahkan');

			return redirect()->to("/pembayaran");
		}
	}

	public function report($data)
	{
		// Generate Laporan
	}

	public function receipt($data)
	{
		echo "Kuitansi";
		if (!$this->session->login) {
			return redirect()->to('/login');
		}
		// Kuitansi
	}

	public function detail($id)
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] === 'siswa') {
			return view('errors/html/error_404');
		}

		$this->data['pembayaran'] = $this->model->get($id);
		$this->data['title'] = "Detail Pembayaran Spp";

		return view("main/detail", $this->data);
	}

	public function print()
	{
		$this->data['pembayaran'] = $this->model->get($this->request->getPost('id'));
		$this->data['title'] = $this->data['pembayaran']->id_pembayaran . '-' . $this->data['pembayaran']->nisn . '.pdf';

		return view("main/print", $this->data);
	}

	// AJAX
	public function ajaxPembayaran()
	{
		$keyword = $this->request->getPost("keyword");
		return view('ajax/pembayaran', ['siswa' => $this->siswaModel->searchAjax($keyword)]);
	}

	public function getSiswa()
	{
		$siswa = $this->siswaModel->get($this->request->getPost("nisn"));
		return "$siswa->nisn,$siswa->nama - $siswa->nama_kelas,$siswa->id_spp,$siswa->tahun,$siswa->nominal";
	}

	public function sidebar()
	{
		$this->session->set('sidebar', $this->request->getPost('sidebar'));
	}
}

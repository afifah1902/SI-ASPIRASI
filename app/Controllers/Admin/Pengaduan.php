<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\Admin\PengaduanModel;
use App\Models\BuktiModel;

class Pengaduan extends BaseController
{
	public function __construct()
	{
		$this->pengaduan = new PengaduanModel();
		$this->bukti = new BuktiModel();
	}

	public function approval($id)
	{
		$status = $this->request->getVar('status_aspirasi');
		$new_status = $status + 1;

		$this->pengaduan->save([
			'id' => $id,
			'status_aspirasi' => $new_status,
			'keterangan' => 'ACC',
		]);

		if ($this->request->isAjax()) {
			$data = [
				'status' => TRUE,
				'msg' => 'Status aspirasi berhasil diperbarui.'
			];

			echo json_encode($data);
		} else {
			session()->setFlashData('msg', 'Status aspirasi berhasil diubah.');
			return redirect()->to('/admin/pengaduan/masuk');
		}
	}

	public function approval2($id)
	{
		$status = $this->request->getVar('status_aspirasi');
		$new_status = $status + 1;
	

		$this->pengaduan->save([
			'id' => $id,
			'status_aspirasi' => $new_status,
			'keterangan' => 'ACC',
		]);

		if ($this->request->isAjax()) {
			$data = [
				'status' => TRUE,
				'msg' => 'Status aspirasi berhasil diperbarui.'
			];

			echo json_encode($data);
		} else {
			session()->setFlashData('msg', 'Status aspirasi berhasil diubah.');
			return redirect()->to('/admin/pengaduan/diproses');
		}
	}

	public function rejected1($id)
	{
		$status = $this->request->getVar('status_aspirasi');
		$new_status = ($status == 1 || $status == 2) ? 4 : $status + 1;
		$alasan = $this->request->getVar('keterangan');
		$keterangan = $this->request->getPost('keterangan');

		$this->pengaduan->save([
			'id' => $id,
			'status_aspirasi' => $new_status,
			'keterangan' => $keterangan
		]);

		if ($this->request->isAjax()) {
			$data = [
				'status' => TRUE,
				'msg' => 'Status aspirasi berhasil diperbarui.'
			];

			echo json_encode($data);
		} else {
			session()->setFlashData('msg', 'Status aspirasi berhasil diubah.');
			return redirect()->to('/admin/pengaduan/' . $id);
		}
	}

	public function rejected2($id) //tolak oleh pemdes
	{
		$status = $this->request->getVar('status_aspirasi');
		$new_status = ($status == 1 || $status == 2) ? 5 : $status + 1;
		$alasan = $this->request->getVar('keterangan');
		$keterangan = $this->request->getPost('keterangan');

		$this->pengaduan->save([
			'id' => $id,
			'status_aspirasi' => $new_status,
			'keterangan' => $keterangan
		]);

		if ($this->request->isAjax()) {
			$data = [
				'status' => TRUE,
				'msg' => 'Status aspirasi berhasil diperbarui.'
			];

			echo json_encode($data);
		} else {
			session()->setFlashData('msg', 'Status aspirasi berhasil diubah.');
			return redirect()->to('/admin/pengaduan/' . $id);
		}
	}
	

	public function soft_delete($id)
	{
		$this->bukti->soft_delete($id);

		$this->pengaduan->save([
			'id' => $id,
			'deleted_at' => date('Y-m-d H:i:s'),
			'row_status' => 0
		]);

		session()->setFlashdata('msg', 'Data berhasil dihapus.');
		return redirect()->to('/admin/pengaduan');
	}

	public function detail($id)
	{
		$data = [
			'user' => $this->user,
			'title' => 'Detail Aspirasi',
			'data' => $this->pengaduan->find($id),
			'bukti' => $this->bukti->getBukti($id),
		];

		if (empty($data['data'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengaduan Aspirasi tidak ditemukan.');
		}

		return view('admin/pengaduan/detail_pengaduan', $data);
	}
	public function detail2($id)
	{
		$data = [
			'user' => $this->user,
			'title' => 'Detail Aspirasi',
			'data' => $this->pengaduan->find($id),
			'bukti' => $this->bukti->getBukti($id),
		];

		if (empty($data['data'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengaduan Aspirasi tidak ditemukan.');
		}

		return view('admin/pengaduan/detail_pengaduan2', $data);
	}
	public function index()
	{
		$data = [
			'user' => $this->user,
			'title' => 'Daftar Semua Aspirasi',
		];

		return view('admin/pengaduan/index', $data);
	}

	public function dt_pengaduan()
	{

		if ($this->request->getMethod() == "post") {
			if ($this->request->isAjax()) {
				$model = $this->pengaduan;
				$lists = $model->get_datatables();

				$data = [];
				$no = $this->request->getPost("start");

				foreach ($lists as $list) {
					$no++;

					$row = [];

					$row[] = $no;
					$row[] = $list->created_at;
					$row[] = $list->judul_aspirasi;
					//$row[] = ($list->status_aspirasi == 1 ? '<span class="badge-primary p-1 rounded-sm">Proses RT</span>' : ($list->status_aspirasi == 2 ? '<span class="badge-success p-1 rounded-sm">Proses Pemdes</span>' : '<span class="badge-info p-1 rounded-sm">selesai</span>'));
					$row[] = ($list->status_aspirasi == 1 ? '<span class="badge-primary p-1 rounded-sm">Proses RT</span>' : 
         					($list->status_aspirasi == 2 ? '<span class="badge-success p-1 rounded-sm">Proses Pemdes</span>' : 
         					($list->status_aspirasi == 3 ? '<span class="badge-danger p-1 rounded-sm">Disetujui</span>' :
							 ($list->status_aspirasi == 4 ? '<span class="badge-danger p-1 rounded-sm">Ditolak RT</span>' :  
         					'<span class="badge-info p-1 rounded-sm">Ditolak Pemdes</span>'))));
					$row[] = "<a href=\"/admin/pengaduan/$list->id\" class=\"btn btn-sm btn-info\">Detail</a>";

					$data[] = $row;
				}
				$output = [
					"recordTotal" => $model->count_all(),
					"recordsFiltered" => $model->count_filtered(),
					"data" => $data
				];

				echo json_encode($output);
			}
		}
	}
	
	public function pengaduan_masuk()
	{	  
		$data = [
			'user' => $this->user,
			'title' => 'Daftar Aspirasi - Masuk',
			'data' => $this->pengaduan->where(['user_id' => $this->user['id'], 'row_status' => 1])->orderBy('created_at', 'DESC')->findAll()
		];

		return view('admin/pengaduan/masuk', $data);
	}

	public function dt_pengaduan_masuk(){
		if ($this->request->getMethod()) {
			if ($this->request->isAjax()) {
				$model = $this->pengaduan;
				$user = $this->user;
				$lists = $model->get_datatables_pm();
				$data = [];
				$no = $this->request->getPost("start");

				foreach ($lists as $list) {
					$no++;

					$row = [];

					$row[] = $no;
					$row[] = date('d M Y', strtotime($list->created_at));
					$row[] = $list->judul_aspirasi;
					$row[] = "<a href=\"/admin/pengaduan/$list->id\" 
					class=\"btn btn-sm btn-info\">Detail</a>"; 

					$data[] = $row;
				}
				$output = [
					"recordTotal" => $model->count_all(),
					"recordsFiltered" => $model->count_filtered_pm(),
					"data" => $data
				];

				echo json_encode($output);
			}
		}
	}

	public function pengaduan_diproses()
	{
		$data = [
			'user' => $this->user,
			'title' => 'Daftar Aspirasi - Proses Pemdes'
		];

		return view('admin/pengaduan/diproses', $data);
	}

	public function dt_pengaduan_diproses()
	{
		if ($this->request->getMethod()) {
			if ($this->request->isAjax()) {
				$model = $this->pengaduan;
				$lists = $model->get_datatables_dp();

				$data = [];
				$no = $this->request->getPost("start");

				foreach ($lists as $list) {
					$no++;

					$row = [];

					$row[] = $no;
					$row[] = date('d M Y', strtotime($list->created_at));
					$row[] = $list->judul_aspirasi;
					$row[] = "<a href=\"/admin/pengaduan/detail2/$list->id\" class=\"btn btn-sm btn-info\">Detail</a>"; 

					$data[] = $row;
				}
				$output = [
					"recordTotal" => $model->count_all(),
					"recordsFiltered" => $model->count_filtered_dp(),
					"data" => $data
				];

				echo json_encode($output);
			}
		}
	}

	public function pengaduan_diselesaikan()
	{
		$data = [
			'user' => $this->user,
			'title' => 'Daftar Aspirasi - Diselesaikan',
		];

		return view('admin/pengaduan/diselesaikan', $data);
	}

	public function dt_pengaduan_diselesaikan()
	{
		if ($this->request->getMethod()) {
			if ($this->request->isAjax()) {
				$model = $this->pengaduan;
				$lists = $model->get_datatables_ds();

				$data = [];
				$no = $this->request->getPost("start");

				foreach ($lists as $list) {
					$no++;

					$row = [];

					$row[] = $no;
					$row[] = date('d M Y', strtotime($list->created_at));
					$row[] = $list->judul_aspirasi;
					$row[] = "<a href=\"/admin/pengaduan/detail2/$list->id\" class=\"btn btn-sm btn-info\">Detail</a>"; 

					$data[] = $row;
				}
				$output = [
					"recordTotal" => $model->count_all(),
					"recordsFiltered" => $model->count_filtered_ds(),
					"data" => $data
				];
				echo json_encode($output);
			}
		}
	}

	public function pengaduan_setuju()
	{	  
		$data = [
			'user' => $this->user,
			'title' => 'Daftar Aspirasi - Setuju RT',
			'data' => $this->pengaduan->where(['user_id' => $this->user['id'], 'row_status' => 1])->orderBy('created_at', 'DESC')->findAll()
		];

		return view('admin/pengaduan/setuju', $data);
	}

	public function dt_pengaduan_setuju(){
		if ($this->request->getMethod()) {
			if ($this->request->isAjax()) {
				$model = $this->pengaduan;
				$user = $this->user;
				$lists = $model->get_datatables_ps();
				$data = [];
				$no = $this->request->getPost("start");

				foreach ($lists as $list) {
					$no++;

					$row = [];

					$row[] = $no;
					$row[] = date('d M Y', strtotime($list->created_at));
					$row[] = $list->judul_aspirasi;
					$row[] = "<a href=\"/admin/pengaduan/$list->id\" 
					class=\"btn btn-sm btn-info\">Detail</a>";  

					$data[] = $row;
				}
				$output = [
					"recordTotal" => $model->count_all(),
					"recordsFiltered" => $model->count_filtered_ps(),
					"data" => $data
				];

				echo json_encode($output);
			}
		}
	}
}

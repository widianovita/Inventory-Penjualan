<?php

namespace App\Controllers;

use App\Models\SalesModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Format\JSONFormatter;

class Sales extends BaseController
{
    use ResponseTrait;
    protected $salesModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
    }

    public function index()
    {
        $data = $this->salesModel->findAll();
        if (!$data) return $this->failNotFound('Data tidak ditemukan!');
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->salesModel->find(['id' => $id]);
        if (!$data) return $this->failNotFound('Data tidak ditemukan!');
        return $this->respond($data[0]);
    }

    public function create()
    {
        $json = $this->request->getJSON();
        $data = [
            'kode_transaksi'    => $json->kode_transaksi,
            'tanggal_transaksi' => $json->tanggal_transaksi,
            'customer'          => $json->customer,
            'item'              => $json->item,
            'qty'               => $json->qty,
            'total_diskon'      => $json->total_diskon,
            'total_harga'       => $json->total_harga,
            'total_bayar'       => $json->total_bayar
        ];

        $sales = $this->salesModel->insert($data);
        if (!$data) return $this->fail('Gagal menyimpan data!', 400);
        return $this->respondCreated($sales);
    }

    public function update($id = null)
    {
        $json = $this->request->getJSON();
        $data = [
            'kode_transaksi'    => $json->kode_transaksi,
            'tanggal_transaksi' => $json->tanggal_transaksi,
            'customer'          => $json->customer,
            'item'              => $json->item,
            'qty'               => $json->qty,
            'total_diskon'      => $json->total_diskon,
            'total_harga'       => $json->total_harga,
            'total_bayar'       => $json->total_bayar
        ];

        $cekId = $this->salesModel->find(['id' => $id]);
        if (!$cekId) return $this->fail('Data tidak ditemukan', 404);
        $sales = $this->salesModel->update($id, $data);
        if (!$sales) return $this->fail('Gagal mengubah data!', 400);
        return $this->respond($sales);
    }

    public function delete($id = null)
    {
        $cekId = $this->salesModel->find(['id' => $id]);
        if (!$cekId) return $this->fail('Data tidak ditemukan!', 404);
        $sales = $this->salesModel->delete($id);
        if (!$sales) return $this->fail('Gagal menghapus data!', 400);
        return $this->respondDeleted('Data berhasil dihapus.');
    }
}

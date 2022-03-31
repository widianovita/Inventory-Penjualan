<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Format\JSONFormatter;

class Customer extends BaseController
{
    use ResponseTrait;
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $data = $this->customerModel->findAll();
        if (!$data) return $this->failNotFound('Data tidak ditemukan!');
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->customerModel->find(['id' => $id]);
        if (!$data) return $this->failNotFound('Data tidak ditemukan!');
        return $this->respond($data[0]);
    }

    public function create()
    {
        $json = $this->request->getJSON();
        $data = [
            'nama'        => $json->nama,
            'contact'     => $json->contact,
            'email'       => $json->stok,
            'alamat'      => $json->harga_satuan,
            'diskon'      => $json->barang,
            'tipe_diskon' => $json->tipe_diskon,
            'ktp'         => $json->ktp
        ];

        $customer = $this->customerModel->insert($data);
        if (!$data) return $this->fail('Gagal menyimpan data!', 400);
        return $this->respondCreated($customer);
    }

    public function update($id = null)
    {
        $json = $this->request->getJSON();
        $data = [
            'nama'        => $json->nama,
            'contact'     => $json->contact,
            'email'       => $json->stok,
            'alamat'      => $json->harga_satuan,
            'diskon'      => $json->barang,
            'tipe_diskon' => $json->tipe_diskon,
            'ktp'         => $json->ktp
        ];

        $cekId = $this->customerModel->find(['id' => $id]);
        if (!$cekId) return $this->fail('Data tidak ditemukan', 404);
        $customer = $this->customerModel->update($id, $data);
        if (!$customer) return $this->fail('Gagal mengubah data!', 400);
        return $this->respond($customer);
    }

    public function delete($id = null)
    {
        $cekId = $this->customerModel->find(['id' => $id]);
        if (!$cekId) return $this->fail('Data tidak ditemukan!', 404);
        $customer = $this->customerModel->delete($id);
        if (!$customer) return $this->fail('Gagal menghapus data!', 400);
        return $this->respondDeleted('Data berhasil dihapus.');
    }
}

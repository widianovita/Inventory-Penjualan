<?php

namespace App\Controllers;

use App\Models\ItemModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Format\JSONFormatter;

class Item extends ResourceController
{
    use ResponseTrait;
    protected $itemModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data = $this->itemModel->findAll();
        if (!$data) return $this->failNotFound('Data tidak ditemukan!');
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->itemModel->find(['id' => $id]);
        if (!$data) return $this->failNotFound('Data tidak ditemukan!');
        return $this->respond($data[0]);
    }

    public function create()
    {
        $json = $this->request->getJSON();
        $data = [
            'nama_item'     => $json->nama_item,
            'unit'          => $json->unit,
            'stok'          => $json->stok,
            'harga_satuan'  => $json->harga_satuan,
            'barang'        => $json->barang
        ];

        $item = $this->itemModel->insert($data);
        if (!$data) return $this->fail('Gagal menyimpan data!', 400);
        return $this->respondCreated($item);
    }

    public function update($id = null)
    {
        $json = $this->request->getJSON();
        $data = [
            'nama_item'     => $json->nama_item,
            'unit'          => $json->unit,
            'stok'          => $json->stok,
            'harga_satuan'  => $json->harga_satuan,
            'barang'        => $json->barang
        ];

        $cekId = $this->itemModel->find(['id' => $id]);
        if (!$cekId) return $this->fail('Data tidak ditemukan', 404);
        $item = $this->itemModel->update($id, $data);
        if (!$item) return $this->fail('Gagal mengubah data!', 400);
        return $this->respond($item);
    }

    public function delete($id = null)
    {
        $cekId = $this->itemModel->find(['id' => $id]);
        if (!$cekId) return $this->fail('Data tidak ditemukan!', 404);
        $item = $this->itemModel->delete($id);
        if (!$item) return $this->fail('Gagal menghapus data!', 400);
        return $this->respondDeleted('Data berhasil dihapus.');
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table    = 'sales';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_transaksi', 'tanggal_transaksi', 'customer', 'item', 'qty', 'total_diskon', 'total_harga', 'total_bayar'];
}

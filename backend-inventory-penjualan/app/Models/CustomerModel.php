<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table    = 'customer';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'contact', 'email', 'alamat', 'diskon', 'tipe_diskon', 'ktp'];
}

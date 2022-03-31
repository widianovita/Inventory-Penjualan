<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_transaksi'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_transaksi'       => [
                'type'       => 'DATETIME',
            ],
            'customer'       => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'item'       => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'qty'       => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'total_diskon'       => [
                'type'       => 'DOUBLE',
            ],
            'total_harga'       => [
                'type'       => 'DOUBLE',
            ],
            'total_bayar'       => [
                'type'       => 'DOUBLE',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sales');
    }

    public function down()
    {
        $this->forge->dropTable('sales');
    }
}
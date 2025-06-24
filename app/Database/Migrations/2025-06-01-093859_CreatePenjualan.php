<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'laptop_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'nama_laptop' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'harga' => [
                'type' => 'INT',
            ],
            'tanggal' => [
                'type' => 'DATETIME',
                'null'=> false,
            ],
            'jumlah' => [
                'type' => 'INT',
                'default' => 1,
            ],
            'total_harga' => [
                'type' => 'INT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('penjualan');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan');
    }
}

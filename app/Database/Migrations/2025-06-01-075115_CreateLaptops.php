<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaptops extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama'        => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'spesifikasi' => [
                'type' => 'TEXT',
            ],
            'harga'       => [
                'type' => 'INT',
            ],
            'gambar'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'stok' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'created_at'  => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at'  => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('laptops');
    }

    public function down()
    {
        $this->forge->dropTable('laptops');
    }
}

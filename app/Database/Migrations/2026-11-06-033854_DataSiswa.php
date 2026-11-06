<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataSiswa extends Migration
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
        'nama' => [
            'type'       => 'VARCHAR',
            'constraint' => '100',
        ],
        'nis' => [
            'type'       => 'VARCHAR',
            'constraint' => '100',
        ],
        'tanggal_lahir' => [
            'type'       => 'DATE',
        ],
        'asal' => [
            'type'       => 'VARCHAR',
            'constraint' => '100',
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
    $this->forge->createTable('data_siswa');

    }
    public function down()
    {
        $this->forge->dropTable('data_siswa');
    }
}

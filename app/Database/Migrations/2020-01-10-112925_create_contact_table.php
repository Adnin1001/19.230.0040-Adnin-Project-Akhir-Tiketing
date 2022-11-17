<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'status'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
            'deleted_at'  => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('status', false, ['ENGINE' => 'InnoDB']);

        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'status_id'   => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'null' => true],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => '100'],
            'nohp'        => ['type' => 'VARCHAR', 'constraint' => '100'],
            'tglberangkat'=> ['type' => 'DATE'],
            'kelasarmada' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'kotatujuan'  => ['type' => 'VARCHAR', 'constraint' => '100'],
            'tiket'       => ['type' => 'VARCHAR', 'constraint' => '100'],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
            'deleted_at'  => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('status_id');
        $this->forge->addForeignKey('status_id', 'status', 'id', false, 'CASCADE');
        $this->forge->createTable('tiket', false, ['ENGINE' => 'InnoDB']);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('tiket');
        $this->forge->dropTable('status');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_add_users extends CI_Migration {
    public function up()
    {
            $this->dbforge->add_field(array(
                    'id' => array(
                            'type' => 'INT',
                            'constraint' => 5,
                            'unsigned' => TRUE,
                            'auto_increment' => TRUE
                    ),
                    'nama' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                    ),
                    'email' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                    ),
                    'image' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                    ),
                    'create_at' => array(
                            'type' => 'DATETIME'
                    ),
                    'last_update' => array(
                            'type' => 'DATETIME'
                    ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('users');
    }

    public function down()
    {
            $this->dbforge->drop_table('users');
    }
}
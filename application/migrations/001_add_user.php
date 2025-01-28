<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_add_user extends CI_Migration {
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
                    'password' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '40',
                    ),
                    'image' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                    ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('admin');
            $data = [
                'nama' => 'admin',
                'email' => 'admin@mail.com',
                'password' => md5(sha1('12345')),
                'image' => 'default.webp'
            ];
            $this->db->insert('admin', $data);
    }

    public function down()
    {
            $this->dbforge->drop_table('admin');
    }
}
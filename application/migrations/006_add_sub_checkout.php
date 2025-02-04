<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_add_sub_checkout extends CI_Migration {
    public function up()
    {
            $this->dbforge->add_field(array(
                    'id' => array(
                            'type' => 'INT',
                            'constraint' => 11,
                            'unsigned' => TRUE,
                            'auto_increment' => TRUE
                    ),
                    'id_checkout' => array(
                            'type' => 'INT',
                            'constraint' => '11',
                    ),
                    'id_product' => array(
                            'type' => 'INT',
                            'constraint' => '11'
                    ),
                    'qty' => array(
                            'type' => 'INT',
                            'constraint' => '11'
                    ),
                    'price' => array(
                            'type' => 'INT',
                            'constraint' => '11'
                    ),
                    'subtotal' => array(
                            'type' => 'INT',
                            'constraint' => '11'
                    ),
                    'create_at' => array(
                            'type' => 'DATETIME',
                    ),
                    'last_update' => array(
                            'type' => 'DATETIME',
                    )
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('sub_checkout');
    }

    public function down()
    {
            $this->dbforge->drop_table('sub_checkout');
    }
}
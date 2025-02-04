<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_add_checkout extends CI_Migration {
    public function up()
    {
            $this->dbforge->add_field(array(
                    'id' => array(
                            'type' => 'INT',
                            'constraint' => 11,
                            'unsigned' => TRUE,
                    ),
                    'receipt_payment' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                    ),
                    'id_user' => array(
                            'type' => 'INT',
                            'constraint' => '11',
                    ),
                    'to' => array(
                            'type' => 'TEXT',
                    ),
                    'courier' => array(
                            'type' => 'TEXT',
                    ),
                    'receipt_courier' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                    ),
                    'proof_transaction' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                    ),
                    'total_items' => array(
                            'type' => 'INT',
                            'constraint' => '11',
                    ),
                    'total_weight' => array(
                            'type' => 'INT',
                            'constraint' => '11',
                    ),
                    'total_all' => array(
                            'type' => 'INT',
                            'constraint' => '11',
                    ),
                    'payment' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '20',
                    ),
                    'status' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '20',
                    ),
                    'create_at' => array(
                            'type' => 'DATETIME',
                    ),
                    'last_update' => array(
                            'type' => 'DATETIME',
                    ),
                    
                    

            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('checkout');
    }

    public function down()
    {
            $this->dbforge->drop_table('checkout');
    }
}
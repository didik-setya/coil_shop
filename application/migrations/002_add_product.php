<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_add_product extends CI_Migration {
    public function up()
    {
            $this->dbforge->add_field(array(
                    'id' => array(
                            'type' => 'INT',
                            'constraint' => 5,
                            'unsigned' => TRUE,
                            'auto_increment' => TRUE
                    ),
                    'product_name' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '255',
                    ),
                    'product_desc' => array(
                            'type' => 'TEXT',
                    ),
                    'product_price' => array(
                            'type' => 'int',
                            'constraint' => '11',
                    ),
                    'product_images' => array(
                            'type' => 'TEXT'
                    ),
                    'product_stock' => array(
                            'type' => 'int',
                            'constraint' => '11',
                    ),
                    'product_discount' => array(
                            'type' => 'int',
                            'constraint' => '2',
                    ),
                    'product_weight' => array(
                            'type' => 'int',
                            'constraint' => '11',
                    ),
                    'create_at' => array(
                            'type' => 'DATETIME',
                    ),
                    'last_update' => array(
                            'type' => 'DATETIME',
                    )
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('product');
            
    }

    public function down()
    {
            $this->dbforge->drop_table('product');
    }
}
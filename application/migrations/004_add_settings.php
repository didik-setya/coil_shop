<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_add_settings extends CI_Migration {
    public function up()
    {
            $this->dbforge->add_field(array(
                    'id' => array(
                            'type' => 'INT',
                            'constraint' => 5,
                            'unsigned' => TRUE,
                            'auto_increment' => TRUE
                    ),
                    'privacy_policy' => array(
                            'type' => 'TEXT',
                    ),
                    'refund_policy' => array(
                            'type' => 'TEXT',
                    ),
                    'payment_account' => array(
                            'type' => 'TEXT',
                    ),
                    'shipping' => array(
                            'type' => 'TEXT',
                    ),
                    'contact' => array(
                            'type' => 'TEXT',
                    ),
                    'address' => array(
                            'type' => 'TEXT',
                    ),
                    'social_media' => array(
                            'type' => 'TEXT',
                    ),
                    'shipping_point' => array(
                            'type' => 'TEXT',
                    ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('settings');

            $contact = [
                [
                        'name' => 'Email',
                        'logo' => '<i class="fa-regular fa-envelope"></i>',
                        'value' => 'mail@google.com'
                ],
                [
                        'name' => 'Whatsapp',
                        'logo' => '<i class="fa-brands fa-whatsapp"></i>',
                        'value' => '089776548890'
                ],
                [
                        'name' => 'Telp',
                        'logo' => '<i class="fa-solid fa-phone"></i>',
                        'value' => '089776548890'
                ],
            ];

            $point = [
                'province' => 'Jawa Timur',
                'city' => 'Jember',
                'distric' => 'Umbulsari',
                'subdistric' => 'Tanjungsari',
                'zip_code' => 68166
            ];
            
            $data = [
                'privacy_policy' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolore necessitatibus, repellat odio corrupti et',
                'refund_policy' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolore necessitatibus, repellat odio corrupti et iusto velit au',
                'shipping' => '[]',
                'payment_account' => '[]',
                'contact' => json_encode($contact),
                'address' => 'Jl. Surga 201m Jember',
                'social_media' => '',
                'shipping_point' => json_encode($point)
            ];
            $this->db->insert('settings', $data);
           
    }

    public function down()
    {
            $this->dbforge->drop_table('settings');
    }
}
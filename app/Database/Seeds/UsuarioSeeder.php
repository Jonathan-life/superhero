<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre' => 'Admin',
                'email' => 'admin@miapp.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'avatar' => 'default.jpg',
            ],
            [
                'nombre' => 'Usuario',
                'email' => 'usuario@miapp.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'avatar' => null,
            ],
        ];

        $this->db->table('usuarios')->insertBatch($data);
    }
}

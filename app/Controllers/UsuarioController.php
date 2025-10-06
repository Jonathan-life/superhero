<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class UsuarioController extends Controller
{
    public function formCrear()
    {
        return view('usuario/crear');
    }

    public function crear()
    {
        helper(['form', 'url']);
        $usuarioModel = new UsuarioModel();

        $avatarName = 'default.png';
        $avatar = $this->request->getFile('avatar');
        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $avatarName = $avatar->getRandomName();
            $avatar->move(FCPATH . 'images/avatars', $avatarName);
        }

        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'avatar'   => $avatarName
        ];

        if ($usuarioModel->insert($data)) {
            return redirect()->to('/login')->with('msg', '✅ Usuario registrado correctamente');
        } else {
            return redirect()->back()->with('error', '❌ No se pudo registrar el usuario');
        }
    }
}

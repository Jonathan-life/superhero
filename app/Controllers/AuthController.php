<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        helper(['form', 'url']);
        $session = session();

       
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($email && $password) {
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->where('email', $email)->first();

            if (!$usuario) {
                $session->setFlashdata('error', 'El usuario no existe.');
                return redirect()->to(base_url('/login'));
            }

          
            if (password_verify($password, $usuario['password'])) {
                $session->set([
                    'usuario_id'    => $usuario['id'],
                    'usuario_email' => $usuario['email'],
                    'logged_in'     => true
                ]);

                return redirect()->to(base_url('/perfil'));
            } else {
                $session->setFlashdata('error', 'Contraseña incorrecta.');
                return redirect()->to(base_url('/login'));
            }
        }

       
        return view('login');
    }

    public function perfil()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to(base_url('/login'));
        }

        // Obtener los datos completos del usuario desde la BD
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($session->get('usuario_id'));

        return view('perfil', [
            'usuario_nombre' => $usuario['nombre'],
            'usuario_email'  => $usuario['email'],
            'avatar'         => $usuario['avatar'] ?? 'default.png' 
        ]);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url('/login'));
    }
}

<?php

namespace App\Controllers;

use Exception;
use App\Models\User;
use App\Helpers\Session;
use App\Helpers\JsonResponse;
use App\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        $title = "Data Users";

        return $this->view('users.index', compact('users', 'title'));
    }

    public function create()
    {
        return $this->view('users.create');
    }

    public function store(Request $request)
    {
        try {

            User::create([
                'nama'     => $request->get('nama'),
                'email'    => $request->get('email'),
                'umur'     => $request->get('umur'),
                'password' => $request->get('password'),
            ]);

            Session::set('success', 'Data berhasil disimpan');
            return $this->redirect('/users');
        } catch (Exception $error) {
            Session::set('error', 'Data gagal disimpan');
            return $this->redirect('/users');
        }
    }

    public function show(int $id)
    {
        $user  = User::find($id)->first();
        $title = "Detail Users";

        return $this->view('users.show', compact('user', 'title'));
    }

    public function edit(int $id)
    {
        $user = User::find($id)->first();

        return $this->view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {

            $user = User::find($id);

            $user = $user->update([
                'nama'     => $request->get('nama'),
                'email'    => $request->get('email'),
                'umur'     => $request->get('umur'),
                'password' => $request->get('password'),
            ]);

            Session::set('success', 'Data berhasil di update');
            return $this->redirect('/users');
        } catch (Exception $error) {
            Session::set('error', 'Data gagal di update');
            return $this->redirect('/users');
        }
    }

    public function destroy(int $id)
    {
        try {

            $user = User::find($id);
            
            if ( !$user->delete() ) {
                throw new Exception;
            }

            Session::set('success', 'Data berhasil dihapus');
            return $this->redirect('/users');
        } catch (Exception $error) {
            Session::set('error', 'Data gagal dihapus');
            return $this->redirect('/users');
        }
    }
}

<?php

namespace App\Controllers;

use \App\Models\UserModel;
use CodeIgniter\Validation\Rules;

class Auth extends BaseController
{
	protected $UserModel;
	public function __construct()
	{
		$this->UserModel = new UserModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Login',
			'validation' => \Config\Services::validation()
		];
		if (session('nim')) {
			header('Location: ' . base_url('User'));
			exit();
		}
		return view('auth/login', $data);
	}

	public function login()
	{

		$validation = \Config\Services::validation();
		// validasi input
		if ($this->validate([
			'nim' 	=> [
				'rules'		=> 'required|trim',
				'errors'	=> ['required' 	 => 'NIM harus di isi!']
			],
			'password' 	=> [
				'rules'		=> 'required',
				'errors'	=> ['required' 	 => 'Password harus di isi!']
			]
		])) {
			$nim = $this->request->getVar('nim');
			$password = $this->request->getVar('password');

			$user = $this->UserModel->where(['nim' => $nim])->first();

			// login verifikasi NIM
			if ($user != null) {
				// login verifikasi aktivasi akun
				if ($user['is_active'] == 1) {
					// login verifikasi password
					if (password_verify($password, $user['password'])) {
						// cek role id
						if ($user['role_id'] == 1) {
							$data = [
								'nim' => $user['nim'],
								'role_id' => $user['role_id']
							];
							session()->set($data);
							return redirect()->to('/User');
						} elseif ($user['role_id'] == 2) {
							$data = [
								'nim' => $user['nim'],
								'role_id' => $user['role_id']
							];
							session()->set($data);
							return redirect()->to('/User');
						} elseif ($user['role_id'] == 3) {
							$data = [
								'nim' => $user['nim'],
								'role_id' => $user['role_id']
							];
							session()->set($data);
							return redirect()->to('/User');
						}
					}
					session()->setFlashdata('pesan', 'Password yang anda masukan tidak sesuai');
					return redirect()->to('/Auth')->withInput();
				}
				session()->setFlashdata('pesan', 'Akun Belum diaktivasi');
				return redirect()->to('/Auth')->withInput();
			} else {
				session()->setFlashdata('pesan', 'NIM yang anda masukan tidak sesuai');
				return redirect()->to('/Auth')->withInput();
			}
		}

		return redirect()->to('/Auth')->withInput();
	}

	public function register()
	{
		$data = [
			'title' => 'Registration',
			'validation' => \Config\Services::validation()
		];
		if (session('nim')) {
			header('Location: ' . base_url('User'));
			exit();
		}
		return view('auth/register', $data);
	}

	public function save()
	{
		// Validasi Input
		if (!$this->validate([
			'nim' 		=> 'required|is_unique[user.nim]',
			'nama' 		=> 'required',
			'telepon' 	=> 'required',
			'tmptLahir' => 'required',
			'tglLahir' 	=> 'required',
			'rtrw'	 	=> 'required',
			'desa'	 	=> 'required',
			'kecamatan'	=> 'required',
			'kota'	 	=> 'required',
			'email'	 	=> 'required|valid_email',
			'password' 	=> [
				'rules'		=> 'required|matches[password2]|min_length[6]',
				'errors'	=> [
					'required' 	 => 'Password harus di isi!',
					'matches'  	 => 'Password tidak sesuai',
					'min_length' => 'Password minimal 6 karakter'
				]
			],
			'password2' 	=> [
				'rules'		=> 'required|matches[password]',
				'errors'	=> [
					'required' 	 => 'Password harus di isi!',
					'matches'  	 => 'Password tidak sesuai',
				]
			]
		])) {
			return redirect()->to('/Auth/register')->withInput();
		}
		$this->UserModel->save([
			'nim' 		=> htmlspecialchars($this->request->getVar('nim')),
			'nama' 		=> htmlspecialchars($this->request->getVar('nama')),
			'telepon' 	=> htmlspecialchars($this->request->getVar('telepon')),
			'gender' 	=> $this->request->getVar('gender'),
			'tmptLahir' => htmlspecialchars($this->request->getVar('tmptLahir')),
			'tglLahir' 	=> $this->request->getVar('tglLahir'),
			'rtrw' 		=> htmlspecialchars($this->request->getVar('rtrw')),
			'desa' 		=> htmlspecialchars($this->request->getVar('desa')),
			'kecamatan' => htmlspecialchars($this->request->getVar('kecamatan')),
			'kota' 		=> htmlspecialchars($this->request->getVar('kota')),
			'image'		=> 'default.svg',
			'role_id' 	=> '3',
			'email' 	=> $this->request->getVar('email'),
			'password' 	=> password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),

		]);
		session()->setFlashdata('logout', 'Akun telah di daftarkan, harap menunggu konfirmasi admin!');
		return redirect()->to('/Auth');
	}

	public function user()
	{
		$data = [
			'title' => 'Menu'
		];
		return view('user/index', $data);
	}

	public function logout()
	{
		unset(
			$_SESSION['nim'],
			$_SESSION['role_id']
		);
		session()->setFlashdata('logout', 'Anda Berhasil Logout');
		return redirect()->to('/Auth');
	}
	public function blocked()
	{
		$data = [
			'title' => 'Blocked'
		];
		return view('auth/blocked', $data);
	}
}

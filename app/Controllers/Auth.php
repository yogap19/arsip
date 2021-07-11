<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\BannedModel;
use CodeIgniter\Validation\Rules;

class Auth extends BaseController
{
	protected $UserModel;
	protected $BannedModel;
	public function __construct()
	{
		$this->UserModel = new UserModel();
		$this->BannedModel = new BannedModel();
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
			'nim' 	=> [
				'rules'		=> 'required|is_unique[user.nim]|min_length[8]',
				'errors'	=> [
					'required' 	 	=> 'NIM harus di isi!',
					'is_unique'  	=> 'NIM sudah terdaftar',
					'min_length' 	=> 'NIM minimal 8 karakter'
				]
			],
			'nama' 	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required' 	 	=> 'NIM harus di isi!',
				]
			],
			'telepon' 	=> [
				'rules'		=> 'required|min_length[8]',
				'errors'	=> [
					'required' 	 	=> 'NIM harus di isi!',
					'min_length' 	=> 'Mohon masukan no telepon yang sesuai!'
				]
			],
			'tmptLahir' 	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required' 	 	=> 'Tempat lahir harus di isi!',
				]
			],
			'tglLahir' 	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required' 	 	=> 'Tanggal Lahir harus di isi!',
				]
			],
			'rtrw' 	=> [
				'rules'		=> 'required|max_length[4]',
				'errors'	=> [
					'required' 	 	=> 'Rt / Rw harus di isi!',
					'max_length' 	=> 'Format Rt / Rw tidak sesuai!'
				]
			],
			'desa' 	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required' 	 	=> 'Desa harus di isi!',
				]
			],
			'kecamatan' 	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required' 	 	=> 'Kecamatan harus di isi!',
				]
			],
			'kota' 	=> [
				'rules'		=> 'required',
				'errors'	=> [
					'required' 	 	=> 'Kota harus di isi!',
				]
			],
			'email' 	=> [
				'rules'		=> 'required|valid_email',
				'errors'	=> [
					'required' 	 	=> 'Kota harus di isi!',
					'valid_email' 	=> 'Format E-mail tidak sesuai!'
				]
			],
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
			],
			'pin' 	=> [
				'rules'		=> 'required|matches[pin2]|min_length[6]',
				'errors'	=> [
					'required' 	 => 'PIN harus di isi!',
					'matches'  	 => 'PIN tidak sesuai',
					'min_length' => 'PIN minimal 6 karakter'
				]
			],
			'pin2' 	=> [
				'rules'		=> 'required|matches[pin]',
				'errors'	=> [
					'required' 	 => 'PIN harus di isi!',
					'matches'  	 => 'PIN tidak sesuai',
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
			'rtrw' 		=> substr($this->request->getVar('rtrw'), 0, 2) . '/' . substr($this->request->getVar('rtrw'), 2, 2),
			'desa' 		=> htmlspecialchars($this->request->getVar('desa')),
			'kecamatan' => htmlspecialchars($this->request->getVar('kecamatan')),
			'kota' 		=> htmlspecialchars($this->request->getVar('kota')),
			'image'		=> 'default.svg',
			'role_id' 	=> '3',
			'email' 	=> $this->request->getVar('email'),
			'pin' 	    => password_hash($this->request->getVar('pin'), PASSWORD_DEFAULT),
			'password' 	=> password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),

		]);
		session()->setFlashdata('logout', 'Account has been created, please wait for admin confirmation!');
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

	public function forgotPassword()
	{
		unset($_SESSION['logout']);
		if (session('nim')) {
			header('Location: ' . base_url('User'));
			exit();
		}
		$nim = htmlspecialchars($this->request->getVar('nim'));
		$banned = $this->BannedModel->where(['nim' => $nim])->first();


		if ($nim != null) {
			if ($banned) {
				unset($_SESSION['pesan']);
				# nim sudah ada di daftar
				if (time() - $banned['time'] > (3 * 24)) {
					// update banned
					$this->BannedModel->save([
						'id'      => $banned['id'],
						'count'   => 3,
						'time'    => time()
					]);
					$data = [
						'title' 	 => 'Forgot Password',
						'validation' => \Config\Services::validation(),
						'nim' 		 => $nim
					];
					unset($_SESSION['pesan']);
					return view('auth/forgotPassword', $data);
				} else {
					$data = [
						'title' => 'Login',
						'validation' => \Config\Services::validation()
					];
					session()->setFlashdata('pesan', 'Account with NIM ' . $nim . ' is BANNED!!!');
					return view('auth/login', $data);
				}
			} else {
				// daftarkan nim
				$this->BannedModel->save([
					'nim' 		 => $nim,
					'time' 		 => time(),
					'count' 	 => 3,
				]);
				$data = [
					'title' 	 => 'Forgot Password',
					'validation' => \Config\Services::validation(),
					'nim' 		 => $nim
				];

				return view('auth/forgotPassword', $data);
			}
		} else {
			$data = [
				'title' => 'Login',
				'validation' => \Config\Services::validation()
			];

			session()->setFlashdata('pesan', 'NIM is required');
			return view('auth/login', $data);
		}
	}

	public function forgot($nim)
	{
		// validasi input
		if ($this->validate([
			'pin' 	=> [
				'rules'		=> 'required|min_length[6]',
				'errors'	=> [
					'required' 	 => 'PIN is required!',
					'min_length' => 'PIN must be at least 6 characters '
				]
			],
			'password' 	=> [
				'rules'		=> 'required|matches[password2]|min_length[6]',
				'errors'	=> [
					'required' 	 => 'Password is required!',
					'matches'  	 => 'password does not match ',
					'min_length' => 'Password must be at least 6 characters '
				]
			],
			'password2' 	=> [
				'rules'		=> 'required|matches[password]',
				'errors'	=> [
					'required' 	 => 'Password is required!',
					'matches'  	 => 'password does not match ',
				]
			]
		]));
		else {
			$data = [
				'title' => 'Forgot Password',
				'validation' => \Config\Services::validation(),
			];
			return view('auth/forgotPassword', $data);
		}

		// get data input
		$password = $this->request->getVar('password');
		$pin      = $this->request->getVar('pin');

		// required data
		$banned = $this->BannedModel->where(['nim' => $nim])->first();
		$user   = $this->UserModel->where(['nim' => $nim])->first();

		// cek password lama dan pin
		$password = password_verify($password, $user['password']);
		$pin = password_verify($pin, $user['pin']);

		if ($password == false) {
			if ($pin == true) {
				$this->BannedModel->delete([
					'id'		 => $banned['id'],
				]);
				$this->UserModel->save([
					'id'		     => $user['id'],
					'password' 		 => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
				]);
				$data = [
					'title' => 'Login',
					'validation' => \Config\Services::validation()
				];

				session()->setFlashdata('logout', 'Your password has been changed');
				return view('auth/login', $data);
			} else {
				if ($banned['count'] == 0) {
					$data = [
						'title' => 'Login',
						'validation' => \Config\Services::validation()
					];
					session()->setFlashdata('pesan', 'Sorry you have 3 mistakes in entering your PIN number and banned for 1 day ');
					return view('auth/login', $data);
				} else {
					$count = $banned['count'] - 1;
					$this->BannedModel->save([
						'id'		 => $banned['id'],
						'nim' 		 => $nim,
						'time' 		 => time(),
						'count' 	 => $count,
					]);

					$data = [
						'title' 	 => 'Forgot Password',
						'validation' => \Config\Services::validation(),
						'nim' 		 => $nim
					];
					session()->setFlashdata('pesan', 'Please enter your correct PIN!, you have ' . $banned['count'] . ' chance');
					return view('auth/forgotPassword', $data);
				}
			}
		} else {
			$data = [
				'title' 	 => 'Forgot Password',
				'validation' => \Config\Services::validation(),
				'nim' 		 => $nim
			];
			session()->setFlashdata('pesan', 'New password cannot be the same as the old password!');
			return view('auth/forgotPassword', $data);
		}
	}
}

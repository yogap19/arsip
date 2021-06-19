// mencari bruth force coy
// type
// start brute force
// if ($type == 0 && $jurusan == 0 && $acepted == 0) {
// $hasil = $this->BerkasModel->findAll();
// } elseif ($type == 1 && $jurusan == 0 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->find();
// } elseif ($type == 2 && $jurusan == 0 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->find();
// } elseif ($type == 3 && $jurusan == 0 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->find();
// } elseif ($type == 4 && $jurusan == 0 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->find();
// //jurusan
// } elseif ($type == 0 && $jurusan == 1 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['jurusan' => '1'])->find();
// } elseif ($type == 0 && $jurusan == 2 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['jurusan' => '2'])->find();
// } elseif ($type == 0 && $jurusan == 3 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['jurusan' => '3'])->find();
// } elseif ($type == 0 && $jurusan == 4 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['jurusan' => '4'])->find();
// //accepted
// } elseif ($type == 0 && $jurusan == 0 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 0 && $jurusan == 0 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['approved_Sadmin' => '2'])->find();
// // type dan jurusan 1 accepted 0
// } elseif ($type == 1 && $jurusan == 1 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '1'])->find();
// } elseif ($type == 2 && $jurusan == 1 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '1'])->find();
// } elseif ($type == 3 && $jurusan == 1 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '1'])->find();
// } elseif ($type == 4 && $jurusan == 1 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '1'])->find();
// // type dan jurusan 2 accepted 0
// } elseif ($type == 1 && $jurusan == 2 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '2'])->find();
// } elseif ($type == 2 && $jurusan == 2 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '2'])->find();
// } elseif ($type == 3 && $jurusan == 2 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '2'])->find();
// } elseif ($type == 4 && $jurusan == 2 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '2'])->find();
// // type dan jurusan 3 accepted 0
// } elseif ($type == 1 && $jurusan == 3 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '3'])->find();
// } elseif ($type == 2 && $jurusan == 3 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '3'])->find();
// } elseif ($type == 3 && $jurusan == 3 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '3'])->find();
// } elseif ($type == 4 && $jurusan == 3 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '3'])->find();
// // type dan jurusan 4 accepted 0
// } elseif ($type == 1 && $jurusan == 4 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '4'])->find();
// } elseif ($type == 2 && $jurusan == 4 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '4'])->find();
// } elseif ($type == 3 && $jurusan == 4 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '4'])->find();
// } elseif ($type == 4 && $jurusan == 4 && $acepted == 0) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '4'])->find();
// // 1 type dan jurusan 1 accepted 1
// } elseif ($type == 1 && $jurusan == 1 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 1 && $jurusan == 1 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '2'])->find();
// // type 2 dan jurusan 1 accepted 1
// } elseif ($type == 2 && $jurusan == 1 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 2 && $jurusan == 1 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '2'])->find();
// } elseif ($type == 3 && $jurusan == 1 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 3 && $jurusan == 1 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '2'])->find();
// } elseif ($type == 4 && $jurusan == 1 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 4 && $jurusan == 1 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '2'])->find();
// // e2a
// } elseif ($type == 1 && $jurusan == 2 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 1 && $jurusan == 2 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '2'])->find();
// // e3a
// } elseif ($type == 1 && $jurusan == 3 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '3'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 1 && $jurusan == 3 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '3'])->where(['approved_Sadmin' => '2'])->find();
// // e4a
// } elseif ($type == 1 && $jurusan == 4 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '4'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 1 && $jurusan == 4 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '4'])->where(['approved_Sadmin' => '2'])->find();
// // 221
// } elseif ($type == 2 && $jurusan == 2 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 2 && $jurusan == 2 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '2'])->find();
// // 321
// } elseif ($type == 3 && $jurusan == 2 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 3 && $jurusan == 2 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '2'])->find();
// // 421
// } elseif ($type == 4 && $jurusan == 2 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 4 && $jurusan == 2 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '2'])->find();
// // 431
// } elseif ($type == 4 && $jurusan == 3 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '3'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 4 && $jurusan == 3 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '3'])->where(['approved_Sadmin' => '2'])->find();
// // 431
// } elseif ($type == 4 && $jurusan == 4 && $acepted == 1) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '4'])->where(['approved_Sadmin' => '1'])->find();
// } elseif ($type == 4 && $jurusan == 4 && $acepted == 2) {
// $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '4'])->where(['approved_Sadmin' => '2'])->find();
// }
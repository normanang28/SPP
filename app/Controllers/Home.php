<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Pager\Pager;
use CodeIgniter\Pagination\Pagination;

class Home extends BaseController
{
    public function index()
    {
    //     if(session()->get('id')==0 ) {
    //         $num1 = rand(1, 10);
    //         $num2 = rand(1, 10);
    //         echo view('login', ['num1' => $num1, 'num2' => $num2]);
        
    //     }else{
    //         return redirect()->to('/home/dashboard');
    // }

    if(session()->get('level')!= null) {
        $previousURL = previous_url(); // Get the URL of the previous page
        
        if ($previousURL) {
            return redirect()->to($previousURL); // Redirect to the previous page
        }
     
    }else{

        $model=new M_model();
        $where=array('dipakai'=>'Y');
        
        $cekSekolah=$model->getRow('settings_website',$where);
        session()->set('foto_sekolah',$cekSekolah->foto);
        session()->set('text_sekolah',$cekSekolah->text);
        session()->set('login_sekolah',$cekSekolah->login);
        session()->set('nama_website',$cekSekolah->nama_website);

        echo view('spp/login');
        }
    }

    public function aksi_login()
    {
        $n=$this->request->getPost('username'); 
        $p=$this->request->getPost('password');

        // $num1 = $this->request->getPost('num1'); // Get the first number from the form
        // $num2 = $this->request->getPost('num2'); // Get the second number from the form
        // $captchaAnswer = $this->request->getPost('captcha_answer'); // Get captcha answer from the form

        // // Check if the CAPTCHA answer is empty
        // if (empty($captchaAnswer)) {
        //     echo '<script>alert("Please enter the CAPTCHA answer."); window.location.href = "' . base_url('/Home') . '";</script>';
        //     return;
        // }

        // // Verify CAPTCHA answer
        // $correctAnswer = $num1 + $num2;
        // if ($captchaAnswer != $correctAnswer) {
        //     echo '<script>alert("Incorrect CAPTCHA answer. Please try again."); window.location.href = "' . base_url('/Home') . '";</script>';
        //     return;
        // }

        // Verifikasi reCAPTCHA
        $captchaResponse = $this->request->getPost('g-recaptcha-response');
        $captchaSecretKey = '6Le4D6snAAAAAHD3_8OPnw4teaKXWZdefSyXn4H3';

        $verifyCaptchaResponse = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret={$captchaSecretKey}&response={$captchaResponse}"
        );

        $captchaData = json_decode($verifyCaptchaResponse);

        if (!$captchaData->success) {
       
            session()->setFlashdata('error', 'CAPTCHA verification failed. Please try again.');
            return redirect()->to('/Home');
        }

        $model= new M_model();
        $data=array(
            'username'=>$n, 
            'password'=>md5($p)
        );
        $cek=$model->getarray('user', $data);
        if ($cek>0) {
            $where=array('id_user_guru'=>$cek['id_user']);
            $guru=$model->getarray('guru', $where);

            if ($guru) { // Check if it's a teacher
            session()->set('id', $cek['id_user']);
            session()->set('username', $cek['username']);
            session()->set('nama_guru', $guru['nama_guru']);
            session()->set('level', $cek['level']);

            $id = session()->get('id');
            $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Login Pada Sistem Dengan Akun ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
            );
            $model->simpan('log_activity',$data);

            return redirect()->to('/home/dashboard');
        } else {
            $where = array('id_user_siswa' => $cek['id_user']);
            $siswa = $model->getarray('siswa', $where);

            if ($siswa) { // Check if it's a student
                session()->set('id', $cek['id_user']);
                session()->set('username', $cek['username']);
                session()->set('nama_siswa', $siswa['nama_siswa']);
                session()->set('level', $cek['level']);

                $id = session()->get('id');
                $data=array(
                'id_user_log'=>session()->get('id'),
                'aktifitas'=>"Login Pada Sistem Dengan Akun ID ". $id."",
                'waktu'=>date('Y-m-d H:i:s')
                );
                $model->simpan('log_activity',$data);

                return redirect()->to('/home/dashboard');
            }
        }
    }

    return redirect()->to('/');
}

#GANTI PROFILE------------------------------------------------------------------------------------------
public function profile()
{
        if(session()->get('level')== 1 || session()->get('level')== 2 || session()->get('level')== 4) {

        $id=session()->get('id');
        $where2=array('id_user'=>$id);
        $where=array('id_user_guru'=>$id);
        $model=new M_model();
        $pakif['users']=$model->edit_pp('guru',$where);
        $pakif['use']=$model->edit_pp('user',$where2);

        $kui['foto']=$model->getRow('user',$where2);

        $id=session()->get('id');
       
 
        echo view('header',$kui);
        echo view('menu');
        echo view('spp/profile', $pakif);
        echo view('footer');
            }else {
            return redirect()->to('/');
    }
}

public function aksi_change_profile()
    {
        // print_r($this->request->getPost());
        $model= new M_model();
        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $photo=$this->request->getFile('foto');
        $kui=$model->getRow('user',$where);
        if( $photo != '' ){}
            elseif($photo != '' && file_exists(PUBLIC_PATH."/assets/images/profile/".$kui->foto) ) 
            {
            unlink(PUBLIC_PATH."/assets/images/profile/".$kui->foto);
            }
        elseif($photo == '')
        {
            $username= $this->request->getPost('username');
            $nik= $this->request->getPost('nik');                    
            $email_guru= $this->request->getPost('email_guru');                    
            $nama_guru= $this->request->getPost('nama_guru');
            $jk_guru= $this->request->getPost('jk_guru');
            $ttl_guru= $this->request->getPost('ttl_guru');

            $user=array(
                'username'=>$username,
            );
            $model->edit('user', $user,$where);
            $where2=array('id_user_guru'=>$id);

            $guru=array(
                'nik'=>$nik,
                'email_guru'=>$email_guru,
                'nama_guru'=>$nama_guru,
                'jk_guru'=>$jk_guru,
                'ttl_guru'=>$ttl_guru,
            );
            $model->edit('guru', $guru, $where2);

            $guru=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Mengedit Profile ". $nama_guru."",
            'waktu'=>date('Y-m-d H:i:s')
            );
            $model->simpan('log_activity',$guru);

            return redirect()->to('/home/profile');
        }

            $username= $this->request->getPost('username');
            $nik= $this->request->getPost('nik');                    
            $email_guru= $this->request->getPost('email_guru');                    
            $nama_guru= $this->request->getPost('nama_guru');
            $jk_guru= $this->request->getPost('jk_guru');
            $ttl_guru= $this->request->getPost('ttl_guru');

        $img = $photo->getRandomName();
        $photo->move(PUBLIC_PATH.'/assets/images/profile/',$img);
        $user=array(
            'username'=>$username,
            'foto'=>$img
        );
        $model=new M_model();
        $model->edit('user', $user,$where);

        $guru=array(
        'nik'=>$nik,
        'email_guru'=>$email_guru,
        'nama_guru'=>$nama_guru,
        'jk_guru'=>$jk_guru,
        'ttl_guru'=>$ttl_guru,
        );
        $where2=array('id_user_guru'=>$id);
         // print_r($pengguna);
         // print_r($user);
        $model->edit('guru', $guru, $where2);

        $guru=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Mengedit Profile ". $nama_guru."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$guru);

        return redirect()->to('/home/profile');
    }

public function profile_students()
{
        if(session()->get('level')== 3) {

        $id=session()->get('id');
        $where2=array('id_user'=>$id);
        $where=array('id_user_siswa'=>$id);
        $model=new M_model();
        $pakif['users']=$model->edit_pp('siswa',$where);
        $pakif['use']=$model->edit_pp('user',$where2);

        $kui['foto']=$model->getRow('user',$where2);

        $id=session()->get('id');
       
 
        echo view('header',$kui);
        echo view('menu');
        echo view('spp/profile_siswa', $pakif);
        echo view('footer');
            }else {
            return redirect()->to('/');
    }
}

public function aksi_change_profile_students()
    {
        // print_r($this->request->getPost());
        $model= new M_model();
        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $photo=$this->request->getFile('foto');
        $kui=$model->getRow('user',$where);
        if( $photo != '' ){}
            elseif($photo != '' && file_exists(PUBLIC_PATH."/assets/images/profile/".$kui->foto) ) 
            {
            unlink(PUBLIC_PATH."/assets/images/profile/".$kui->foto);
            }
        elseif($photo == '')
        {
            $username= $this->request->getPost('username');
            $nis= $this->request->getPost('nis');                    
            $email_siswa= $this->request->getPost('email_siswa');                    
            $nama_siswa= $this->request->getPost('nama_siswa');
            $jk_siswa= $this->request->getPost('jk_siswa');
            $ttl_siswa= $this->request->getPost('ttl_siswa');

            $user=array(
                'username'=>$username,
            );
            $model->edit('user', $user,$where);
        $where2=array('id_user_siswa'=>$id);

            $siswa=array(
                'nis'=>$nis,
                'email_siswa'=>$email_siswa,
                'nama_siswa'=>$nama_siswa,
                'jk_siswa'=>$jk_siswa,
                'ttl_siswa'=>$ttl_siswa,
            );
            $model->edit('siswa', $siswa, $where2);

            $siswa=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Mengedit Profile ". $nama_siswa."",
            'waktu'=>date('Y-m-d H:i:s')
            );
            $model->simpan('log_activity',$siswa);

            return redirect()->to('/home/profile_students');
        }

            $username= $this->request->getPost('username');
            $nis= $this->request->getPost('nis');                    
            $email_siswa= $this->request->getPost('email_siswa');                    
            $nama_siswa= $this->request->getPost('nama_siswa');
            $jk_siswa= $this->request->getPost('jk_siswa');
            $ttl_siswa= $this->request->getPost('ttl_siswa');

        $img = $photo->getRandomName();
        $photo->move(PUBLIC_PATH.'/assets/images/profile/',$img);
        $user=array(
            'username'=>$username,
            'foto'=>$img
        );
        $model=new M_model();
        $model->edit('user', $user,$where);

        $siswa=array(
        'nis'=>$nis,
        'email_siswa'=>$email_siswa,
        'nama_siswa'=>$nama_siswa,
        'jk_siswa'=>$jk_siswa,
        'ttl_siswa'=>$ttl_siswa,
        );
        $where2=array('id_user_siswa'=>$id);
         // print_r($pengguna);
         // print_r($user);
        $model->edit('siswa', $siswa, $where2);

        $siswa=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Mengedit Profile ". $nama_siswa."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$siswa);

        return redirect()->to('/home/profile_students');
    }

//GANTI PW----------------------------------------------------------------------------------------------
    public function change_pw()  
{
        if(session()->get('level')== 1 || session()->get('level')== 2 || session()->get('level')== 3) {

        $id=session()->get('id');
        $where2=array('id_user'=>$id);
        $model=new M_model();
        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);
        $pakif['use']=$model->getRow('user',$where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        
        echo view('header',$kui);
        echo view('menu',$pakif);
        echo view('spp/change_pw',$pakif);
        echo view('footer');
        }else{
        return redirect()->to('/');
    }
}

    public function aksi_change_pw()   
{
        $pass=$this->request->getPost('pw');
        $id=session()->get('id');
        $model= new M_model();

        $data=array( 
            'password'=>md5($pass)
        );
        
        $where=array('id_user'=>$id);
        $model->edit('user', $data, $where);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Mengganti Password Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/log_out');
}
//LOGOUT------------------------------------------------------------------------------------------------
    // public function log_out()
    // {
    //     if(session()->get('id')>0) {

    //      session()->destroy();
    //      return redirect()->to('/');

    //     $data=array(
    //     'id_user_log'=>session()->get('id'),
    //     'aktifitas'=>"Logout Dari Sistem Dengan Akun ID ". $id."",
    //     'waktu'=>date('Y-m-d H:i:s')
    //     );
    //     $model->simpan('log_activity',$data);

    //     }else{
    //         return redirect()->to('/home/dashboard');
    //     }
    // }

    public function log_out()
{
    if(session()->get('id') > 0) {
        $model = new M_model(); // Pastikan Anda mendefinisikan model di sini atau menggunakan instance yang benar
        $id = session()->get('id');

        $data = array(
            'id_user_log' => $id,
            'aktifitas' => "Logout Dari Sistem Dengan Akun ID " . $id,
            'waktu' => date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity', $data);

        session()->destroy();
        return redirect()->to('/');
    } else {
        return redirect()->to('/home/dashboard');
    }
}


//DASHBOARD---------------------------------------------------------------------------------------------
    public function dashboard()
    {
        if(session()->get('id')>0) {
        
        $model= new M_model();
        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);       

        echo view('header', $kui);
        echo view('menu');
        echo view('spp/dashboard');
        echo view('footer');
        }else{
        return redirect()->to('/');
    }
    }

//USERS---------------------------------------------------------------------------------------------
    public function teacher()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='guru.maker_guru=user.id_user';
        $kui['duar']=$model->fusionOderBy('guru', 'user', $on,  'tanggal_guru');

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        
        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('users/view/guru');
        echo view('footer'); 

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function detail_teacher($id)
{
        if(session()->get('level')== 1){

        $model=new M_model();
        $where2=array('id_user_guru'=>$id); 
        $on='guru.id_user_guru=user.id_user';
        $kui['gas']=$model->detail('guru', 'user',$on, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('users/view/detail_guru');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function add_teacher()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='guru.maker_guru=user.id_user';
        $kui['duar']=$model->fusionOderBy('guru', 'user', $on, 'tanggal_guru');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('users/add/add_guru');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_teacher()
{
    $model=new M_model();
        
    $nik=$this->request->getPost('nik');
    $nama_guru=$this->request->getPost('nama_guru');
    $email_guru=$this->request->getPost('email_guru');
    $jk_guru=$this->request->getPost('jk_guru');
    $ttl_guru=$this->request->getPost('ttl_guru');
    $username=$this->request->getPost('username');
    // $password=$this->request->getPost('password');
    $level=$this->request->getPost('level');
    $maker_guru=session()->get('id');
    
    $user=array(
    'username'=>$username,
    'password'=>md5('@dmin123'),
    'level'=>$level,
    );

    $model=new M_model();
    $model->simpan('user', $user);
    $where=array('username'=>$username);
    $id=$model->getarray('user', $where);
    $iduser = $id['id_user'];

    $guru = array(
    'nik' => $nik,
    'nama_guru' => $nama_guru,
    'email_guru' => $email_guru,
    'jk_guru' => $jk_guru,
    'ttl_guru' => $ttl_guru,
    'id_user_guru' => $iduser,
    'maker_guru' => $maker_guru,
    // 'tanggal_pgu' => date('Y-m-d')
);

    // print_r($guru);
    $model->simpan('guru', $guru);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Menambah Akun Guru ". $nama_guru."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/teacher');
}

    public function reset_p($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('id_user'=>$id);
        $data=array(
            'password'=>md5('@dmin123')
        );
        $model->edit('user',$data,$where);

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Mereset Password Pada Akun Guru Dengan ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/teacher');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function edit_teacher($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where2=array('guru.id_user_guru'=>$id);

        $on='guru.id_user_guru=user.id_user';
        $kui['duar']=$model->edit_user('guru', 'user',$on, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('users/edit/edit_guru');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_edit_teacher()
{
    $id= $this->request->getPost('id');    
    $username= $this->request->getPost('username');
    $level= $this->request->getPost('level');
    $nik= $this->request->getPost('nik');
    $nama_guru= $this->request->getPost('nama_guru');
    $email_guru= $this->request->getPost('email_guru');
    $jk_guru= $this->request->getPost('jk_guru');
    $ttl_guru= $this->request->getPost('ttl_guru');
    $maker_guru=session()->get('id');

    $where=array('id_user'=>$id);    
    $where2=array('id_user_guru'=>$id);
    if ($password !='') {
        $user=array(
            'username'=>$username,
            'level'=>$level,
        );
    }else{
        $user=array(
            'username'=>$username,
            'level'=>$level,
        );
    }
    
    $model=new M_model();
    $model->edit('user', $user,$where);

    $guru=array(
        'nik'=>$nik,
        'nama_guru'=>$nama_guru,
        'email_guru' => $email_guru,
        'jk_guru'=>$jk_guru,
        'ttl_guru'=>$ttl_guru,
        'maker_guru'=>$maker_guru
    );
    // print_r($user);
    // print_r($pengguna);
    $model->edit('guru', $guru, $where2);

    $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Mengedit Akun Guru ". $nama_guru." Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/teacher');
}

    public function delete_teacher($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where2=array('id_user'=>$id);
        $where=array('id_user_guru'=>$id);
        $model->hapus('guru',$where);
        $model->hapus('user',$where2);

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Menghapus Akun Guru Dengan ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/teacher');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function students()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='siswa.maker_siswa=user.id_user';
        $kui['duar']=$model->fusionOderBy('siswa', 'user', $on,  'tanggal_siswa');

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        
        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('users/view/siswa');
        echo view('footer'); 

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function detail_students($id)
{
        if(session()->get('level')== 1){

        $model=new M_model();
        $where2=array('id_user_siswa'=>$id); 
        $on='siswa.id_kelas_siswa=kelas.id_kelas';
        $on2='siswa.id_jurusan_siswa=jurusan.id_jurusan';
        $on3='siswa.id_rombel_siswa=rombel.id_rombel';
        $on4='siswa.id_paket_siswa=paket.id_paket';
        $on5='siswa.id_user_siswa=user.id_user';
        $kui['gas']=$model->detail_siswa('siswa', 'kelas', 'jurusan', 'rombel', 'paket', 'user', $on, $on2, $on3, $on4, $on5, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('users/view/detail_siswa');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function add_students()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='siswa.id_kelas_siswa=kelas.id_kelas';
        $on2='siswa.id_jurusan_siswa=jurusan.id_jurusan';
        $on3='siswa.id_rombel_siswa=rombel.id_rombel';
        $on4='siswa.id_paket_siswa=paket.id_paket';
        $on5='siswa.maker_siswa=user.id_user';
        $kui['duar']=$model->addsiswaOderBy('siswa', 'kelas', 'jurusan', 'rombel', 'paket', 'user', $on, $on2, $on3, $on4, $on5, 'tanggal_siswa');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        $kui['duar']=$model->tampil('kelas'); 
        $kui['j']=$model->tampil('jurusan'); 
        $kui['r']=$model->tampil('rombel'); 
        $kui['p']=$model->tampil('paket'); 

        echo view('header',$kui);
        echo view('menu');
        echo view('users/add/add_siswa');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_students()
{
    $model=new M_model();

    $kelas=$this->request->getPost('id_kelas');
    $jurusan=$this->request->getPost('id_jurusan');
    $rombel=$this->request->getPost('id_rombel');  
    $paket=$this->request->getPost('id_paket');  
    $nis=$this->request->getPost('nis');
    $nama_siswa=$this->request->getPost('nama_siswa');
    $email_siswa=$this->request->getPost('email_siswa');
    $jk_siswa=$this->request->getPost('jk_siswa');
    $ttl_siswa=$this->request->getPost('ttl_siswa');
    $username=$this->request->getPost('username');
    // $password=$this->request->getPost('password');
    $level=$this->request->getPost('level');
    $maker_siswa=session()->get('id');
    
    $user=array(
    'username'=>$username,
    'password'=>md5('@dmin123'),
    'level'=>'3',
    );

    $model=new M_model();
    $model->simpan('user', $user);
    $where=array('username'=>$username);
    $id=$model->getarray('user', $where);
    $iduser = $id['id_user'];

    $siswa = array(
    'id_kelas_siswa'=> $kelas,
    'id_jurusan_siswa'=> $jurusan,
    'id_rombel_siswa'=> $rombel,
    'id_paket_siswa'=> $paket,
    'nis' => $nis,
    'nama_siswa' => $nama_siswa,
    'email_siswa' => $email_siswa,
    'jk_siswa' => $jk_siswa,
    'ttl_siswa' => $ttl_siswa,
    'id_user_siswa' => $iduser,
    'maker_siswa' => $maker_siswa,
    // 'tanggal_pgu' => date('Y-m-d')
);

    // print_r($siswa);
    $model->simpan('siswa', $siswa);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Menambah Akun Siswa ". $nama_siswa."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/students');
}

    public function reset_ps($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('id_user'=>$id);
        $data=array(
            'password'=>md5('@dmin123')
        );
        $model->edit('user',$data,$where);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Mereset Password Pada Akun Siswa Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/students');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function edit_students($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where2=array('siswa.id_user_siswa'=>$id);

        $on='siswa.id_kelas_siswa=kelas.id_kelas';
        $on2='siswa.id_jurusan_siswa=jurusan.id_jurusan';
        $on3='siswa.id_rombel_siswa=rombel.id_rombel';
        $on4='siswa.id_paket_siswa=paket.id_paket';
        $on5='siswa.id_user_siswa=user.id_user';
        $kui['duar']=$model->edit_siswa_siswa('siswa', 'kelas', 'jurusan', 'rombel', 'paket', 'user', $on, $on2, $on3, $on4, $on5, $where2);
        $kui['ok']=$model->tampil('kelas');
        $kui['j']=$model->tampil('jurusan');
        $kui['r']=$model->tampil('rombel');
        $kui['p']=$model->tampil('paket');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('users/edit/edit_siswa');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_edit_students()
{
    $id= $this->request->getPost('id');  
    $kelas= $this->request->getPost('id_kelas');
    $jurusan= $this->request->getPost('id_jurusan');
    $rombel= $this->request->getPost('id_rombel');  
    $paket= $this->request->getPost('id_paket');  
    $username= $this->request->getPost('username');
    $nis= $this->request->getPost('nis');
    $nama_siswa= $this->request->getPost('nama_siswa');
    $email_siswa= $this->request->getPost('email_siswa');
    $jk_siswa= $this->request->getPost('jk_siswa');
    $ttl_siswa= $this->request->getPost('ttl_siswa');
    $maker_siswa=session()->get('id');

    $where=array('id_user'=>$id);    
    $where2=array('id_user_siswa'=>$id);
    if ($password !='') {
        $user=array(
            'username'=>$username,
        );
    }else{
        $user=array(
            'username'=>$username,
        );
    }
    
    $model=new M_model();
    $model->edit('user', $user,$where);

    $siswa=array(
        'id_kelas_siswa'=>$kelas,
        'id_jurusan_siswa'=>$jurusan,
        'id_rombel_siswa'=>$rombel,
        'id_paket_siswa'=>$paket,
        'nis'=>$nis,
        'nama_siswa'=>$nama_siswa,
        'email_siswa' => $email_siswa,
        'jk_siswa'=>$jk_siswa,
        'ttl_siswa'=>$ttl_siswa,
        'maker_siswa'=>$maker_siswa
    );
    // print_r($user);
    // print_r($pengguna);
    $model->edit('siswa', $siswa, $where2);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Mengedit Akun Siswa ". $nama_siswa." Dengan ID ". $id ."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/students');
}

    public function delete_students($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where2=array('id_user'=>$id);
        $where=array('id_user_siswa'=>$id);
        $model->hapus('siswa',$where);
        $model->hapus('user',$where2);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menghapus Akun Siswa Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/students');

        }else{
        return redirect()->to('/home/dashboard');
    }
}
//CLASS------------------------------------------------------------------------------------------------
    public function class()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='kelas.maker_kelas=user.id_user';
        $kui['duar']=$model->fusionOderBy('kelas', 'user', $on, 'tanggal_kelas');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('class_spp/view/kelas');
        echo view ('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

public function add_class()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='kelas.maker_kelas=user.id_user';
        $kui['duar']=$model->fusion('kelas', 'user', $on);

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu',$kui);
        echo view('class_spp/add/add_class',$kui);
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_class()
{
    $model=new M_model();
    $nama_kelas=$this->request->getPost('nama_kelas');
    // $total_siswa=$this->request->getPost('total_siswa');
    $maker_kelas=session()->get('id');
    $data=array(

        'nama_kelas'=>$nama_kelas,
        // 'total_siswa'=>$total_siswa,
        'maker_kelas'=>$maker_kelas
    );
    // print_r($data);
    $model->simpan('kelas',$data);

    $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menambah Data Kelas ". $nama_kelas."",
        'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/class');
}

    public function edit_class($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('kelas.id_kelas'=>$id);

        $on='kelas.maker_kelas=user.id_user';
        $kui['duar']=$model->fusion_Row('kelas', 'user', $on, $where);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('class_spp/edit/edit_class');
        echo view('footer');

    }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_edit_class()
{
    $model=new M_model();
    $id=$this->request->getPost('id');
    $nama_kelas=$this->request->getPost('nama_kelas');
    // $total_siswa=$this->request->getPost('total_siswa');
    $maker_kelas=session()->get('id');
    $data=array(
        'nama_kelas'=>$nama_kelas,
        // 'total_siswa'=>$total_siswa,
        'maker_kelas'=>$maker_kelas
    );
    // print_r($data);
    $where=array('id_kelas'=>$id);
    $model->edit('kelas',$data,$where);

    $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Mengedit Data Kelas ". $nama_kelas." Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/class');
}

    public function delete_class($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('id_kelas'=>$id);
        $model->hapus('kelas',$where);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menghapus Data Kelas Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        // print_r($where);
        return redirect()->to('/home/class');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

//CLASS------------------------------------------------------------------------------------------------
    public function major()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='jurusan.maker_jurusan=user.id_user';
        $kui['duar']=$model->fusionOderBy('jurusan', 'user', $on, 'tanggal_jurusan');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('jurusan_spp/view/jurusan');
        echo view ('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

public function add_major()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='jurusan.maker_jurusan=user.id_user';
        $kui['duar']=$model->fusion('jurusan', 'user', $on);

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu',$kui);
        echo view('jurusan_spp/add/add_jurusan',$kui);
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_major()
{
    $model=new M_model();
    $nama_jurusan=$this->request->getPost('nama_jurusan');
    $jurusan_lengkap=$this->request->getPost('jurusan_lengkap');
    $maker_jurusan=session()->get('id');
    $data=array(

        'nama_jurusan'=>$nama_jurusan,
        'jurusan_lengkap'=>$jurusan_lengkap,
        'maker_jurusan'=>$maker_jurusan
    );
    // print_r($data);
    $model->simpan('jurusan',$data);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Menambah Data Jurusan ". $nama_jurusan."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/major');
}

    public function edit_major($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('jurusan.id_jurusan'=>$id);

        $on='jurusan.maker_jurusan=user.id_user';
        $kui['duar']=$model->fusion_Row('jurusan', 'user', $on, $where);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('jurusan_spp/edit/edit_jurusan');
        echo view('footer');

    }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_edit_major()
{
    $model=new M_model();
    $id=$this->request->getPost('id');
    $nama_jurusan=$this->request->getPost('nama_jurusan');
    $jurusan_lengkap=$this->request->getPost('jurusan_lengkap');
    $maker_jurusan=session()->get('id');
    $data=array(
        'nama_jurusan'=>$nama_jurusan,
        'jurusan_lengkap'=>$jurusan_lengkap,
        'maker_jurusan'=>$maker_jurusan
    );
    // print_r($data);
    $where=array('id_jurusan'=>$id);
    $model->edit('jurusan',$data,$where);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Mengedit Data Jurusan ". $nama_jurusan." Dengan ID ". $id ."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/major');
}

    public function delete_major($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('id_jurusan'=>$id);
        $model->hapus('jurusan',$where);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menghapus Data Jurusan ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        // print_r($where);
        return redirect()->to('/home/major');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

//ROMBEL-----------------------------------------------------------------------------------------------
public function rombel()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='rombel.id_jurusan_rombel=jurusan.id_jurusan';
        $on2='rombel.id_kelas_rombel=kelas.id_kelas';
        $on3='rombel.id_guru_rombel=guru.id_guru';
        $on4='rombel.maker_rombel=user.id_user';
        $kui['duar']=$model->monsterOderBy('rombel', 'jurusan', 'kelas', 'guru', 'user', $on, $on2, $on3, $on4, 'tanggal_rombel');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('rombel_spp/view/rombel');
        echo view ('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

public function add_rombel()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='rombel.id_jurusan_rombel=jurusan.id_jurusan';
        $on2='rombel.id_kelas_rombel=kelas.id_kelas';
        $on3='rombel.id_guru_rombel=guru.id_guru';
        $on4='rombel.maker_rombel=user.id_user';
        $kui['duar']=$model->monsterOderBy('rombel', 'jurusan', 'kelas', 'guru', 'user', $on, $on2, $on3, $on4, 'tanggal_rombel');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        $kui['duar']=$model->tampil('jurusan'); 
        $kui['k']=$model->tampil('kelas'); 
        $kui['g']=$model->tampil('guru'); 

        echo view('header',$kui);
        echo view('menu');
        echo view('rombel_spp/add/add_rombel');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_rombel()
{
    $model=new M_model();
        $jurusan=$this->request->getPost('id_jurusan');
        $kelas=$this->request->getPost('id_kelas');
        $guru=$this->request->getPost('id_guru');
        $nama_rombel=$this->request->getPost('nama_rombel');
        $maker_rombel=session()->get('id');
        
        $data=array(
            'id_jurusan_rombel'=> $jurusan,
            'id_kelas_rombel'=> $kelas,
            'id_guru_rombel'=> $guru,
            'nama_rombel'=>$nama_rombel,
            'maker_rombel'=>$maker_rombel
        );
        // print_r($data);
        $model->simpan('rombel',$data);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menambah Data Rombel ". $nama_rombel."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/rombel');
}

public function edit_rombel($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('rombel.id_rombel'=>$id);

        $on='rombel.id_jurusan_rombel=jurusan.id_jurusan';
        $on2='rombel.id_kelas_rombel=kelas.id_kelas';
        $on3='rombel.id_guru_rombel=guru.id_guru';
        $on4='rombel.maker_rombel=user.id_user';
        $kui['duar']=$model->monsterRows('rombel', 'jurusan', 'kelas', 'guru', 'user', $on, $on2, $on3, $on4, $where);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        $kui['jj']=$model->tampil('jurusan'); 
        $kui['kk']=$model->tampil('kelas'); 
        $kui['gg']=$model->tampil('guru'); 

        echo view('header',$kui);
        echo view('menu');
        echo view('rombel_spp/edit/edit_rombel');
        echo view('footer');

    }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_edit_rombel()
{
    $model=new M_model();
    $id=$this->request->getPost('id');
    $kelas= $this->request->getPost('id_kelas');
    $jurusan= $this->request->getPost('id_jurusan');
    $guru= $this->request->getPost('id_guru');
    $nama_rombel=$this->request->getPost('nama_rombel');
    $maker_rombel=session()->get('id');
    $data=array(
        'id_kelas_rombel'=>$kelas,
        'id_jurusan_rombel'=>$jurusan,
        'id_guru_rombel'=>$guru,
        'nama_rombel'=>$nama_rombel,
        'maker_rombel'=>$maker_rombel
    );
    // print_r($data);
    $where=array('id_rombel'=>$id);
    $model->edit('rombel',$data,$where);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Mengedit Data Rombel ". $nama_rombel." Dengan ID ". $id ."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/rombel');
}

public function delete_rombel($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('id_rombel'=>$id);
        $model->hapus('rombel',$where);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menghapus Data Rombel Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('home/rombel');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

//INVOICE-----------------------------------------------------------------------------------------------
    public function invoice()
{
        if(!session()->get('id') > 0){
            return redirect()->to('/home/dashboard');
        }

        if(session()->get('level')== 2) {

        $model=new M_model();
        $on='spp.id_siswa_spp=siswa.id_siswa';
        $on2='spp.id_paket_spp=paket.id_paket';
        // $on3='spp.maker_spp=user.id_user';
        $kui['duar']=$model->asc_date('spp', 'siswa', 'paket', $on, $on2, 'tgl_spp');
    }

        if(session()->get('level')== 3) {

        $model=new M_model();
        $where=array('nama_siswa'=>session()->get('nama_siswa'));

        // $currentMonth = date('m');

        // $where['MONTH(tgl_spp)'] = $currentMonth;

        $on='spp.id_siswa_spp=siswa.id_siswa';
        $on2='spp.id_paket_spp=paket.id_paket';
        $kui['duar']=$model->sppspp('spp', 'siswa', 'paket', $on, $on2, 'tgl_spp', $where);
    }

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('invoice_spp/view/invoice');
        echo view ('footer');

}

public function invoice_search()
{
        if(!session()->get('id') > 0){
            return redirect()->to('/home/dashboard');
        }

        if(session()->get('level')== 2) {

        $model=new M_model();
        $on='spp.id_siswa_spp=siswa.id_siswa';
        $where=$this->request->getPost('search_invoice');
        $kui['duar']=$model->supersiswa('spp', 'siswa', $on,'spp.deskripsi','spp.tgl_spp', $where);
    }

        if(session()->get('level')== 3) {

        $model=new M_model();
        $where=array('nama_siswa'=>session()->get('nama_siswa'));
        $on='spp.id_siswa_spp=siswa.id_siswa';
        $kui['duar']=$model->search2('spp', 'siswa', $on,  $where);
    }

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $kui['search']="on";

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('invoice_spp/view/invoice');
        echo view ('footer');

}

public function status_invoice()
{
    if (session()->get('level') == 2) {
        $ids = $this->request->getPost('invoice');

        // Check if $ids is an array
        if (is_array($ids)) {
            $model = new M_model();
            $data = array(
                'status' => "Lunas"
            );

            foreach ($ids as $id) {
                $where = array('id_spp' => $id);
                $model->edit('spp', $data, $where);

            $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Status Lunas Dengan ID Siswa ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
            );
            $model->simpan('log_activity',$data);

            }

            return redirect()->to('home/invoice');
        } else {
            return redirect()->to('home/invoice')->with('error', 'Invalid input data');
        }
    } else {
        return redirect()->to('/home/dashboard');
    }
}


public function add_invoice()
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $on='spp.id_siswa_spp=siswa.id_siswa';
        $on2='spp.id_paket_spp=paket.id_paket';
        $kui['duar']=$model->invoice('spp', 'siswa', 'paket', $on, $on2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        $kui['p']=$model->tampil('siswa'); 
        $kui['pp']=$model->tampil('paket'); 

        echo view('header',$kui);
        echo view('menu');
        echo view('invoice_spp/add/add_invoice');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_invoice()
{
    $model=new M_model();
        
        $siswa=$this->request->getPost('id_siswa');
        $paket=$this->request->getPost('id_paket');
        $tgl_spp=$this->request->getPost('tgl_spp');
        $tgl_jatuh_tempo=$this->request->getPost('tgl_jatuh_tempo');
        
        $data=array(
            'id_siswa_spp'=> $siswa,
            'id_paket_spp'=> $paket,
            'tgl_spp'=>$tgl_spp,
            'tgl_jatuh_tempo'=>$tgl_jatuh_tempo,
            'status'=>'<span style="color: red;">Belum Bayar</span>',
        );
        // print_r($data);
        $model->simpan('spp',$data);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menambah Data SPP Dengan ID Siswa ". $siswa."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/invoice');
}

public function add_fine()
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $on='spp.id_siswa_spp=siswa.id_siswa';
        $on2='spp.id_paket_spp=paket.id_paket';
        $kui['duar']=$model->invoice('spp', 'siswa', 'paket', $on, $on2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        $kui['p']=$model->tampil('siswa'); 
        $kui['pp']=$model->tampil('paket'); 

        echo view('header',$kui);
        echo view('menu');
        echo view('invoice_spp/add/add_fine');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_fine()
{
    $model=new M_model();
        
        $siswa=$this->request->getPost('id_siswa');
        $paket=$this->request->getPost('id_paket');
        $tgl_spp=$this->request->getPost('tgl_spp');
        $tgl_jatuh_tempo=$this->request->getPost('tgl_jatuh_tempo');
        
        $data=array(
            'id_siswa_spp'=> $siswa,
            'id_paket_spp'=> $paket,
            'tgl_spp'=>$tgl_spp,
            'tgl_jatuh_tempo'=>$tgl_jatuh_tempo,
            'status'=>'<span style="color: orange;">Denda</span>',
        );
        // print_r($data);
        $model->simpan('spp',$data);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menambah Data Denda Pada ID Siswa ". $siswa."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/invoice');
}

public function edit_invoice($id)
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $where=array('spp.id_spp'=>$id);

        $on='spp.id_siswa_spp=siswa.id_siswa';
        $on2='spp.id_paket_spp=paket.id_paket';
        $on3='spp.maker_spp=user.id_user';
        $kui['duar']=$model->edit_invoice('spp', 'siswa', 'paket', 'user', $on, $on2, $on3, $where);
        
        $kui['ko']=$model->tampil('siswa');
        $kui['pp']=$model->tampil('paket');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('invoice_spp/edit/edit_invoice');
        echo view('footer');

    }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_edit_invoice()
{
    $model=new M_model();
    $id=$this->request->getPost('id');
    $nama=$this->request->getPost('id_siswa');
    $paket=$this->request->getPost('id_paket');
    $tgl_spp=$this->request->getPost('tgl_spp');
    $tgl_jatuh_tempo=$this->request->getPost('tgl_jatuh_tempo');
    $maker_spp=session()->get('id');
    $data=array(
        'id_siswa_spp'=>$nama,
        'id_paket_spp'=>$paket,
        'tgl_spp'=>$tgl_spp,
        'tgl_jatuh_tempo'=>$tgl_jatuh_tempo,
        'maker_spp'=>$maker_spp
    );
    // print_r($data);
    $where=array('id_spp'=>$id);
    $model->edit('spp',$data,$where);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Mengedit Data SPP Dengan ID Siswa ". $nama."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/invoice');
}

    public function delete_invoice($id)
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $where=array('id_spp'=>$id);
        $model->hapus('spp',$where);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menghapus Data SPP Dengan ID Siswa ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        // print_r($where);
        return redirect()->to('/home/invoice');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

//EMPLOYEE SALARY--------------------------------------------------------------------------------------------------------
public function employee_salary()
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $on='gaji_karyawan.id_guru_gaji=guru.id_guru';
        $on2='gaji_karyawan.maker_gaji=user.id_user';
        $kui['duar']=$model->superOderBy('gaji_karyawan', 'guru', 'user', $on, $on2, 'tgl_tgl');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('employee_salary_spp/view/employee_salary');
        echo view ('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

public function employee_salary_search()
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $on='gaji_karyawan.id_guru_gaji=guru.id_guru';
        $on2='gaji_karyawan.maker_gaji=user.id_user';
        $where=$this->request->getPost('search_employee_salary');
        $kui['duar']=$model->superLike2('gaji_karyawan', 'guru', 'user', $on, $on2,'gaji_karyawan.deskripsi_gaji','gaji_karyawan.tanggal_gaji', $where);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);
        $kui['search']="on";

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('employee_salary_spp/view/employee_salary');
        echo view ('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

public function status_employee_salary()
{
    if (session()->get('level') == 2) {
        $ids = $this->request->getPost('employee_salary');

        // Check if $ids is an array
        if (is_array($ids)) {
            $model = new M_model();
            $data = array(
                'status_gaji' => "Lunas"
            );

            foreach ($ids as $id) {
                $where = array('id_gaji' => $id);
                $model->edit('gaji_karyawan', $data, $where);

                $data=array(
                'id_user_log'=>session()->get('id'),
                'aktifitas'=>"Status Gaji Karyawan Lunas Dengan ID ". $id."",
                'waktu'=>date('Y-m-d H:i:s')
                );
                $model->simpan('log_activity',$data);
            }

            return redirect()->to('home/employee_salary');
        } else {
            return redirect()->to('home/employee_salary')->with('error', 'Invalid input data');
        }
    } else {
        return redirect()->to('/home/dashboard');
    }
}


public function add_employee_salary()
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $on='gaji_karyawan.id_guru_gaji=guru.id_guru';
        $on2='gaji_karyawan.maker_gaji=user.id_user';
        $kui['duar']=$model->super('gaji_karyawan', 'guru', 'user', $on, $on2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        $kui['p']=$model->tampil('guru'); 

        echo view('header',$kui);
        echo view('menu');
        echo view ('employee_salary_spp/add/add_employee_salary');
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_employee_salary()
{
    $model=new M_model();
        
        $guru=$this->request->getPost('id_guru');
        // $deskripsi_gaji=$this->request->getPost('deskripsi_gaji');
        $tanggal_gaji=$this->request->getPost('tanggal_gaji');
        $jumlah_gaji=$this->request->getPost('jumlah_gaji');
        $maker_gaji=session()->get('id');
        
        $data=array(
            'id_guru_gaji'=> $guru,
            'deskripsi_gaji'=>'Gaji',
            'tanggal_gaji'=>$tanggal_gaji,
            'jumlah_gaji'=>$jumlah_gaji,
            'status_gaji'=>'<span style="color: red;">Proses</span>',
            'maker_gaji'=>$maker_gaji
        );
        // print_r($data);
        $model->simpan('gaji_karyawan',$data);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menambah Data Gaji Karyawan Dengan ID ". $guru."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/employee_salary');
}

public function edit_employee_salary($id)
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $where=array('gaji_karyawan.id_gaji'=>$id);

        $on='gaji_karyawan.id_guru_gaji=guru.id_guru';
        $on2='gaji_karyawan.maker_gaji=user.id_user';
        $kui['duar']=$model->superRows('gaji_karyawan', 'guru', 'user', $on, $on2, $where);
        
        $kui['ko']=$model->tampil('guru');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view ('employee_salary_spp/edit/edit_employee_salary');
        echo view('footer');

    }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_edit_employee_salary()
{
    $model=new M_model();
    $id=$this->request->getPost('id');
    $guru=$this->request->getPost('id_guru');
    // $deskripsi_gaji=$this->request->getPost('deskripsi_gaji');
    $tanggal_gaji=$this->request->getPost('tanggal_gaji');
    $jumlah_gaji=$this->request->getPost('jumlah_gaji');
    $maker_gaji=session()->get('id');
    $data=array(
        'id_guru_gaji'=>$guru,
        // 'deskripsi_gaji'=>$deskripsi_gaji,
        'tanggal_gaji'=>$tanggal_gaji,
        'jumlah_gaji'=>$jumlah_gaji,
        'maker_gaji'=>$maker_gaji
    );
    // print_r($data);
    $where=array('id_gaji'=>$id);
    $model->edit('gaji_karyawan',$data,$where);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Mengedit Data Gaji Karyawan Dengan ID ". $guru."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/employee_salary');
}

    public function delete_employee_salary($id)
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $where=array('id_gaji'=>$id);
        $model->hapus('gaji_karyawan',$where);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menghapus Data Gaji Karyawan Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);
        // print_r($where);
        return redirect()->to('/home/employee_salary');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

//BAYAR SPP INVOICE-------------------------------------------------------------------------------------------------------
 public function add_bayar_invoice($id)
{
        if(session()->get('level')== 3) {

        $model=new M_model();
        $where=array('spp.id_spp'=>$id);
        $where2=array('id_spp'=>$id); 

        $on='spp.id_siswa_spp=siswa.id_siswa';
        $on2='spp.id_paket_spp=paket.id_paket';
        $kui['gas']=$model->spp_test('spp', 'siswa', 'paket', $on, $on2, $where, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header', $kui);
        echo view('menu');
        echo view('invoice_spp/bayar/add_bayar_invoice');
        echo view('footer');

    }else{
        return redirect()->to('/home/dashboard');
    }
}

public function aksi_add_bayar_invoice()
{
    $model = new M_model();
    $id = $this->request->getPost('id');
    $metode_pembayaran = $this->request->getPost('metode_pembayaran');
    $id_user = session()->get('id');

    $data = array(
        'metode_pembayaran' => $metode_pembayaran,
        'status'=>"Proses",
        // 'id_siswa_spp' => $id_user
    );
    
    $where = array('id_spp' => $id);
// print_r($where);
    try {
        $foto = $this->request->getFile('foto_bukti');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(ROOTPATH . '/public/bukti/', $newName);
            $data['foto_bukti'] = $newName; // Add the uploaded file name to the data
        }

        $model->edit('spp', $data, $where);
        
        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Membayar SPP Dengan ID " . $id ."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        return redirect()->to('/home/invoice');
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


public function add_bayar_invoice_a($id)
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $where=array('spp.id_spp'=>$id);
        $where2=array('id_spp'=>$id); 

        $on='spp.id_siswa_spp=siswa.id_siswa';
        $on2='spp.id_paket_spp=paket.id_paket';
        $kui['gas']=$model->spp_test('spp', 'siswa', 'paket', $on, $on2, $where, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header', $kui);
        echo view('menu');
        echo view('invoice_spp/bayar/add_bayar_invoice_a');
        echo view('footer');

    }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_bayar_invoice_a()
{
    $model = new M_model();
    $id = $this->request->getPost('id');
    $metode_pembayaran = $this->request->getPost('metode_pembayaran');
    $id_user = session()->get('id');

    $data = array(
        'metode_pembayaran' => $metode_pembayaran,
        'status'=>'Proses',
        // 'id_user' => $id_user
    );
    print_r($data);
    $where = array('id_spp' => $id);
    $model->edit('spp', $data, $where);
    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Membayar SPP Dengan ID " . $id ."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/invoice');
}

//SETTINGS WEBSITE------------------------------------------------------------------------------------------------------
   public function settings_control()
{
        if(session()->get('level')== 1) {

        $id=session()->get('id');
        $where=array('id_settings'=> 2);
        $model=new M_model();
        $pakif['use']=$model->getRow('settings_website',$where);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);
       
        echo view('header', $kui);
        echo view('menu');
        echo view('settings', $pakif);
        echo view('footer');
        }else {
        return redirect()->to('/');
    }
}

//    public function aksi_change_website_settings()
// {
//     $model = new M_model();
//     $id = $this->request->getPost('id');
//     $where = array('id_settings' => $id);
//     $photo = $this->request->getFile('foto');
//     $text = $this->request->getFile('text'); 
//     $login = $this->request->getFile('login'); 

//     $kui = $model->getRow('settings_website', $where);

//     $logo = array();

//     if ($photo && $photo->isValid()) {
//         // Proses file foto
//         $img = $photo->getRandomName();
//         $photo->move(PUBLIC_PATH . '/assets/images/settings_web/', $img);
//         $logo['foto'] = $img;
//     }

//     if ($text && $text->isValid()) {
//         // Proses file teks
//         $textFileName = $text->getRandomName();
//         $text->move(PUBLIC_PATH . '/assets/images/settings_web/', $textFileName);
//         $logo['text'] = $textFileName;
//     }

//     if ($login && $login->isValid()) {
//         // Proses file login
//         $loginFileName = $login->getRandomName();
//         $login->move(PUBLIC_PATH . '/assets/images/settings_web/', $loginFileName);
//         $logo['login'] = $loginFileName;
//     }

//     // Sekarang, kita periksa apakah $logo memiliki data
//     if (!empty($logo)) {
//         $nama_website = $this->request->getPost('nama_website');
//         $logo['nama_website'] = $nama_website;

//         // print_r($logo);

//         $model->edit('settings_website', $logo, $where);
//     }

//     // Redirect atau tampilkan pesan berhasil sesuai kebutuhan Anda
//     return redirect()->to('/home/log_out');
// }

public function aksi_change_website_settings()
{
    $model = new M_model();
    $id = $this->request->getPost('id');
    $where = array('id_settings' => $id);
    
    $logo = array();

    $photo = $this->request->getFile('foto');
    $text = $this->request->getFile('text'); 
    $login = $this->request->getFile('login'); 

    if ($photo && $photo->isValid()) {
        // Proses file foto
        $img = $photo->getRandomName();
        $photo->move(PUBLIC_PATH . '/assets/images/settings_web/', $img);
        $logo['foto'] = $img;
    }

    if ($text && $text->isValid()) {
        // Proses file teks
        $textFileName = $text->getRandomName();
        $text->move(PUBLIC_PATH . '/assets/images/settings_web/', $textFileName);
        $logo['text'] = $textFileName;
    }

    if ($login && $login->isValid()) {
        // Proses file login
        $loginFileName = $login->getRandomName();
        $login->move(PUBLIC_PATH . '/assets/images/settings_web/', $loginFileName);
        $logo['login'] = $loginFileName;
    }

    // Hanya update nama_website jika ada perubahan
    $nama_website = $this->request->getPost('nama_website');
    if (!empty($nama_website)) {
        $logo['nama_website'] = $nama_website;
    }

    // Sekarang, kita periksa apakah $logo memiliki data
    if (!empty($logo)) {
        $model->edit('settings_website', $logo, $where);
    }

    $logo=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Mengedit Website ". $nama_website."",
        'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$logo);

    // Redirect atau tampilkan pesan berhasil sesuai kebutuhan Anda
    return redirect()->to('/home/log_out');
}


//LOG ACTIFITY-----------------------------------------------------------------------------------------------------------
public function log_activity()
{
        if(session()->get('level')== 1 || session()->get('level')== 2 || session()->get('level')== 3 || session()->get('level')== 4) {

        $model=new M_model();
        $where=array('log_activity.id_user_log'=>session()->get('id'));
        $on='log_activity.id_user_log=user.id_user';
        $kui['duar'] = $model->log('log_activity', 'user', $on, $where, 'waktu');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('log_activity/view/log');
        echo view ('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

//SPP REPORT-------------------------------------------------------------------------------------------------------------
public function spp_report()
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $kui['kunci']='view_spp';

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu',$kui);
        echo view('laporan/filter',$kui);
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}
    public function cari_invoice()
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $kui['duar']=$model->filter_invoice('spp',$awal,$akhir);
        // $img = file_get_contents(
        //     'C:\xampp\htdocs\laporan_keuangan\public\assets\images\KOP_PH.jpg');

        // $kui['foto'] = base64_encode($img);
        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menampilkan Laporan SPP Dalam Format Print",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        echo view('laporan/c_invoice',$kui);

        }else{
        return redirect()->to('/home/dashboard');
    }
}
    public function pdf_invoice()
{
        if(session()->get('level')== 2) {

        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $kui['duar']=$model->filter_invoice('spp',$awal,$akhir);
        // $img = file_get_contents(
        //     'C:\xampp\htdocs\laporan_keuangan\public\assets\images\KOP_PH.jpg');

        // $kui['foto'] = base64_encode($img);
        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menampilkan Laporan SPP Dalam Format PDF",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $dompdf = new\Dompdf\Dompdf();
        $dompdf->loadHtml(view('laporan/c_invoice',$kui));
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream('my.pdf', array('Attachment'=>0));

        }else{
        return redirect()->to('/home/dashboard');
    }
}
    public function excel_invoice()
{
    if(session()->get('level')== 2) {

    $model=new M_model();
    $awal= $this->request->getPost('awal');
    $akhir= $this->request->getPost('akhir');
    $data=$model->filter_invoice('spp',$awal,$akhir);

    $spreadsheet=new Spreadsheet();

    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Invoice No.')
    ->setCellValue('B1', 'Student Name')
    ->setCellValue('C1', 'Description')
    // ->setCellValue('D1', 'Due Date')
    ->setCellValue('D1', 'Amount')
    ->setCellValue('E1', 'Status')
    ->setCellValue('F1', 'Total SPP Payment');

    $total = 0;

    $column=2;

    foreach($data as $data){
    if ($data->status == "Lunas") {

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A'. $column, $data->id_siswa_spp . '/' . $data->maker_spp . '/' . $data->id_spp)
        ->setCellValue('B'. $column, $data->nama_siswa)
        ->setCellValue('C'. $column, $data->nama_paket . '/' . $data->tgl_spp)
        // ->setCellValue('D'. $column, $data->tgl_jatuh_tempo)
        ->setCellValue('D'. $column, $data->harga_paket)
        ->setCellValue('E'. $column, $data->status)
        ->setCellValue('F'. $column, $total += $data->harga_paket);

        // $total += $data->jumlah_gaji;

        $column++;
    }}
    $writer = new XLsx($spreadsheet);
    $fileName = 'Invoice Report - SPP';

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Menampilkan Laporan SPP Dalam Format Excel",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition:attachment;filename='.$fileName.'.xls');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    }else{
        return redirect()->to('/home/dashboard');
    }
}

//EMPLOYEE SALARY REPORT--------------------------------------------------------------------------------------------------
public function employee_salary_report()
{
        if(session()->get('level')== 2 || session()->get('level')== 4) {

        $model=new M_model();
        $kui['kunci']='view_employee_salary';

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu',$kui);
        echo view('laporan/filter',$kui);
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}
    public function cari_employee_salary()
{
        if(session()->get('level')== 2 || session()->get('level')== 4) {

        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $kui['duar']=$model->filter_employee_salary('gaji_karyawan',$awal,$akhir);
        // $img = file_get_contents(
        //     'C:\xampp\htdocs\laporan_keuangan\public\assets\images\KOP_PH.jpg');

        // $kui['foto'] = base64_encode($img);
        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menampilkan Laporan Gaji Karyawan Dalam Format Print",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        echo view('laporan/c_employee_salary',$kui);

        }else{
        return redirect()->to('/home/dashboard');
    }
}
    public function pdf_employee_salary()
{
        if(session()->get('level')== 2 || session()->get('level')== 4) {

        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $kui['duar']=$model->filter_employee_salary('gaji_karyawan',$awal,$akhir);
        // $img = file_get_contents(
        //     'C:\xampp\htdocs\laporan_keuangan\public\assets\images\KOP_PH.jpg');

        // $kui['foto'] = base64_encode($img);
        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menampilkan Laporan Gaji Karyawan Dalam Format PDF",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $dompdf = new\Dompdf\Dompdf();
        $dompdf->loadHtml(view('laporan/c_employee_salary',$kui));
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream('my.pdf', array('Attachment'=>0));

        }else{
        return redirect()->to('/home/dashboard');
    }
}
//     public function excel_employee_salary()
// {
//     if(session()->get('level')== 2 || session()->get('level')== 4) {

//     $model=new M_model();
//     $awal= $this->request->getPost('awal');
//     $akhir= $this->request->getPost('akhir');
//     $data=$model->filter_employee_salary('gaji_karyawan',$awal,$akhir);

//     $spreadsheet=new Spreadsheet();

//     $spreadsheet->setActiveSheetIndex(0)
//     ->setCellValue('A1', 'Employee Name')
//     ->setCellValue('B1', 'Description')
//     ->setCellValue('C1', 'Amount')
//     ->setCellValue('D1', 'Total Employee Salary');

//     $total = 0;

//     $column=2;

//     foreach($data as $data){
//     if ($data->status_gaji == "Lunas") {
//         $spreadsheet->setActiveSheetIndex(0)
//         ->setCellValue('A'. $column, $data->nama_guru)
//         ->setCellValue('B'. $column, $data->deskripsi_gaji . ' ' . $data->tanggal_gaji)
//         ->setCellValue('C'. $column, $data->jumlah_gaji)
//         ->setCellValue('D'. $column, $total += $data->jumlah_gaji);

//         // $total += $data->jumlah_gaji;

//         $column++;
//     }}
//     $writer = new XLsx($spreadsheet);
//     $fileName = 'Employee Salary Report - SPP';

//     header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//     header('Content-Disposition:attachment;filename='.$fileName.'.xls');
//     header('Cache-Control: max-age=0');

//     $writer->save('php://output');
//     }else{
//         return redirect()->to('/home/dashboard');
//     }
// }

public function excel_employee_salary()
{
    $model = new M_model();
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $data = $model->filter_employee_salary('gaji_karyawan', $awal, $akhir);

    $spreadsheet = new Spreadsheet();

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Employee Name')
        ->setCellValue('B1', 'Description')
        ->setCellValue('C1', 'Amount')
        ->setCellValue('D1', 'Total Employee Salary');

    $total = 0;

    $column = 2;

    $level = session()->get('level');

    foreach ($data as $data) {
        if ($data->status_gaji == "Lunas" && ($level == 4 ? $data->nama_guru == session()->get('nama_guru') : true)) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data->nama_guru)
                ->setCellValue('B' . $column, $data->deskripsi_gaji . ' ' . $data->tanggal_gaji)
                ->setCellValue('C' . $column, $data->jumlah_gaji)
                ->setCellValue('D' . $column, $total += $data->jumlah_gaji);

            $column++;
        }
    }

    $writer = new Xlsx($spreadsheet);
    $fileName = 'Employee Salary Report - SPP';
    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Menampilkan Laporan Gaji Karyawan Dalam Format Excel",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename=' . $fileName . '.xlsx');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

//DOWNLOAD BUKTI----------------------------------------------------------------------------------------------------------
public function download($file_name)
    {
        // Assuming your uploaded files are stored in the "uploads" directory
        $file_path = FCPATH . 'bukti/' . $file_name;
        // $file_name = 'rz.png'; // This is the name of the file to be downloaded

        if (file_exists($file_path)) {
            // Set appropriate headers

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Length: ' . filesize($file_path));

            // Send the file to the browser
            readfile($file_path);
            exit;
        } else {
            // File not found
            die('File not found.');
    }
}

//PAKET-------------------------------------------------------------------------------------------------------------------
    public function packet()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='paket.maker_paket=user.id_user';
        $kui['duar']=$model->fusionOderBy('paket', 'user', $on, 'tanggal_paket');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view ('header', $kui);
        echo view ('menu');
        echo view ('packet_spp/view/packet');
        echo view ('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

public function add_packet()
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $on='paket.maker_paket=user.id_user';
        $kui['duar']=$model->fusion('paket', 'user', $on);

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu',$kui);
        echo view('packet_spp/add/add_packet',$kui);
        echo view('footer');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_add_packet()
{
    $model=new M_model();
    $nama_paket=$this->request->getPost('nama_paket');
    $harga_paket=$this->request->getPost('harga_paket');
    $maker_paket=session()->get('id');
    $data=array(

        'nama_paket'=>$nama_paket,
        'harga_paket'=>$harga_paket,
        'maker_paket'=>$maker_paket
    );
    // print_r($data);
    $model->simpan('paket',$data);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Menambah Data Paket ". $nama_paket."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);

    return redirect()->to('/home/packet');
}

    public function edit_packet($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('paket.id_paket'=>$id);

        $on='paket.maker_paket=user.id_user';
        $kui['duar']=$model->fusion_Row('paket', 'user', $on, $where);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('packet_spp/edit/edit_packet');
        echo view('footer');

    }else{
        return redirect()->to('/home/dashboard');
    }
}

    public function aksi_edit_packet()
{
    $model=new M_model();
    $id=$this->request->getPost('id');
    $nama_paket=$this->request->getPost('nama_paket');
    $harga_paket=$this->request->getPost('harga_paket');
    $maker_paket=session()->get('id');
    $data=array(
        'nama_paket'=>$nama_paket,
        'harga_paket'=>$harga_paket,
        'maker_paket'=>$maker_paket
    );
    // print_r($data);
    $where=array('id_paket'=>$id);
    $model->edit('paket',$data,$where);

    $data=array(
    'id_user_log'=>session()->get('id'),
    'aktifitas'=>"Mengedit Data Paket ". $nama_paket." Dengan ID ". $id ."",
    'waktu'=>date('Y-m-d H:i:s')
    );
    $model->simpan('log_activity',$data);


    return redirect()->to('/home/packet');
}

    public function delete_packet($id)
{
        if(session()->get('level')== 1) {

        $model=new M_model();
        $where=array('id_paket'=>$id);
        $model->hapus('paket',$where);

        $data=array(
        'id_user_log'=>session()->get('id'),
        'aktifitas'=>"Menghapus Data Paket Dengan ID ". $id."",
        'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        // print_r($where);
        return redirect()->to('/home/packet');

        }else{
        return redirect()->to('/home/dashboard');
    }
}

}

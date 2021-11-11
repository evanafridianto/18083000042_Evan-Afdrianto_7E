<?php 
$setTemplate=false; 
$url = 'register';
if(isset($_POST['register']))
{
        $validation=array();      
        $form = $_POST['nama']&&$_POST['username']&&$_POST['kata_sandi']&&$_POST['konfirmasi_kata_sandi'];
        $password = $_POST["kata_sandi"];
        $konfirmasi_password = $_POST["konfirmasi_kata_sandi"];
    
        // cek username apakah sudah ada
        if($_POST['id_pengguna']=!""){
            $db->where('id_pengguna !='.$_POST['id_pengguna']);
        }
            $db->where('username',$_POST['username']);
            $db->get('pengguna');
        if($db->count>0){
            $validation[]='Username Sudah Ada!';
        }
        if(!empty(strlen($password)<8)&&$password = $konfirmasi_password){
            $validation[]='Input Password minimal 8 karakter!';
            
        }
        if(empty($form)){
            $validation[]='Input Tidak Boleh Kosong!';
            
        }if ($password != $konfirmasi_password) {
            $validation[]='Password tidak cocok!';
        }

        //cek validasi
        if(!empty($validation)){
            $setTemplate=false;
            $session->set('error_validation',$validation);
            $session->set('error_value',$_POST);
            redirect($_SERVER['HTTP_REFERER']);
            return false;
                    
        }else{
            $data['nama'] =  $_POST['nama'];
            $data['username'] =  $_POST['username'];
            $data['level'] =   $_POST['level'];
            $data['kata_sandi']= password_hash($_POST["kata_sandi"], PASSWORD_DEFAULT);

            $exec = $db->insert('pengguna', $data);
            if ($exec) {
            $session->set("info",'<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>SUKSES!</strong> Berhasil membuat akun, Login Sekarang!</div>');
            }else{
            $session->set("info",'<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>GAGAL!</strong> Gagal membuat akun,coba lagi!</div>');
            }
        }
        redirect(url("login"));
        
}
    
    
    if($session->get('error_value')){
    extract($session->pull('error_value'));
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title>Form Register </title>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=templates()?>assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?=templates()?>assets/favicon.ico">
    <meta name="theme-color" content="#3063A0">
    <!-- BEGIN BASE STYLES -->
    <link rel="stylesheet" href="<?=templates()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=templates()?>assets/vendor/font-awesome/css/fontawesome-all.min.css">
    <!-- END BASE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="<?=templates()?>assets/stylesheets/main.min.css">
    <link rel="stylesheet" href="<?=templates()?>assets/stylesheets/custom.css">
    <!-- END THEME STYLES -->
</head>

<body>
    <!-- .auth -->
    <main class="auth">
        <header id="auth-header" class="auth-header"
            style="background-image: url(<?=templates()?>assets/images/illustration/img-1.png);">
            <h1>
                <img src="<?=templates()?>assets/images/brand-inverse.png" alt="" height="72">
                <span class="sr-only">Sign Up</span>
            </h1>
            <p> Already have an account? please
                <a href="<?=url('login');?>">Login</a>
            </p>
        </header>
        <!-- form -->
        <form class="auth-form" method="post">
            <?php
            // menampilkan error validasi
                if($session->get('error_validation')){
                    foreach ($session->pull('error_validation') as $key) {
                        echo ' <span style="color:red">
                        <span class="oi oi-warning pulse mr-1"></span>'.$key.'</span>';
                    }
                }
                ?>
            <!-- .form-group -->
            <input type="hidden" id="inputId" class="form-control" name="id_pengguna" autofocus="">

            <div class="form-group">
                <!-- <?=$session->pull("info")?> -->
                <div class="form-label-group">
                    <input type="text" id="inputNama" class="form-control" name="nama" placeholder="Nama" autofocus="">
                    <label for="inputEmail">Masukan Nama</label>
                </div>
            </div>
            <!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="inputLevel" class="form-control" name="username" placeholder="Username">
                    <label for="inputUser">Masukan Username</label>
                </div>
            </div>
            <!-- /.form-group -->
            <!-- .form-group -->
            <input type="hidden" id="inputLevel" class="form-control" value="User" name="level">
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" name="kata_sandi"
                        placeholder="Password">
                    <label for="inputPassword">Password</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" id="inputKonfirmasiPassword" class="form-control"
                        name="konfirmasi_kata_sandi" placeholder="Konfirmasi Password">
                    <label for="inputKonfirmasiPassword">Konfirmasi Password</label>
                </div>
            </div>
            <!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Register</button>
            </div>
            <!-- /.form-group -->

        </form>
        <!-- /.auth-form -->
        <!-- copyright -->
        <footer class="auth-footer"> <strong>Copyright &copy; <?php echo date('Y') . " " ?>. UTS Evan
                Afdrianto</strong>. All
            rights reserved
        </footer>
    </main>
    <!-- /.auth -->
    <!-- BEGIN PLUGINS JS -->
    <?php
  include '_layouts/javascript.php';
?>
</body>

</html>
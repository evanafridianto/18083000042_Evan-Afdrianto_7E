<?php
	$setTemplate=false;
	if(isset($_POST['login'])){
    $username=$_POST['username'];

    $kata_sandi=$_POST['kata_sandi'];
    $db->where("username",$username);


    $data=$db->ObjectBuilder()->getOne("pengguna");


    if($db->count>0){
      // jika username ada
      $hash = $data->kata_sandi; 
      if (password_verify($kata_sandi, $hash)) {
          $session->set("logged",true);
          $session->set("username",$data->username);
          $session->set("id_pengguna",$data->id_pengguna);
          $session->set("level",$data->level);
          $session->set("info",'<h3 class="font-weight-bold">Hi, '.$data->nama.'</h3>
          <h5 class="d-block text-muted">Selamat datang dihalaman Beranda!</h5>');
          redirect(url("beranda"));
      } else {
         $session->set("logged",false);
         $session->set("info",'<div class="alert alert-danger alert-dismissible fade show">
         <button type="button" class="close" data-dismiss="alert">×</button>
         <strong>Error!</strong> Username atau Password salah!</div>');
        redirect(url("login"));
      }
    }
    else{
      $session->set("logged",false);
      $session->set("info",'<div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Error!</strong> Username atau Password salah!</div>');
      redirect(url("login"));
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Form Login</title>
    <!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=templates()?>assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?=templates()?>assets/favicon.ico">
    <meta name="theme-color" content="#3063A0">
    <!-- BEGIN BASE STYLES -->
    <link rel="stylesheet" href="<?=templates()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=templates()?>assets/stylesheets/main.min.css">
    <link rel="stylesheet" href="<?=templates()?>assets/stylesheets/custom.css">
</head>

<body>
    <!-- .auth -->
    <main class="auth">
        <header id="auth-header" class="auth-header"
            style="background-image: url(<?=templates()?>assets/images/illustration/img-1.png);">
            <a href="<?=url('front')?>">
                <h1>
                    <img src="<?=templates()?>assets/images/brand-inverse.png" alt="" height="72">
                </h1>
            </a>
            <p> Don't have a account?
                <a href="<?= url('register') ?>">Create One</a>
            </p>
        </header>
        <!-- form -->

        <form class="auth-form" method="post">
            <!-- .form-group -->
            <div class="form-group">
                <?=$session->pull("info")?>
                <div class="form-label-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required=""
                        autofocus="">
                    <label for="inputUser">Username</label>
                </div>
            </div>
            <!-- /.form-group -->
            <!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" name="kata_sandi" class="form-control" placeholder="Password" required="">
                    <label for="inputPassword">Password</label>
                </div>
            </div>
            <!-- .form-group -->
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>
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
    <script src="<?=templates()?>assets/vendor/particles.js/particles.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-116692175-1');
    </script>
</body>

</html>
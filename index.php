<?php
include '_loader.php';

$setTemplate=true;

if (isset($_GET['halaman'])) {
  $halaman = $_GET['halaman'];
  
}else{
  $halaman = 'front';
}
ob_start();
$file = '_halaman/' . $halaman . '.php';
if (!file_exists($file)) {
  include '_halaman/error.php';
} else {
  include $file;
}
$content = ob_get_contents();
ob_end_clean();

if($setTemplate==true){
  
  if($session->get("logged")!==true){
    redirect(url('login'));
  }

?>


<!DOCTYPE html>
<html lang="en">

<?php include '_layouts/head.php' ?>

<body>
    <!-- .app -->
    <div class="app">
        <?php include '_layouts/header.php';?>
        <!-- /.app-header -->
        <!-- .app-aside -->
        <aside class="app-aside">
            <!-- .aside-content -->
            <div class="aside-content">
                <?php  include '_layouts/sidebar.php';  ?>
            </div>
            <!-- /.aside-content -->
        </aside>
        <?php echo $content ?>
        <!-- BEGIN BASE JS -->
        <?php include '_layouts/javascript.php' ?>
        <?php include '_layouts/footer.php' ?>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <!-- .modal-dialog -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <!-- .modal-content -->
                <div class="modal-content">
                    <!-- .modal-header -->
                    <div class="modal-header">
                    </div>
                    <div class="modal-title text-center">
                        <h5>Anda Yakin Ingin Keluar?</h5>
                    </div>

                    <!-- .modal-footer -->
                    <div class="modal-footer ">
                        <a class="btn btn-primary" href="<?=url('logout')?>">Keluar</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                    <!-- /.modal-footer -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
</body>

</html>

<?php }else{
  echo $content;

}
  if(isset($fileJs)){
    include '_halaman/js/'.$fileJs.'.php';
    
}
?>
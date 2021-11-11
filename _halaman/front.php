<?php
$setTemplate=false;
$title = "Peta Kota Malang";
$judul = $title;
$url = 'front'; 
$fileJs ='petaJs'

?>

<!DOCTYPE html>
<html lang="en">
<?php include '_layouts/head.php' ?>

<body>
    <!-- .app -->
    <div class="app has-fullwidth">
        <!-- .app-header -->
        <header class="app-header">
            <!-- .top-bar -->
            <div class="top-bar">
                <!-- .top-bar-brand -->
                <div class="top-bar-brand">
                    <a href="<?=url($url)?>">
                        <img src="<?=templates()?>assets/images/brand-inverse.png" height="32" alt="">
                    </a>
                </div>
                <!-- /.top-bar-brand -->
                <!-- .top-bar-list -->
                <div class="top-bar-list">
                    <div class="top-bar-item top-bar-item-full">
                        <h3><?= $title; ?></h3>
                    </div>
                </div>
                <!-- /.top-bar-list -->
                <div class="dropdown">
                    <a class="btn-account d-none d-md-flex" type="button" href="<?=url('login')?>">
                        <span>LOGIN</span>
                    </a>
                </div>
            </div>
            <!-- /.top-bar -->
        </header>
        <main class="app-main">
            <div class="card-body">
                <div id="map">
                </div>
            </div>
        </main>
        <?php include '_layouts/footer.php' ?>
    </div>
    <?php include '_layouts/javascript.php' ?>
</body>

</html>
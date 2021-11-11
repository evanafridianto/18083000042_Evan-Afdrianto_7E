<?php
$title = "Peta Kota Malang";
$judul = $title;
$url = 'peta'; 
$fileJs ='petaJs';

if ($session->get('level')!='Admin'&&$session->get('level')!='User'){
    redirect(url('beranda'));
}

?>
<?= content_open($title) ?>
<div class="card card-fluid">
    <div class="card-body" id="map">
    </div>
</div>
<?= content_close() ?>
<?php
$title = "Beranda";
$judul = $title; 
// $setTemplate=false;
?>
<?= content_open('Beranda') ?>
<header class="page-title-bar">
    <?=$session->pull("info")?>
</header>
<!-- /.page-section -->
<?= content_close() ?>
<?php
$setTemplate=false;
$session->destroy('_Petamalang', true);

$session->set("info",'<div class="alert alert-success alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>SUKSES!</strong> Berhasil Logout, Silahkan Login kembali!</div>');
redirect(url('login'));
?>
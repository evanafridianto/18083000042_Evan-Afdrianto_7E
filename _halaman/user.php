<?php
$title = "Data User";
$judul = $title;
$url = 'user';
if ($session->get('level')!='Admin'){
    redirect(url('beranda'));
}
if (isset($_POST['simpan'])) {
    $validation=array();
    $form = $_POST['nama']&&$_POST['username']&&$_POST['level']&&$_POST['kata_sandi']&&$_POST['konfirmasi_kata_sandi'];
    
    $password = $_POST["kata_sandi"];
    $konfirmasi_password = $_POST["konfirmasi_kata_sandi"];

    $cekpassword=$db->ObjectBuilder()->getOne("pengguna");
    $input_kata_sandi = $_POST["kata_sandi_lama"];
    $kata_sandi_lama = $cekpassword->kata_sandi; 

    // cek username apakah sudah ada
    if($_POST['id_pengguna']!=""){
        $db->where('id_pengguna !='.$_POST['id_pengguna']);
        if (password_verify($input_kata_sandi, $kata_sandi_lama)==false && !empty($form)) {
            $validation[]='Password Lama tidak cocok!';
        }
        if (empty($_POST['kata_sandi_lama'])) {
            $validation[]='Input Tidak Boleh Kosong!';
        }
    
    }
        $db->where('username',$_POST['username']);
        $db->get('pengguna');
    if($db->count>0){
        $validation[]='Username Sudah Ada';
    }

    // password min 8
    if(!empty(strlen($password)<8)&&$password = $konfirmasi_password){
        $validation[]='Input Password minimal 8 karakter!';
    }
    // konfirmasi_kata_sandi 
    if ($password != $konfirmasi_password) {
        $validation[]='Password tidak cocok';
    }
            // Input tidak boleh kosong
            if(empty($form)){
                $validation[]='Input Tidak Boleh Kosong!';
            }
        
    //cek validasi
    if(!empty($validation)){
        $setTemplate=false;
        $session->set('error_validation',$validation);
        $session->set('error_value',$_POST);
        redirect($_SERVER['HTTP_REFERER']);
        return false;
    }elseif ($_POST['id_pengguna'] == "") {
        $data['nama']= $_POST['nama']; 
        $data['username']= $_POST['username']; 
        $data['level']= $_POST['level']; 
        $data['kata_sandi']= password_hash($_POST["kata_sandi"], PASSWORD_DEFAULT);
                
        $exec=$db->insert('pengguna', $data);
        $info= '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">×</button> <strong>SUKSES!</strong> Data berhasil ditambah</div>';
    }else{

     
        $data['nama']= $_POST['nama']; 
        $data['username']= $_POST['username']; 
        $data['level']= $_POST['level']; 
        $data['kata_sandi']= password_hash($_POST["kata_sandi"], PASSWORD_DEFAULT);
        
        // update
        $db->where('id_pengguna', $_POST['id_pengguna']);
        $exec=$db->update("pengguna", $data);
        $info= '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">×</button> <strong>SUKSES!</strong> Data berhasil diubah</div>';
    }
    if($exec){
        $session->set('info',$info);
    }else{
        $session->set('info','<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">×</button> <strong>GAGAL!</strong> Proses gagal</div>');
    }
    redirect(url($url));
            

}

    if (isset($_GET['hapus'])) {
        $setTemplate=false;
        $db->where("id_pengguna",$_GET['id']);
        $exec=$db->delete('pengguna');
        $info= '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">×</button> <strong>SUKSES!</strong> Data berhasil dihapus
        </div>';

        if($exec){
            $session->set('info',$info);
        }
        else{
            $session->set("info",' <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button> <strong>GAGAL!</strong> Data Gagal dihapus
            </div>');
        }
        redirect(url($url));
    }

    elseif (isset($_GET['tambah']) OR isset($_GET['ubah'])) {
        $id_pengguna =""; 
        $nama =""; 
        $nama_kecamatan =""; 
        $username =""; 
        $level =""; 
        $kata_sandi =""; 
       
        if (isset($_GET['ubah']) AND isset($_GET['id'])) {
            $id = $_GET['id'];
            $db->where('id_pengguna', $id);
            $row = $db->ObjectBuilder()->getOne('pengguna');
            if ($db->count > 0) {
                $id_pengguna = $row->id_pengguna;
                $nama = $row->nama;
                $nama_kecamatan = $row->nama_kecamatan;
                $username = $row->username;
                $level = $row->level;
                $kata_sandi = $row->kata_sandi;
               
            }
        }
        
        if($session->get('error_value')){
            extract($session->pull('error_value'));
        }
    ?>


<?php if($id_pengguna=="" || $id_pengguna==null){
            $label = 'Form Tambah Data';

        }else{
            $label = 'Form Edit Data';

        } 
?>

<?= content_open($label) ?>
<div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-auto">
    <div class="card-body card mb-4">

        <form method="POST" enctype="multipart/form-data">
            <?php
            // menampilkan error validasi
                if($session->get('error_validation')){
                    foreach ($session->pull('error_validation') as $key) {
                        echo ' <span style="color:red">
                        <span class="fa fa-exclamation-circle fa-fw pulse mr-1"></span>'.$key.'</span>';
                    }
                }
                ?>
            <?= input_hidden('id_pengguna', $id_pengguna) ?>
            <div class="form-group">
                <?=label('Nama')?>
                <div class=" mb-2">
                    <?= input_text('nama', $nama)?>
                </div>
            </div>
            <div class="form-group">
                <?=label('Username')?>
                <div class="mb-2">
                    <?= input_text('username', $username) ?>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Level</label>
                <div class="custom-control custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input" name="level" id="user" value="User"
                        <?= $level=="User" ? "checked":""?>>
                    <label class="custom-control-label" for="user">User</label>
                </div>
                <div class="custom-control custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input" name="level" id="admin" value="Admin"
                        <?= $level=="Admin" ? "checked":""?>>
                    <label class="custom-control-label" for="admin">Admin</label>
                </div>
            </div>
            <?php if ($id_pengguna!==""): ?>
            <div class="form-group">
                <?=label('Passoword Lama')?>
                <div class="mb-2">
                    <input type="text" name="kata_sandi_lama" class="form-control" placeholder="Masukan password lama">
                </div>
            </div>
            <?php endif ?>

            <div class="form-group">
                <?php if ($id_pengguna==""): ?>
                <?=label('Passoword')?>
                <?php else: ?>
                <?=label('Password Baru')?>
                <?php endif ?>
                <div class="mb-2">
                    <input type="password" name="kata_sandi" class="form-control" placeholder="Masukan password">
                </div>
            </div>
            <div class="form-group">
                <?=label('Konfirmasi Password')?>
                <div class="mb-2">
                    <input type="password" name="konfirmasi_kata_sandi" class="form-control"
                        placeholder="Konfirmasi password ">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="<?= url($url) ?>" class="btn btn-danger">Batal</a>
            </div>

        </form>
    </div>
</div>
<script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#konfirmasi_kata_sandi');

togglePassword.addEventListener('click', function(e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bi-eye');
});
</script>
<?= content_close() ?>

<?php } else { ?>
<?= content_open('Data User') ?>
<a type="button" class="btn btn-primary" href="<?= url($url . '&tambah') ?>">Tambah Data</a>
<br><br>
<?=$session->pull("info")?>
<!-- .card -->
<div class="card card-fluid">
    <div class="card-body">
        <!-- .table -->
        <table id="tabel_data" class="table">
            <!-- thead -->
            <thead>
                <tr>
                    <th> No.</th>
                    <th> Nama</th>
                    <th> Username </th>
                    <th> Level </th>
                    <th> Password </th>
                    <th> Aksi</th>
                </tr>
            </thead><!-- /thead -->
            <tbody>
                <?php
                $no = 1;
                $getdata = $db->ObjectBuilder()->get("pengguna");
                foreach ($getdata as $key) {
                $hash = $key->kata_sandi; 

                     ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $key->nama ?></td>
                    <td><?= $key->username ?></td>
                    <td><?= $key->level ?></td>
                    <td><?= $key->kata_sandi?></td>
                    <td>
                        <a href="<?= url($url . '&ubah&id=' . $key->id_pengguna) ?>"
                            class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i> <span
                                class="sr-only">Edit</span></a> <a href="#" class="btn btn-sm btn-icon btn-secondary"
                            data-toggle="modal" data-target="#hapus"><i class="far fa-trash-alt"></i> <span
                                class="sr-only">Remove</span></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table><!-- /.table -->
    </div><!-- /.card-body -->
</div><!-- /.card -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel"
    aria-hidden="true">
    <!-- .modal-dialog -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <!-- .modal-content -->
        <div class="modal-content">
            <!-- .modal-header -->
            <div class="modal-header">
            </div>
            <div class="modal-title text-center">
                <h5>Anda Yakin Ingin Hapus?</h5>
            </div>

            <!-- .modal-footer -->
            <div class="modal-footer ">
                <a class="btn btn-primary" href="<?= url($url . '&hapus&id=' . $key->id_pengguna) ?>">Hapus</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
            <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
$(document).ready(function() {
    var table = $('#tabel_data').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n        <'table-responsive'tr>\n        <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
        language: {
            paginate: {
                previous: '<i class="fa fa-lg fa-angle-left"></i>',
                next: '<i class="fa fa-lg fa-angle-right"></i>'
            }
        },
        responsive: true,

    });
})
</script>

<?= content_close() ?>
<?php } ?>
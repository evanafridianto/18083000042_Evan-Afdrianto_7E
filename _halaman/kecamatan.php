<?php
$title = "Data Kecamatan";
$judul = $title;
$url = 'kecamatan';
if ($session->get('level')!='Admin'){
    redirect(url('beranda'));
}
if (isset($_POST['simpan'])) {
    $validation=array();
     // hapus file di dalam folder
     $db->where('id_kecamatan',$_GET['id']);
     $get=$db->ObjectBuilder()->getOne('m_kecamatan');
     $geojson_kecamatan=$get->geojson_kecamatan;
        unlink('assets/upload/geojson/'.$geojson_kecamatan);
     // end hapus file di dalam folder
     
    // cek kode apakah sudah ada
    if($_POST['id_kecamatan']!=""){
        $db->where('id_kecamatan !='.$_POST['id_kecamatan']);
    }
        $db->where('kode_kecamatan',$_POST['kode_kecamatan']);
        $db->get('m_kecamatan');
    if($db->count>0){
        $validation[]='Kode Kecamatan Sudah Ada';
    }
        $extensions     = ['geojson'];
        $nama           = $_FILES['geojson_kecamatan']['name'];
        $file_tmp       = $_FILES['geojson_kecamatan']['tmp_name'];
        $file_size      = $_FILES['geojson_kecamatan']['size']; 
        $file_ext	    = strtolower(end(explode('.', $nama)));
        
            if (in_array($file_ext, $extensions)===true) {
                $namafile = $_POST['nama_kecamatan'].rand(1,100).'_'.date("d.m.y");
                $lokasi = 'assets/upload/geojson/'.$namafile.'.'.$file_ext;
                move_uploaded_file($file_tmp, $lokasi);// pindah ke folder
                if ($_POST['id_kecamatan'] == "") {
                $data['geojson_kecamatan']=$namafile.'.'.$file_ext;
                $data['kode_kecamatan']= $_POST['kode_kecamatan']; 
                $data['nama_kecamatan']= $_POST['nama_kecamatan']; 
                $data['deskripsi_kecamatan']= $_POST['deskripsi_kecamatan']; 
                $data['id_status_idm']= $_POST['id_status_idm']; 
                $data['sarana_pendidikan']= $_POST['sarana_pendidikan']; 
                $data['lembaga_pendidikan']= implode(",", $_POST['lembaga_pendidikan']);
                $data['warna_kecamatan']= $_POST['warna_kecamatan'];
            
                $exec=$db->insert('m_kecamatan', $data);
                    $info= '<div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button> <strong>SUKSES!</strong> Data berhasil ditambah
                    </div>';
                }else{
                $data['geojson_kecamatan']=$namafile.'.'.$file_ext;
                $data['kode_kecamatan']= $_POST['kode_kecamatan'];
                $data['nama_kecamatan']= $_POST['nama_kecamatan'];
                $data['deskripsi_kecamatan']= $_POST['deskripsi_kecamatan'];
                $data['id_status_idm']= $_POST['id_status_idm'];
                $data['sarana_pendidikan']= $_POST['sarana_pendidikan'];
                $data['lembaga_pendidikan']= implode(",", $_POST['lembaga_pendidikan']);
                $data['warna_kecamatan']= $_POST['warna_kecamatan'];
                // update
                $db->where('id_kecamatan', $_POST['id_kecamatan']);
                $exec=$db->update("m_kecamatan", $data);
                
               
                $info= '<div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button> <strong>SUKSES!</strong> Data berhasil diubah
                </div>';
                }
                if($exec){
                    $session->set('info',$info);
                }else{
                    $session->set('info','<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button> <strong>GAGAL!</strong> Proses gagal
                    </div>');
                }
                redirect(url($url));
            }
             //input tidak boleh kosong
            $form = $_POST['geojson_kecamatan']['size']&&$_POST['kode_kecamatan']&&$_POST['nama_kecamatan']&&$_POST['deskripsi_kecamatan']&&$_POST['id_status_idm']&&$_POST['sarana_pendidikan']&&$_POST['lembaga_pendidikan'];
            if(empty($form&&$file_size)){
                $validation[]='Input Tidak Boleh Kosong!';
            }
               
            if(!empty($file_size)&& !in_array($file_ext, $extensions)){
                $validation[]='Ekstensi GeoJSON Tidak Didukung!';
            }
            //cek validasi
            if(!empty($validation)){
                $setTemplate=false;
                $session->set('error_validation',$validation);
                $session->set('error_value',$_POST);
                redirect($_SERVER['HTTP_REFERER']);
                return false;
                        
            }
    }

    if (isset($_GET['hapus'])) {
        $setTemplate=false;
        // hapus file di dalam folder
        $db->where('id_kecamatan', $_GET['id']);
        $get=$db->ObjectBuilder()->getOne('m_kecamatan');
        $geojson_kecamatan=$get->geojson_kecamatan;
        unlink('assets/upload/geojson/'.$geojson_kecamatan);
        // end hapus file di dalam folder
        $db->where("id_kecamatan",$_GET['id']);
        $exec=$db->delete('m_kecamatan');
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
        $id_kecamatan =""; 
        $kode_kecamatan =""; 
        $nama_kecamatan =""; 
        $deskripsi_kecamatan =""; 
        $id_status_idm =""; 
        $sarana_pendidikan =""; 
        $lembaga_pendidikan =""; 
        $geojson_kecamatan =""; 
        $warna_kecamatan =""; 
        if (isset($_GET['ubah']) AND isset($_GET['id'])) {
            $id = $_GET['id'];
            $db->where('id_kecamatan', $id);
            $row = $db->ObjectBuilder()->getOne('m_kecamatan');
            $checkbox = $row->lembaga_pendidikan;
            if ($db->count > 0) {
                $id_kecamatan = $row->id_kecamatan;
                $kode_kecamatan = $row->kode_kecamatan;
                $nama_kecamatan = $row->nama_kecamatan;
                $deskripsi_kecamatan = $row->deskripsi_kecamatan;
                $id_status_idm = $row->id_status_idm;
                $sarana_pendidikan = $row->sarana_pendidikan;
                $lembaga_pendidikan = explode(',', $checkbox);
                $geojson_kecamatan = $row->geojson_kecamatan;
                $warna_kecamatan = $row->warna_kecamatan;
            }
        }
        
        if($session->get('error_value')){
            extract($session->pull('error_value'));
        }
    ?>


<?php if($id_kecamatan=="" || $id_kecamatan==null){
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
                        <span class="oi oi-warning pulse mr-1"></span>'.$key.'</span>';
                    }
                }
                ?>
            <?= input_hidden('id_kecamatan', $id_kecamatan) ?>
            <div class="form-group">
                <?=label('Kode Kecamatan')?>
                <div class=" mb-2">
                    <?= input_text('kode_kecamatan', $kode_kecamatan)?>
                </div>
            </div>
            <div class="form-group">
                <?=label('Nama Kecamatan')?>
                <div class="mb-2">
                    <?= input_text('nama_kecamatan', $nama_kecamatan) ?>
                </div>
            </div>
            <div class="form-group">
                <?=label('Deskripsi')?>
                <div class="mb-2">
                    <?= textarea('deskripsi_kecamatan', $deskripsi_kecamatan) ?>
                </div>
            </div>
            <div class="form-group">
                <?=label('Status IDM')?>
                <div class="mb-2">

                    <!-- <?=select('id_status_idm') ?> -->
                    <select class="custom-select" id="id_status_idm" name="id_status_idm">
                        <option value="">-- Pilih Status IDM --</option>
                        <?php
                        $status_idm = $db->ObjectBuilder()->get("status_idm"); ?>
                        <?php foreach ($status_idm as $idm) { ?>
                        <option <?= $id_status_idm == $idm->id_status_idm ? "selected" : "" ?>
                            value="<?= $idm->id_status_idm ?>"><?= $idm->kategori_idm ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Jangkauan Sarana Pendidikan</label>
                <div class="custom-control custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input" name="sarana_pendidikan" id="mudah1" value="Mudah"
                        <?= $sarana_pendidikan=="Mudah" ? "checked":""?>>
                    <label class="custom-control-label" for="mudah1">Mudah</label>
                </div>
                <div class="custom-control custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input" name="sarana_pendidikan" id="sulit1" value="Sulit"
                        <?= $sarana_pendidikan=="Sulit" ? "checked":""?>>
                    <label class="custom-control-label" for="sulit1">Sulit</label>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Ketersedian Lembaga Pendidikan</label>
                <div class="custom-control custom-control-inline custom-checkbox">
                    <?php
                    if(empty($id_kecamatan)): ?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="tk" value="TK">
                    <?php else:?>
                    <input type="checkbox" class="custom-control-input" name='lembaga_pendidikan[]' id="tk" value="TK"
                        <?php if (in_array("TK",$lembaga_pendidikan)) echo "checked";?>>
                    <?php endif;?>
                    <label class="custom-control-label" for="tk">TK/PAUD</label>
                </div>
                <div class="custom-control custom-control-inline custom-checkbox">
                    <?php if(empty($id_kecamatan)):?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="sd" value="SD">
                    <?php else:?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="sd" value="SD"
                        <?php if(in_array("SD",$lembaga_pendidikan)) echo "checked";?>>
                    <?php endif;?>
                    <label class="custom-control-label" for="sd">SD</label>
                </div>
                <div class="custom-control custom-control-inline custom-checkbox">
                    <?php if(empty($id_kecamatan)):?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="smp"
                        value="SMP">
                    <?php else:?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="smp" value="SMP"
                        <?php if(in_array("SMP",$lembaga_pendidikan)) echo "checked";?>>
                    <?php endif;?>
                    <label class="custom-control-label" for="smp">SMP</label>
                </div>
                <div class="custom-control custom-control-inline custom-checkbox">
                    <?php if(empty($id_kecamatan)):?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="sma"
                        value="SMA">
                    <?php else:?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="sma" value="SMA"
                        <?php if(in_array("SMA",$lembaga_pendidikan)) echo "checked";?>>
                    <?php endif;?>
                    <label class="custom-control-label" for="sma">SMA</label>
                </div>
                <div class="custom-control custom-control-inline custom-checkbox">
                    <?php if(empty($id_kecamatan)):?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="pt" value="PT">
                    <?php else:?>
                    <input type="checkbox" class="custom-control-input" name="lembaga_pendidikan[]" id="pt" value="PT"
                        <?php if(in_array("PT",$lembaga_pendidikan)) echo "checked";?>>
                    <?php endif;?>
                    <label class="custom-control-label" for="pt">Perguruan Tinggi</label>
                </div>
            </div>
            <?= $geojson_kecamatan; ?>
            <br>
            <?=label('GeoJSON')?>
            <!-- <?=input_file('geojson_kecamatan',$geojson_kecamatan) ?> -->
            <?php if(empty($id_kecamatan)):?>
            <input type="file" class="form-control" name="geojson_kecamatan" value="">
            <?php else:?>
            <input type="file" class="form-control" name="geojson_kecamatan" value="<?= $geojson_kecamatan?>">
            <?php endif;?>
            <?=label('Warna')?>
            <div class=" mb-2">
                <?= input_color('warna_kecamatan', $warna_kecamatan) ?>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="<?= url($url) ?>" class="btn btn-danger">Batal</a>
            </div>

        </form>
    </div>
</div>
<?= content_close() ?>

<?php } else { ?>
<?= content_open('Data Kecamatan') ?>
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
                    <th> Kode</th>
                    <th> Kecamatan </th>
                    <th> Deskripsi </th>
                    <th> Status IDM </th>
                    <th> J. Sarana Pend.</th>
                    <th> Lembaga Pend.</th>
                    <th> GeoJSON</th>
                    <th> Warna</th>
                    <th> Aksi</th>
                </tr>
            </thead><!-- /thead -->
            <tbody>
                <?php
                $no = 1;
                $db->join("status_idm", "m_kecamatan.id_status_idm=status_idm.id_status_idm","LEFT");
                $getdata = $db->ObjectBuilder()->get("m_kecamatan");
                foreach ($getdata as $key) {
                     ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $key->kode_kecamatan ?></td>
                    <td><?= $key->nama_kecamatan ?></td>
                    <td><?= substr($key->deskripsi_kecamatan,0,20)?><?="..." ?></td>
                    <td><?= $key->kategori_idm ?></td>
                    <td><?= $key->sarana_pendidikan ?></td>
                    <td><?= $key->lembaga_pendidikan ?></td>
                    <td><a href="<?=assets('upload/geojson/'.$key->geojson_kecamatan)?>"
                            target="_BLANK"><?=$key->geojson_kecamatan?></a></td>
                    <td style="background: <?=$key->warna_kecamatan?>"></td>

                    <td>
                        <a href="<?= url($url . '&ubah&id=' . $key->id_kecamatan) ?>"
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
                <a class="btn btn-primary" href="<?= url($url . '&hapus&id=' . $key->id_kecamatan) ?>">Hapus</a>
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
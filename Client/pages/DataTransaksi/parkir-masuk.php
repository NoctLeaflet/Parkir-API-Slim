<?php
$urlParkir = $_HOST . "/parkir/";
$urlJK = $_HOST . "/jk/search/";

$tempatParkir = GetDataAPIByURLAndParam($urlParkir . "search/?statusparkir=true", null);
$jenisKendaraan = GetDataAPIByURLAndParam($urlJK, null);

if(isset($_POST["platnomor"]))
{
    $insertData = [
        "IdTempatParkir" => $_POST["tp"],
        "IdJenisKendaraan" => $_POST["jk"],
        "PlatNomor" => $_POST["platnomor"],
        "JamMasuk" => date("Y-m-d H:i:s"),
        "StatusParkir" => true
    ];
    AddDataAPIByURL($urlParkir, $insertData, "parkir");
    $_POST = array();
}


?>

<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Parkir Masuk</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Parkir Masuk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Parkir</li>
            <li class="breadcrumb-item active" aria-current="page">Data Transaksi</li>
        </ol>
    </nav>
</div>
<!-- /////////////////////////////////////// End Breadcrumb ////////////////////////////////////////////// -->

<!-- /////////////////////////////////////// Card ////////////////////////////////////////////// -->
<div class="row">
    <div class="col-sm-12">
        <!-- /////////////////////////////////////// Card Body ////////////////////////////////////////////// -->
        <div class="card card-body">
            <!-- Tables -->
            <div class="row">
                <div class="col-sm-12">
                    <form role="form" method="POST">
                        <div class="form-group">
                            <label>Kode Polisi :</label>
                            <input type="text" class="form-control" name="platnomor" required/>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kendaraan  :</label>
                            <select class="js-example-basic-single form-control" id="jk" name="jk">
                            <option value="null" disabled selected>-- Pilih Jenis Kendaraan --</option>
                            <?php if(isset($jenisKendaraan)) : ?>
                                <?php foreach($jenisKendaraan->data as $jk) :?>
                                    <option value="<?=$jk->idJenisKendaraan?>"><?=$jk->Nama?></option>
                                <?php endforeach;?>
                            <?php endif;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tempat Parkir  :</label>
                            <select class="js-example-basic-single form-control" id="tp" name="tp">
                            <option value="null" disabled selected>-- Pilih Tempat Parkir --</option>
                            <?php if(isset($tempatParkir)) : ?>
                                <?php foreach($tempatParkir->data as $tempat) :?>
                                    <?php if(!isset($tempat->PlatNomor)) : ?>
                                        <option value="<?=$tempat->idTempatParkir?>"><?=$tempat->Posisi?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                            <a class="btn btn-warning" href="index.php?page=parkir">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /////////////////////////////////////// Card Body ////////////////////////////////////////////// -->
    </div>
</div>
<!-- /////////////////////////////////////// End Card ////////////////////////////////////////////// -->

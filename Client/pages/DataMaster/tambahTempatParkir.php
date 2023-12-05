<?php
$url = $_HOST . "/tp/";
$urlJK = $_HOST . "/jk/search/";

$jenisKendaraan = GetDataAPIByURLAndParam($urlJK, null);

if(isset($_POST["Posisi"]))
{
    $insertData = [
        "Posisi" => $_POST["Posisi"]
            , "IdJenisKendaraan" => $_POST["jk"]
            , "CreateDate" => date("Y-m-d H:i:s")
            , "ModifyDate" => date("Y-m-d H:i:s")
    ];
    AddDataAPIByURL($url, $insertData, "tempatParkir");
}


?>

<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Tambah Tempat Parkir </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Tempat Parkir</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Master</li>
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
                            <label>Posisi :</label>
                            <input type="text" class="form-control" name="Posisi" required/>
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
					        <input type="submit" class="btn btn-success" value="Simpan">
					        <a class="btn btn-warning" href="index.php?page=tempatParkir">Batal</a>
				        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /////////////////////////////////////// Card Body ////////////////////////////////////////////// -->
    </div>
</div>
<!-- /////////////////////////////////////// End Card ////////////////////////////////////////////// -->

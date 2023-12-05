<?php
$url = $_HOST . "/jk/";

if(isset($_POST["Nama"]))
{
    $insertData = [
        "Nama" => $_POST["Nama"]
            , "Tarif" => $_POST["Tarif"]
            , "CreateDate" => date("Y-m-d H:i:s")
            , "ModifyDate" => date("Y-m-d H:i:s")
    ];
    AddDataAPIByURL($url, $insertData, "jenisKendaraan");
}

?>

<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Tambah Jenis Kendaraan </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Jenis Kendaraan</a></li>
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
                            <label>Nama :</label>
                            <input type="text" class="form-control" name="Nama" required/>
                        </div>
                        <div class="form-group">
                            <label>Tarif :</label>
                            <input type="number" class="form-control" name="Tarif" required/>
                        </div>
                        <div class="form-group">
					        <input type="submit" class="btn btn-success" value="Simpan">
					        <a class="btn btn-warning" href="index.php?page=jenisKendaraan">Batal</a>
				        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /////////////////////////////////////// Card Body ////////////////////////////////////////////// -->
    </div>
</div>
<!-- /////////////////////////////////////// End Card ////////////////////////////////////////////// -->

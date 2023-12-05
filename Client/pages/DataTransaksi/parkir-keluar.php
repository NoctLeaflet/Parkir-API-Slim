<?php
$url = $_HOST . "/parkir/";

if(isset($_POST["platnomor"]))
{
    //get data parkir
    $filter = [
        "filter" => $_POST["platnomor"]
        , "filterby" => "PlatNomor"
    ];
    $tempatParkir = GetDataAPIByURLAndParam($url . "search/?filterby=PlatNomor&filter=" . $_POST["platnomor"], null);

    //get tarif
    $tarif = GetDataAPIByURLAndParam($_HOST . "/jk/search/?filterby=idJenisKendaraan&filter=" . $tempatParkir->data[0]->idJenisKendaraan, null);

    $dataInsert = [
        "idParkir" => $tempatParkir->data[0]->idParkir,
        "JamMasuk" =>  $tempatParkir->data[0]->JamMasuk,
        "JamKeluar" =>  date("Y-m-d H:i:s"),
        "Tarif" => $tarif->data[0]->Tarif,
        "StatusParkir" =>  false
    ];

    EditDataAPIByURL($url . $_POST["platnomor"], $dataInsert, "parkir");
}

?>

<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Parkir Keluar </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Parkir</a></li>
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
                            <label>Nomor Polisi :</label>
                            <input type="text" class="form-control" name="platnomor" id="platnomor" required/>
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

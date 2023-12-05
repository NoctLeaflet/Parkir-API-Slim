<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Dashboard </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
        </ol>
    </nav>
</div>
<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->

<!-- /////////////////////////////////////// Informasi Mobil ////////////////////////////////////////////// -->
<?php
$urljs = $_HOST . "/jk/search/";
$url = $_HOST . "/dashboard/count/p/";
$urlPK = $_HOST . "/dashboard/count/pkeluar/";
$urlJK = $_HOST . "/dashboard/count/jk/";
$urlUser = $_HOST . "/dashboard/count/u/";
$urlJKM = $_HOST . "/dashboard/count/jkm/";

$jk = GetDataAPIByURLAndParam($urljs, null);
$dataParkirMasuk = GetDataAPIByURLAndParam($url, null);
$dataParkirKeluar = GetDataAPIByURLAndParam($urlPK, null);
$dataJenisKendaraan = GetDataAPIByURLAndParam($urlJK, null);
$dataUser = GetDataAPIByURLAndParam($urlUser, null);
$dataMM = GetDataAPIByURLAndParam($urlJKM, null);

//avg parkir
if($dataMM->data[0]->cntMotor != 0 && $dataMM->data[0]->cntMobil != 0)
{
    $avgMotor = $dataMM->data[0]->cntMotor / ($dataMM->data[0]->cntMotor + $dataMM->data[0]->cntMobil) * 100;
    $avgMobil = $dataMM->data[0]->cntMobil / ($dataMM->data[0]->cntMotor + $dataMM->data[0]->cntMobil) * 100;
}
else
{
    $avgMotor = 0;
    $avgMobil = 0;
}
?>
<div class="row">
    <div class="col-sm-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Parkir Masuk</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h3 class="mb-0"><?= $dataParkirMasuk->data[0]->jumlah_baris_histori ?></h3>
                        </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-car text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Parkir Keluar</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h3 class="mb-0"><?= $dataParkirKeluar->data[0]->jumlah_baris_histori ?></h3>
                        </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-car-connected text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Jenis Kendaraan</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h3 class="mb-0"><?= $dataJenisKendaraan->data[0]->jumlah_baris_histori ?></h3>
                        </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-clipboard-text text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>User</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h3 class="mb-0"><?= $dataUser->data[0]->jumlah_baris_histori ?></h3>
                        </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-account text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /////////////////////////////////////// End Informasi Mobil ////////////////////////////////////////////// -->

<div class="row">
    <div class="col-sm-8">
        <div class="card card-body">
        <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> Tarif </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($jk!=null){
                                $i=1;
                                foreach($jk->data as $jkn){
                                    echo "<tr>";
                                    echo "<td>".$i++."</td>";
                                    echo "<td>".$jkn->Nama."</td>";
                                    echo "<td>Rp.".$jkn->Tarif."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-body">
            <div>
                <h3>Presentasi Kendaraan</h3>
                <?php echo $_SESSION['access_token'];?>
                <p>Mobil</p>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $avgMobil ?>%" aria-valuenow="<?= $avgMobil ?>"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p>Motor</p>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $avgMotor ?>%" aria-valuenow="<?= $avgMotor ?>"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- //////////// End Trading ///////// -->

<!-- <div class="row">
    <section class="py-6 print:hidden">
        <?php include "Map/peta-parkiran.php" ?>
      </section>

      <dialog id="dialog">
    <div class="flex items-center justify-between">
      <span id="dialog-title" class="text-2xl font-medium dark:text-slate-100">Detail Motor Terparkir</span>
      <button id="close-dialog-btn" class="w-10 h-10 text-2xl text-red-500 transition-colors duration-200 rounded-xl hover:bg-red-200 active:bg-red-300">
        <i class="fa-solid print:hidden fa-xmark"></i>
      </button>
    </div>

    <?php include "../components/konten-dialog/detail-motor-terparkir.php" ?>
  </dialog>
</div> -->
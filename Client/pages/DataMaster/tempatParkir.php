<?php
$url = $_HOST . "/parkir/search/";

$dataParkir = GetDataAPIByURLAndParam($url . "?statusparkir=true" , null);
?>

<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Tempat Parkir </h3>
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

            <!-- card header -->
            <div class="row mb-3">
                <div class="col-sm-12">
                    <a  class="btn btn-primary btn-fw" href="index.php?page=tambahTempatParkir">Tambah Lahan</a>
                </div>
            </div>
            <!-- end card header -->

            <!-- Tables -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Posisi</th>
                                    <th>Jenis Kendaraan</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i=1; if(isset($dataParkir)) : ?>
                                    <?php foreach($dataParkir->data as $parkir) :?>
                                      <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $parkir->Posisi ?></td>
                                        <td><?= $parkir->Nama ?></td>
                                      </tr>
                                    <?php $i++; endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /////////////////////////////////////// Card Body ////////////////////////////////////////////// -->
    </div>
</div>
<!-- /////////////////////////////////////// End Card ////////////////////////////////////////////// -->

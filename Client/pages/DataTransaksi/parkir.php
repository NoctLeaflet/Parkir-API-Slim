<?php
$url = $_HOST . "/parkir/search/";

$dataParkir = GetDataAPIByURLAndParam($url . "?statusparkir=true" , null);
?>

<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Parkir </h3>
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

            <!-- card header -->
            <div class="row mb-3">
                <div class="col-sm-12">
                    <a  class="btn btn-primary btn-fw" href="index.php?page=parkirMasuk">Parkir Masuk</a>
                    <a  class="btn btn-warning btn-fw" href="index.php?page=parkir-keluar">Parkir Keluar</a>
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
                                    <th>Tempat Parkir</th>
                                    <th>Status</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Nomor Polisi</th>
                                    <th>Jam Masuk</th>
                                    <!-- <th>Jam Keluar</th> -->
                                    <th>Tanggal Masuk</th>
                                    <!-- <th>Tanggal Keluar</th> -->
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if(isset($dataParkir)) : ?>
                                    <?php foreach($dataParkir->data as $parkir) :?>
                                      <tr>
                                        <td><?= $parkir->Posisi ?></td>
                                        <td>
                                          <?php if(!isset($parkir->StatusParkir)) : ?>
                                           <span class="text-success">~ available ~</span>
                                          <?php else : ?>
                                            <span class="text-danger">~ occupied ~</span>
                                          <?php endif; ?>
                                        </td>
                                        <td><?= $parkir->Nama ?></td>
                                        <td><?= $parkir->PlatNomor ?></td>
                                        <?php if(isset($parkir->StatusParkir)) : ?>
                                          <td><?= date("h:i:s A", strtotime($parkir->JamMasuk)) ?></td>
                                          <!-- <td><?= date("h:i:s A", strtotime($parkir->JamKeluar)) ?></td> -->
                                          <td><?= date("Y-m-d H:i:s",strtotime($parkir->JamMasuk)) ?></td>
                                          <!-- <td><?= date("Y-m-d H:i:s",strtotime($parkir->JamKeluar)) ?></td> -->
                                          <!-- <td><a href="" class="btn btn-danger btn-md">Keluar</a></td> -->
                                        <?php else : ?>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <!-- <td></td>                                         -->
                                          <!-- <td></td>                                         -->
                                          <!-- <td></td>                                         -->
                                        <?php endif; ?>
                                        
                                      </tr>
                                    <?php endforeach; ?>
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

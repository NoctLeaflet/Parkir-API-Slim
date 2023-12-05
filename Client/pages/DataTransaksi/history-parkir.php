<?php
$url = $_HOST . "/parkir/search/";
$dataParkir = GetDataAPIByURLAndParam($url, null);
?>


<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> History Parkir </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">History Parkir</a></li>
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

            <!-- Filter  -->
            <div class="row mb-3">
                <div class="col-sm-12">
                <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-danger">Cari History Parkir</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-9">
                            <select class="form-control" id="exampleSelectGender">
                          <option>Jenis Kendaraan</option>
                          <option>Nomor Polisi</option>
                        </select>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <!-- end Filter -->

            <!-- Tables -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tempat Parkir</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Nomor Polisi</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Total Tarif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($dataParkir)) : ?>
                                    <?php foreach($dataParkir->data as $parkir) :?>
                                      <tr>
                                        <td><?= $parkir->Posisi ?></td>
                                        <td><?= $parkir->Nama ?></td>
                                        <td><?= $parkir->PlatNomor ?></td>
                                        <td><?= date("h:i:s A", strtotime($parkir->JamMasuk)) ?></td>
                                        <td><?= date("h:i:s A", strtotime($parkir->JamKeluar)) ?></td>
                                        <td><?= date("Y-m-d H:i:s",strtotime($parkir->JamMasuk)) ?></td>
                                        <?php if(strtotime($parkir->JamKeluar) != strtotime('0000-00-00 00:00:00')) : ?>
                                          <td><?= date("Y-m-d H:i:s",strtotime($parkir->JamKeluar)) ?></td>
                                          <td><?= $parkir->TotalBayar ?></td>
                                        <?php else : ?>
                                          <td></td>
                                          <td></td>
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

<!-- /////////////////////////////////// Modal Parkir Masuk ///////////////////////////////// -->
<div class="modal fade" id="modal-parkir-masuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- //////////////////////////////////// modal content //////////////////////////////////// -->
        <div class="row">
            <div class="col-sm-12">
            <h4>Basic form elements</h4>
                    <p class="card-description"> Basic form elements </p>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="exampleSelectGender">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">City</label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Textarea</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
            </div>
        </div>
        <!-- //////////////////////////////////// modal content //////////////////////////////////// -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- /////////////////////////////////// Modal Parkir Masuk ///////////////////////////////// -->

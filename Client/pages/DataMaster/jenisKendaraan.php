<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Jenis Kendaraan </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Jenis Kendaraan</a></li>
        </ol>
    </nav>
</div>
<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<?php
    // URL API
    $url = 'http://localhost:8080/jk/search/';
    $client = curl_init();
    $options = array(
    CURLOPT_URL				=> $url, // Set URL of API
    CURLOPT_CUSTOMREQUEST 	=> "GET", // Set request method
    CURLOPT_RETURNTRANSFER	=> true, // true, to return the transfer as a string
    );
    curl_setopt_array( $client, $options );

    // Execute and Get the response
    $response = curl_exec($client);
    // Get HTTP Code response
    $httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
    // Close cURL session
    curl_close($client);

    $jk=null;
    if($httpCode=="200"){ // if success
        $jk=json_decode($response);
    }else{ // if failed
        $response=json_decode($response);
        echo "<div class='alert alert-danger' style='width:300px;'>Terjadi Kesalahan<br/>".$response->error."</div>";
    }
?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> Tarif </th>
                                <th> Modify </th>
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
                                    echo "<td>";
                                    echo @"<a type='button' class='btn btn-warning btn-rounded btn-fw' href='index.php?page=editJenisKendaraan&id={$jkn->idJenisKendaraan}'>Edit</a> ";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <a type="button" class="btn btn-primary btn-fw" href="index.php?page=tambahjeniskd">Tambah Jenis Kendaraan</a>
    </div>
</div>
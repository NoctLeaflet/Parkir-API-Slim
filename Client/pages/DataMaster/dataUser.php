<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Data User </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Data User</a></li>
        </ol>
    </nav>
</div>
<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<?php
    // URL API
    $url = 'http://localhost:8080/user/search/';
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

    $user=null;
    if($httpCode=="200"){ // if success
        $user=json_decode($response);
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
                                <th> Email </th>
                                <th> Level </th>
                                <th> Modify </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($user!=null){
                                $i=1;
                                foreach($user->data as $users){
                                    echo "<tr>";
                                    echo "<td>".$i++."</td>";
                                    echo "<td>".$users->Nama."</td>";
                                    echo "<td>".$users->Email."</td>";
                                    echo "<td>".$users->Level."</td>";
                                    echo "<td>";
                                    echo @"<a type='button' class='btn btn-warning btn-rounded btn-fw' href='index.php?page=editUser&id={$users->idUser}'>Edit</a> ";
                                    // echo "<a class='text-white' href='hapusUser.php?idUser=".$users->idUser."'><button type='button' class='btn btn-danger btn-rounded btn-fw'>Hapus</button></a>";
                                    // echo "<form action='hapusUser.php'  method='POST'>";
                                    // echo "<input type='hidden' name='idUser' value='" . $users->idUser . "'>";
                                    // echo "<input type='submit' class='btn btn-danger btn-rounded btn-fw' value='Hapus'>";
                                    // echo "</form>";
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
        <a type="button" class="btn btn-primary btn-fw" href="index.php?page=tambahUser">Tambah User</a>
    </div>
</div>
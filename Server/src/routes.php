<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
    
    ///////////////////////////////////////////////////// API USER //////////////////////////////////////////
    /// Cari User
    $app->get("/user/search/", function (Request $request, Response $response){
        
        //cek filter
        if($request->getQueryParam("filterby") != null && $request->getQueryParam("filter") != null)
        {
            //get param
            $filterby = $request->getQueryParam("filterby");
            $filter = $request->getQueryParam("filter");

            $sql = @"SELECT idUser
                            , Nama
                            , Email
                            , null as Password
                            , Level
                            , CreateDate
                            , ModifyDate 
                    FROM user WHERE {$filterby} like '%{$filter}%'";
        }
        else
        {
            $sql = "SELECT * FROM user";
        }
        
        //get data
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
    
    /// Tambah User
    $app->post("/user/", function (Request $request, Response $response){
        $new_user = $request->getParsedBody();
        $sql = "INSERT INTO user (Nama, Email, Password, Level, CreateDate, ModifyDate) value (:nama, :email, :password, :level, :createdate, :modifydate)";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":nama" => $new_user["Nama"]
            , ":email" => $new_user["Email"]
            , ":password" => $new_user["Password"]
            , ":level" => $new_user["Level"]
            , ":createdate" => $new_user["CreateDate"]
            , ":modifydate" => $new_user["ModifyDate"]
        ];
        try {
            $stmt->execute($data);
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        } catch (Exception  $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "data" => $new_user
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
    });

    /// Edit User
    $app->put("/user/{id}", function (Request $request, Response $response, $args){

        //get param
        $id = $args["id"];
        $new_user = $request->getParsedBody();
        $rildata = file_get_contents('php://input');

        //query
        $sql = "UPDATE user 
                    SET Nama = :nama 
                        , Email = :email 
                        , Password = :password
                        , Level = :level
                        , CreateDate = :createdate 
                        , ModifyDate  = :modifydate
                    WHERE idUser=:iduser";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":iduser" => $id
            , ":nama" => $new_user["Nama"]
            , ":email" => $new_user["Email"]
            , ":password" => $new_user["Password"]
            , ":level" => $new_user["Level"]
            , ":createdate" => $new_user["CreateDate"]
            , ":modifydate" => $new_user["ModifyDate"]
        ];

        try {
            $stmt->execute($data);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err->getMessage()
                ],
                [
                    "idUser" => $id
                ],
                [
                    "data1" => $rildata
                ],
                [
                    "data2" => $new_user
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
    });

    
    /// Delete User
    $app->delete("/user/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];

        $sql = "DELETE FROM user WHERE idUser=:id";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([":id" => $id]);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "idUser" => $id
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        // if($stmt->execute($data))
        // return $response->withJson(["status" => "success", "data" => "1"], 200);
        // return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
    ///////////////////////////////////////////////////// End API USER //////////////////////////////////////////


    ///////////////////////////////////////////////////// API Jenis Kendaraan //////////////////////////////////////////
    /// Cari Jenis Kendaraan
    $app->get("/jk/search/", function (Request $request, Response $response){
        
        //cek filter
        if($request->getQueryParam("filterby") != null && $request->getQueryParam("filter") != null)
        {
            //get param
            $filterby = $request->getQueryParam("filterby");
            $filter = $request->getQueryParam("filter");

            $sql = @"SELECT * FROM jeniskendaraan WHERE {$filterby} like '%{$filter}%'";
        }
        else
        {
            $sql = "SELECT * FROM jeniskendaraan";
        }
        
        //get data
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();    
                    
        } catch (Exception  $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "data1" => $stmt
                ],
                [
                    "data2" => $sql
                ],
                [
                    "data3" => file_get_contents('php://input')
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        
        
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
    
    /// Tambah JK
    $app->post("/jk/", function (Request $request, Response $response){
        $new_jk = $request->getParsedBody();
        $sql = "INSERT INTO jeniskendaraan (Nama, Tarif, CreateDate, ModifyDate) 
                    value (:nama, :tarif, :createdate, :modifydate)";
                    
        $stmt = $this->db->prepare($sql);
        $data = [
            ":nama" => $new_jk["Nama"]
            , ":tarif" => $new_jk["Tarif"]
            , ":createdate" => $new_jk["CreateDate"]
            , ":modifydate" => $new_jk["ModifyDate"]
        ];
        try {
            $stmt->execute($data);
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        } catch (Exception  $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "data" => $new_jk
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
    });

    /// Edit JK
    $app->put("/jk/{id}", function (Request $request, Response $response, $args){

        //get param
        $id = $args["id"];
        $new_jk = $request->getParsedBody();
        $rildata = file_get_contents('php://input');

        //query
        $sql = "UPDATE jeniskendaraan 
                    SET Nama = :nama 
                        , Tarif = :tarif 
                        , CreateDate = :createdate 
                        , ModifyDate  = :modifydate
                    WHERE idJenisKendaraan=:idjeniskendaraan";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":idjeniskendaraan" => $id 
            , ":nama" => $new_jk["Nama"]
            , ":tarif" => $new_jk["Tarif"]
            , ":createdate" => $new_jk["CreateDate"]
            , ":modifydate" => $new_jk["ModifyDate"]
        ];

        try {
            $stmt->execute($data);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err->getMessage()
                ],
                [
                    "idjeniskendaraan" => $id
                ],
                [
                    "data1" => $rildata
                ],
                [
                    "data2" => $new_jk
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
    });

    /// Delete JK
    $app->delete("/jk/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];

        $sql = "DELETE FROM jeniskendaraan WHERE idJenisKendaraan=:id";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([":id" => $id]);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "idJenisKendaraan" => $id
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
    });
    ///////////////////////////////////////////////////// End API Jenis Kendaraan //////////////////////////////////////////


    ///////////////////////////////////////////////////// API Tempat Parkir //////////////////////////////////////////
    /// Cari Tempat Pakir
    $app->get("/tp/search/", function (Request $request, Response $response){
        
        //cek filter
        if($request->getQueryParam("filterby") != null && $request->getQueryParam("filter") != null)
        {
            //get param
            $filterby = $request->getQueryParam("filterby");
            $filter = $request->getQueryParam("filter");

            $sql = @"SELECT *
                    FROM tempatparkir WHERE {$filterby} like '%{$filter}%'";
        }
        else
        {
            $sql = "SELECT * FROM tempatparkir";
        }
        
        //get data
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    /// Tambah TP
    $app->post("/tp/", function (Request $request, Response $response){
        $new_tp = $request->getParsedBody();
        $sql = "INSERT INTO tempatparkir (Posisi, IdJenisKendaraan, CreateDate, ModifyDate) 
                    value (:posisi, :idjeniskendaraan, :createdate, :modifydate)";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":posisi" => $new_tp["Posisi"]
            , ":idjeniskendaraan" => $new_tp["IdJenisKendaraan"]
            , ":createdate" => $new_tp["CreateDate"]
            , ":modifydate" => $new_tp["ModifyDate"]
        ];
        try {
            $stmt->execute($data);
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        } catch (Exception  $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "data" => $new_tp
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
    });

    /// Edit TP
    $app->put("/tp/{id}", function (Request $request, Response $response, $args){

        //get param
        $id = $args["id"];
        $new_tp = $request->getParsedBody();
        $rildata = file_get_contents('php://input');

        //query
        $sql = "UPDATE tempatparkir 
                    SET Posisi = :posisi
                        , IdJenisKendaraan = :idjeniskendaraan
                        , CreateDate = :createdate 
                        , ModifyDate  = :modifydate
                    WHERE idTempatParkir=:idtempatparkir";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":idtempatparkir" => $id
            , ":posisi" => $new_tp["Posisi"]
            , ":idjeniskendaraan" => $new_tp["IdJenisKendaraan"]
            , ":createdate" => $new_tp["CreateDate"]
            , ":modifydate" => $new_tp["ModifyDate"]
        ];

        try {
            $stmt->execute($data);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err->getMessage()
                ],
                [
                    "idTempatParkir" => $id
                ],
                [
                    "data1" => $rildata
                ],
                [
                    "data2" => $new_tp
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
    });

    /// Delete TP
    $app->delete("/tp/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];

        $sql = "DELETE FROM tempatparkir WHERE idTempatParkir=:id";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([":id" => $id]);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "idTempatParkir" => $id
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        // if($stmt->execute($data))
        // return $response->withJson(["status" => "success", "data" => "1"], 200);
        // return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
    ///////////////////////////////////////////////////// End API Tempat Parkir //////////////////////////////////////////

    /// Cari Parkir
    $app->get("/parkir/search/", function (Request $request, Response $response){
        
        //cek status parkir
        if($request->getQueryParam("statusparkir"))
        {                
            $statusParkir = $request->getQueryParam("statusparkir");        
            //query
            $sql = @"SELECT *, tp.idTempatParkir FROM tempatparkir tp
                        left join parkir p on p.IdTempatParkir = tp.IdTempatParkir and p.StatusParkir = {$statusParkir}
                        inner join jeniskendaraan jk on jk.idJenisKendaraan = tp.idJenisKendaraan";
            
            //cek filter
            if($request->getQueryParam("filterby") != null && $request->getQueryParam("filter") != null)
            {
                //get param
                $filterby = $request->getQueryParam("filterby");
                $filter = $request->getQueryParam("filter");

                $sql .= " WHERE {$filterby} like '%{$filter}%'";
            }
        }
        else
        {
            //query
            $sql = @"SELECT * FROM tempatparkir tp
            inner join parkir p on p.IdTempatParkir = tp.IdTempatParkir
            inner join jeniskendaraan jk on jk.idJenisKendaraan = tp.idJenisKendaraan";

            if($request->getQueryParam("filterby") != null && $request->getQueryParam("filter") != null)
            {
                //get param
                $filterby = $request->getQueryParam("filterby");
                $filter = $request->getQueryParam("filter");
                            
                $sql .= " WHERE {$filterby} like '%{$filter}%'";
            }
        }
        
        
        try {
            //get data
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            // throw new Exception("Error Processing Request", 1);
            
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err->getMessage()
                ],
                [
                    "query" => $stmt
                ],
                [
                    "param" => $request->getQueryParam("filterby")
                ],
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    /// Tambah Masuk Parkir   
    $app->post("/parkir/", function (Request $request, Response $response){
        $new_parkir = $request->getParsedBody();
        $sql = "INSERT INTO parkir (idTempatParkir, idJenisKendaraan, PlatNomor, JamMasuk, StatusParkir) 
                    value (:idtempatparkir, :idjeniskendaraan, :platnomor, :jammasuk , :statusparkir)";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":idtempatparkir" => $new_parkir["IdTempatParkir"]
            , ":idjeniskendaraan" => $new_parkir["IdJenisKendaraan"]
            , ":platnomor" => $new_parkir["PlatNomor"]
            , ":jammasuk" => $new_parkir["JamMasuk"]
            , ":statusparkir" => $new_parkir["StatusParkir"]
        ];
        try {
            $stmt->execute($data);
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        } catch (Exception  $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "data" => $new_parkir
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 500);
        }
    });


    // Edit Keluar Parkir   
    $app->put("/parkir/{platnomor}", function (Request $request, Response $response, $args) use ($app){

        //get param
        $id = $args["platnomor"];
        $new_parkir = $request->getParsedBody();
        $rildata = file_get_contents('php://input');
        

        // Billing
        $jamMasuk = new DateTime($new_parkir["JamMasuk"]);
        $JamKeluar = new DateTime($new_parkir["JamKeluar"] );
        $diff = $JamKeluar->diff($jamMasuk);
        $totalWaktuParkir = (($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i) / 60;

        $totalBayar = ceil(($new_parkir["Tarif"] * $totalWaktuParkir) / 100) * 100;


        //query
        $sql = "UPDATE parkir SET TotalBayar = :totalbayar, JamKeluar = :jamkeluar , StatusParkir = :statusparkir WHERE idParkir=:idparkir";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":idparkir" => $new_parkir["idParkir"]
            , ":totalbayar" => $totalBayar
            , ":jamkeluar" => $new_parkir["JamKeluar"]
            , ":statusparkir" => false
        ];

        try {
            // throw new Exception("Error Processing Request", 1);
            $stmt->execute($data);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err->getMessage()
                ],
                [
                    "idParkir" => $id
                ],
                [
                    "1" => $totalBayar
                ],
                [
                    "2" => $new_parkir
                ],
                [
                    "3" => $data
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
    });

    /// Report

    /// get jumlah

    $app->get("/dashboard/count/p/", function (Request $request, Response $response){
        
        //cek filter
        //get data
        $sql = "SELECT COUNT(*) as jumlah_baris_histori FROM parkir where StatusParkir = true";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        //return 0
        if(!isset($result))
        {
            $result = [
                [
                    "jumlah_baris_histori" => 0
                ]
            ];
        }
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    //parkir keluar
    $app->get("/dashboard/count/pkeluar/", function (Request $request, Response $response){
        
        //cek filter
        //get data
        $sql = "SELECT COUNT(*) as jumlah_baris_histori FROM parkir where StatusParkir = false";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        //return 0
        if(!isset($result))
        {
            $result = [
                [
                    "jumlah_baris_histori" => 0
                ]
            ];
        }
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    // count jenis kendaraan 
    $app->get("/dashboard/count/jk/", function (Request $request, Response $response){
        
        //cek filter
        //get data
        $sql = "SELECT COUNT(*) as jumlah_baris_histori FROM jeniskendaraan";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        //return 0
        if(!isset($result))
        {
            $result = [
                [
                    "jumlah_baris_histori" => 0
                ]
            ];
        }
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    // count user
    $app->get("/dashboard/count/u/", function (Request $request, Response $response){
        
        //cek filter
        //get data
        $sql = "SELECT COUNT(*) as jumlah_baris_histori FROM user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        //return 0
        if(!isset($result))
        {
            $result = [
                [
                    "jumlah_baris_histori" => 0
                ]
            ];
        }
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    // count Motor Mobil
    $app->get("/dashboard/count/jkm/", function (Request $request, Response $response){
        
        //cek filter
        //get data
        $sql = "SELECT sum(idJenisKendaraan=2) as cntMotor
                        , sum(idJenisKendaraan=3) as cntMobil
                from parkir";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        //return 0
        if(!isset($result))
        {
            $result = [
                [
                    "cntMotor" => 0,
                    "cntMobil" => 0
                ] 
            ];
        }
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    /// a

    $app->get("/dashboard/diagram/p/", function (Request $request, Response $response){
        
        //cek filter
        //get data
        $sql = "SELECT COUNT(*) AS total_parkiran, COUNT(idJenisKendaraan) AS jml_terisi FROM tempatparkir";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $data = mysqli_fetch_assoc($result);
        //return 0
        if(!isset($result))
        {
            $result = [
                [
                    "total_parkiran" => 0,
                    "jml_terisi" => 0
                ] 
            ];
        }
        $kapasitas = [
            "total_parkiran" => $data["total_parkiran"],
            "jml_terisi" => $data['jml_terisi'],
            "persen_terisi" => ($data['jml_terisi'] / $data["total_parkiran"]) * 100
        ];

        return $kapasitas;
        //return data
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    //// a

    // function cekKapasitasParkiran(mysqli $conn)
    // {
    //     $result = mysqli_query(
    //         $conn,
    //         "SELECT COUNT(*) AS total_parkiran, COUNT(idJenisKendaraan) AS jml_terisi FROM tempatparkir"
    //     );

    //     $data = mysqli_fetch_assoc($result);

    //     $kapasitas = [
    //         "total_parkiran" => $data["total_parkiran"],
    //         "jml_terisi" => $data['jml_terisi'],
    //         "persen_terisi" => ($data['jml_terisi'] / $data["total_parkiran"]) * 100
    //     ];

    //     return $kapasitas;
    // }

    // function dataTambahanMotor(mysqli $conn): array
    // {
    //     // hitung jumlah motor yang pernah parkir 
    //     $result_total = mysqli_query($conn, "SELECT COUNT(*) as jumlah_baris_histori FROM parkir");
    //     $baris = mysqli_fetch_assoc($result_total);
    //     $jumlah_baris_histori = $baris['jumlah_baris_histori'];

    //     // ambil data terbaru motor keluar dari histori parkir
    //     $result_keluar_terbaru = mysqli_query(
    //         $conn,
            // "SELECT * FROM parkir WHERE Jamkeluar IS NOT NULL
            // ORDER BY JamKeluar DESC 
            // LIMIT 1
            // "
    //     );
    //     $motor_keluar_terbaru = mysqli_fetch_assoc($result_keluar_terbaru);

    //     // ambil jumlah penambahan motor hari ini
    //     $hari_ini = date('Y-m-d');
    //     $penambahan_res = mysqli_query(
    //         $conn,
    //         "SELECT COUNT(*) as penambahan FROM histori_parkir WHERE DATE(tanggal_masuk) = '$hari_ini'"
    //     );

    //     $penambahan = mysqli_fetch_assoc($penambahan_res);


    //     return [
    //         "jumlah_total" => $jumlah_baris_histori,
    //         "terakhir_keluar" => $motor_keluar_terbaru,
    //         "jumlah_motor_baru_hari_ini" => $penambahan['penambahan']
    //     ];
    // }

    /// end get 










    /// Get Students
    
    $app->get("/students/", function (Request $request, Response $response){
        $sql = "SELECT * FROM mahasiswa";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    /// Get Students (2)
    $app->get("/students/{id}", function (Request $request, Response $response, $args){
        $id = str_replace("_", ".",$args["id"]);
        $sql = "SELECT * FROM mahasiswa where nim=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetchAll();
         return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    //FInd Stundents (Di culik suhar-)
    $app->get("/students/search/", function (Request $request, Response $response){
        $keyword = $request->getQueryParam("Keyword");
        $sql = "SELECT * FROM mahasiswa WHERE nama like '%keyword%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    $app->post("/students/", function (Request $request, Response $response){
        $new_students = $request->getParsedBody();
        $sql = "INSERT INTO mahasiswa (nim, nama, angkatan, semester, ipk, email, telepon) value (:nim, :nama, :angkatan, :semester, :ipk, :email, :telepon)";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":nim" => $new_students["nim"]
            , ":nama" => $new_students["nama"]
            , ":angkatan" => $new_students["angkatan"]
            , ":semester" => $new_students["semester"]
            , ":ipk" => $new_students["ipk"]
            , ":email" => $new_students["email"]
            , ":telepon" => $new_students["telepon"]
        ];
        try {
            $stmt->execute($data);
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        } catch (Exception  $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "data" => $new_students
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
    });

    //put
    $app->put("/students/{id}", function (Request $request, Response $response, $args){
        $id = str_replace("_", ".",$args["id"]);
        $new_students = $request->getParsedBody();
        $rildata = file_get_contents('php://input');

        
        $sql = "UPDATE mahasiswa 
                    SET nim=:id, nama=:nama, angkatan=:angkatan, semester=:semester, ipk=:ipk, email=:email, telepon=:telepon 
                    WHERE nim=:id";
        $stmt = $this->db->prepare($sql);
        $data = [
            ":id" => $id
            , ":nama" => $new_students["nama"]
            , ":angkatan" => $new_students["angkatan"]
            , ":semester" => $new_students["semester"]
            , ":ipk" => $new_students["ipk"]
            , ":email" => $new_students["email"]
            , ":telepon" => $new_students["telepon"]
        ];

        try {
            $stmt->execute($data);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "nim" => $id
                ],
                [
                    "data1" => $rildata
                ],
                [
                    "data2" => $new_students
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        // if($stmt->execute($data))
        // return $response->withJson(["status" => "success", "data" => "1"], 200);
        // return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });

    $app->delete("/students/{id}", function (Request $request, Response $response, $args){
        $id = str_replace("_", ".",$args["id"]);

        $sql = "DELETE FROM mahasiswa WHERE nim=:id";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([":id" => $id]);
        } catch (Exception $err) {
            $data = [
                [
                    "err" => $err
                ],
                [
                    "nim" => $id
                ]
            ];
            return $response->withJson(["status" => "failed", "data" => $data], 200);
        }
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        // if($stmt->execute($data))
        // return $response->withJson(["status" => "success", "data" => "1"], 200);
        // return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });


    $app->get("/debug/", function (Request $request, Response $response){
        
        return $response->withJson(["status" => "success", "data" => file_get_contents('php://input')], 200);
    });
};
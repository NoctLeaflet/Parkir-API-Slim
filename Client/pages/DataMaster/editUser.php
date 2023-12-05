<?php
$url = $_HOST . "/user/";

if(isset($_POST["Nama"]))
{
    $insertData = [
        "Nama" => $_POST["Nama"]
            , "Email" => $_POST["Email"]
            , "Password" => $_POST["Password"]
            , "Level" => $_POST["Level"]
            , "CreateDate" => date("Y-m-d H:i:s")
            , "ModifyDate" => date("Y-m-d H:i:s")
    ];
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // var_dump($insertData);
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // var_dump($insertData);
    EditDataAPIByURL($url . $_POST["id"], $insertData, "dataUser");
    HapusDataAPIByURLAndID($url . $_POST["id"], "dataUser");
}

?>

<!-- /////////////////////////////////////// Breadcrumb ////////////////////////////////////////////// -->
<div class="page-header">
    <h3 class="page-title"> Edit User </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Data User</a></li>
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
                        <input type="hidden" class="form-control" name="id" value="<?= $_GET["id"] ?>" required/>
                        <div class="form-group">
                            <label>Nama :</label>
                            <input type="text" class="form-control" name="Nama" required/>
                        </div>
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="text" class="form-control" name="Email" required/>
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            <input type="text" class="form-control" name="Password" required/>
                        </div>
                        <div class="form-group">
                            <label>Level :</label>
                            <input type="text" class="form-control" name="Level" required/>
                        </div>
                        <div class="form-group">
					        <input type="submit" class="btn btn-success" value="Simpan">
                            <a type="button" class="btn btn-danger" href="index.php?page=hapusUser&id=<?=$_GET["id"]?>">Hapus</a>
					        <a class="btn btn-warning" href="index.php?page=dataUser">Batal</a>
				        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /////////////////////////////////////// Card Body ////////////////////////////////////////////// -->
    </div>
</div>
<!-- /////////////////////////////////////// End Card ////////////////////////////////////////////// -->

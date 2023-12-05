
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sample Client App</title>
	<link href="bootstrap-3.3.51/css/bootstrap.css" rel="stylesheet"/>
</head>

<body>
	<div class="container">
		<br/>
		<?php
		

		
		$nim="";
		$nama="";
		$angkatan="";
		$semester="";
		$ipk="";
		$email="";
		$telepon="";

		if(isset($_POST["nim"])){

			// get POST
			$nim=$_POST['nim'];
			$nama=$_POST['nama'];
			$angkatan=$_POST['angkatan'];
			$semester=$_POST['semester'];
			$ipk=$_POST['ipk'];
			$email=$_POST['email'];
			$telepon=$_POST['telepon'];

			$data = array(
					"nim"=>$nim
					, "nama"=>$nama
					, "angkatan"=>$angkatan
					, "semester"=>$semester
					, "ipk"=>$ipk
					, "email"=>$email
					, "telepon"=>$telepon
				);
			$data = json_encode($data);

			//Initialise the cURL var
			$curl = curl_init();
			
			//All options in an array
			$options = [
			CURLOPT_URL => 'http://localhost:8080/students/',
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => ["Accept: application/json", "Content-Type: application/json"],
			CURLOPT_POSTFIELDS => $data
			
			];
			
			//Set the Options array.
			curl_setopt_array($curl, $options);
			
			// Execute the request
			$response = curl_exec($curl);
			
			//If error occurs
			if (curl_errno($curl)) {
				echo "<div class='alert alert-danger' style='width:300px;'>Terjadi Kesalahan<br/>".curl_error($ch)."</div>";
			}
			
			//If no errors
			else {
				echo "<div class='alert alert-success' style='width:300px;'>Berhasi Disimpan</div>";
				// curl_close($curl);
				header( "refresh:1;url=index.php");
			}
			
			//Close to remove $curl from memory
			curl_close($curl);
		}

		?>


		<h1>Tambah Data Mahasiswa</h1>
		<br/>
		<div style="width:300px;">
			<form role="form" method="POST">
				<div class="form-group">
					<label>NIM</label>
					<input type="text" class="form-control" name="nim" value="<?php echo $nim; ?>" required/>
				</div>
				<div class="form-group">
					<label>Nama :</label>
					<input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" required/>
				</div>
				<div class="form-group">
					<label>Angkatan :</label>
					<input type="number" class="form-control" name="angkatan" value="<?php echo $angkatan; ?>" required/>
				</div>
				<div class="form-group">
					<label>Semester :</label>
					<input type="number" class="form-control" name="semester" value="<?php echo $semester; ?>" required/>
				</div>
				<div class="form-group">
					<label>IPK :</label>
					<input type="double" class="form-control" name="ipk" value="<?php echo $ipk; ?>" required/>
				</div>
				<div class="form-group">
					<label>Email :</label>
					<input type="text" class="form-control" name="email" value="<?php echo $email; ?>" required/>
				</div>
				<div class="form-group">
					<label>Telephone :</label>
					<input type="text" class="form-control" name="telepon" value="<?php echo $telepon; ?>" required/>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Simpan">
					<a class="btn btn-default" href="index.php">Batal</a>
				</div>
			</form>
		</div>

	</div>
</body>
</html>
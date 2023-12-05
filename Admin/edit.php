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
		
		$idNim=$_GET['nim'];
		$nim="";
		$nama="";
		$angkatan="";
		$semester="";
		$ipk="";
		$email="";
		$telepon="";

		// if submit, EDIT DATA
		if(isset($_POST["nim"])){

			$client = curl_init();

			// get POST
			$nim=$_POST['nim'];
			$nama=$_POST['nama'];
			$angkatan=$_POST['angkatan'];
			$semester=$_POST['semester'];
			$ipk=$_POST['ipk'];
			$email=$_POST['email'];
			$telepon=$_POST['telepon'];

			$data = array("nim"=>$nim, "nama"=>$nama, "angkatan"=>$angkatan, "semester"=>$semester, "ipk"=>$ipk, "email"=>$email, "telepon"=>$telepon);
			$data = json_encode($data);
			//All options in an array

			// curl initiate
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/students/'.str_replace(".","_", $idNim));

			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data)));

			// SET Method as a PUT
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

			// Pass user data in POST command
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			// Execute curl and assign returned data
			$response  = curl_exec($ch);

			//If error occurs
			if (curl_errno($ch)) {
				echo "<div class='alert alert-danger' style='width:300px;'>Terjadi Kesalahan<br/>".curl_error($ch)."</div>";
			}
			
			//If no errors
			else {
				echo "<div class='alert alert-success' style='width:300px;'>Berhasi Disimpan</div>";
				// curl_close($curl);
				header( "refresh:1;url=index.php");
			}

			// Close curl
			curl_close($ch);

		}else{

			// Load Data
			$client = curl_init();
			$url = 'http://localhost:8080/students/'.str_replace(".","_", $idNim);
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

			$daftarBarang=null;
			if($httpCode=="200"){ // if success
				$mahasiswa=json_decode($response);
				$nim=$mahasiswa->data[0]->nim;
				$nama=$mahasiswa->data[0]->nama;
				$angkatan=$mahasiswa->data[0]->angkatan;
				$semester=$mahasiswa->data[0]->semester;
				$ipk=$mahasiswa->data[0]->ipk;
				$email=$mahasiswa->data[0]->email;				
				$telepon=$mahasiswa->data[0]->telepon;
			}else{ // if failed
				$response=json_decode($response);
				echo "<div class='alert alert-danger' style='width:300px;'>Terjadi Kesalahan<br/>".$response->error."</div>";
			}

		}

		?>


		<h1>Edit Data Mahasiswa</h1>
		<br/>
		<div style="width:300px;">
			<form role="form" method="POST">
				<div class="form-group">
					<!-- <label>NIM :</label> -->
					<input type="hidden" class="form-control" name="nim" value="<?php echo $nim; ?>"/>
				</div>
				<div class="form-group">
					<label>Nama :</label>
					<input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>"/>
				</div>
				<div class="form-group">
					<label>Angkatan :</label>
					<input type="number" class="form-control" name="angkatan" value="<?php echo $angkatan; ?>"/>
				</div>
				<div class="form-group">
					<label>Semester :</label>
					<input type="number" class="form-control" name="semester" value="<?php echo $semester; ?>"/>
				</div>
				<div class="form-group">
					<label>IPK :</label>
					<input type="double" class="form-control" name="ipk" value="<?php echo $ipk; ?>"/>
				</div>
				<div class="form-group">
					<label>Email :</label>
					<input type="text" class="form-control" name="email" value="<?php echo $email; ?>"/>
				</div>
				<div class="form-group">
					<label>Telephone :</label>
					<input type="text" class="form-control" name="telepon" value="<?php echo $telepon; ?>"/>
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
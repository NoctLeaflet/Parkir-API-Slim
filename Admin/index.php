
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sample Client App</title>
	<link href="bootstrap-3.3.51/css/bootstrap.css" rel="stylesheet"/>
</head>

<body>
<?php include "components/admin/admin-sidebar.php"; ?>
	<div class="container">
		<br/>

		<?php

		// URL API
		$url = 'http://localhost:8080/students/';
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

		$students=null;
		if($httpCode=="200"){ // if success
			$students=json_decode($response);
		}else{ // if failed
			$response=json_decode($response);
			echo "<div class='alert alert-danger' style='width:300px;'>Terjadi Kesalahan<br/>".$response->error."</div>";
		}
		?>

		<h1>Data Mahasiswa</h1>
		<br/>
		<div class="col-sm-12">
			<a type="button" class="btn btn-primary" href="tambah.php">Tambah Data Mahasiswa</a>
		</div>
		<br/><br/>
		<table class="table" cellspacing="0" width="100%">
			<tr>
				<th>Nim</th>
				<th>Nama</th>
				<th>Angkatan</th>
				<th>Semester</th>
				<th>IPK</th>
				<th>Email</th>
				<th>Telephone</th>
			</tr>
			<?php
			if($students!=null){
				$i=1;
				foreach($students->data as $student){
					
					echo "<tr>";
					echo "<td>".$student->nim."</td>";
					echo "<td>".$student->nama."</td>";
					echo "<td>".$student->angkatan."</td>";
					echo "<td>".$student->semester."</td>";
					echo "<td>".$student->ipk."</td>";
					echo "<td>".$student->email."</td>";
					echo "<td>".$student->telepon."</td>";
					echo "<td>";
					echo "<a class='btn btn-warning btn-sm' href='edit.php?nim=".$student->nim."'>EDIT</a> ";
					echo "<a class='btn btn-danger btn-sm' href='hapus.php?nim=".$student->nim."'>HAPUS</a> ";
					echo "</td>";
					echo "</tr>";
				}
			}
			?>
		</table>

	</div>
</body>
</html>
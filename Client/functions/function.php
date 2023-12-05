<?php
$_HOST = "http://localhost:8080";


function GetDataAPIByURLAndParam($url, $data,) {
    //Initialise the cURL var
    $curl = curl_init();

    //All options in an array
    $options = [
    CURLOPT_URL				=> $url, // Set URL of API
    CURLOPT_CUSTOMREQUEST 	=> "GET", // Set request method
    CURLOPT_RETURNTRANSFER	=> true, // true, to return the transfer as a string
    CURLOPT_HTTPHEADER => ["Accept: application/json", "Content-Type: application/json"]
    ];

    if(isset($data))
    {
        $data = json_encode($data);
        $param = [ CURLOPT_POSTFIELDS => $data];
        array_push($options, $param);
    }

    curl_setopt_array( $curl, $options );

    // Execute and Get the response
    $response = curl_exec($curl);
    // Get HTTP Code response
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    // Close cURL session
    curl_close($curl);

    $result=null;
    if($httpCode=="200"){ // if success
        $result=json_decode($response);
    }else{ // if failed
        $response=json_decode($response);
        // echo "alert(" . $response->error . ");";
        var_dump($response);
        $result = null;
    }
    
    return $result;
}		

function AddDataAPIByURL($url, $data, $halamanKembali)
{
    //Initialise the cURL var
    $curl = curl_init();

    //All options in an array
    $data = json_encode($data);

    $options = [
    CURLOPT_URL => $url,
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
        echo "<div class='alert alert-danger' style='width:300px;'>Terjadi Kesalahan<br/>".curl_error($curl)."</div>";
    }

    //If no errors
    else {
        echo "<div class='alert alert-success' style='width:300px;'>Berhasi Disimpan</div>";
        // curl_close($curl);
        if(isset($halamanKembali))
        {
            echo("<script>location.href = 'index.php?page=". $halamanKembali ."';</script>");
        }
    }

    //Close to remove $curl from memory
    curl_close($curl);
}

function  EditDataAPIByURL($url, $data, $halamanKembali)
{
    //Initialise the cURL var
    $curl = curl_init();


    curl_setopt($curl, CURLOPT_URL, $url);

			curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept: application/json", "Content-Type: application/json"));

			// SET Method as a PUT
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');

            if(isset($data))
            {
                //All options in an array
                $data = json_encode($data);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            
			// Pass user data in POST command
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			// Execute curl and assign returned data
			$response  = curl_exec($curl);

    // Execute the request
    $response = curl_exec($curl);

    var_dump($response);
    // die();
    //If error occurs
    if (curl_errno($curl)) {
        echo "<div class='alert alert-danger' style='width:300px;'>Terjadi Kesalahan<br/>".curl_error($curl)."</div>";
    }

    //If no errors
    else {
        echo "<div class='alert alert-success' style='width:300px;'>Berhasi Disimpan</div>";
        // curl_close($curl);
        if(isset($halamanKembali))
        {
            // echo("<script>location.href = 'index.php?page=". $halamanKembali ."';</script>");
        }
    }

    //Close to remove $curl from memory
    curl_close($curl);
}

function  HapusDataAPIByURLAndID($url, $halamanKembali)
{
    $client = curl_init();

    $options = array(
        CURLOPT_URL				=> $url, // Set URL of API
        CURLOPT_CUSTOMREQUEST 	=> "DELETE", // Set request method
        CURLOPT_RETURNTRANSFER	=> true, // true, to return the transfer as a string
        );

    curl_setopt_array( $client, $options );

    // Execute and Get the response
    $response = json_decode(curl_exec($client));
    // Get HTTP Code response
    $httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
    // Close cURL session
    curl_close($client);

    //If error occurs
    if ($httpCode!="200") {
        echo "<div class='alert alert-danger' style='width:300px;'>Terjadi Kesalahan<br/></div>";
    }
    //If no errors
    else {
        echo "<div class='alert alert-success' style='width:300px;'>Berhasi Disimpan</div>";
        // curl_close($curl);
        if(isset($halamanKembali))
        {
            echo("<script>location.href = 'index.php?page=". $halamanKembali ."';</script>");
        }
    }
}

?>

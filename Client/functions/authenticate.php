<?php
session_start();

$url = "https://exitium.serveo.net/api/auth/user-profile";
$ch = curl_init($url);

if (isset($_GET['access_token'])) {

    $headers = [
        'Authorization: Bearer ' . $_GET['access_token'],
    ];

    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);
    if ($httpcode == 200) {
        $user = json_decode($output);
    
        // session_destroy();
        $_SESSION['access_token'] = $_GET['access_token'];
        // $_SESSION['user'] = $user;
    } else {
        header('Location: ' . "http://puto.serveo.net/login");
    }

} else if (isset($_SESSION['access_token'])) {
    $headers = [
        'Authorization: Bearer ' . $_SESSION['access_token'],
    ];

    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpcode != 200) {
        // session_destroy();
        header('Location: ' . "http://puto.serveo.net/login");
    }
} else {
    header('Location: ' . "http://puto.serveo.net/login");
}
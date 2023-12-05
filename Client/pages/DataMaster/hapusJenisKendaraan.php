<?php
$url = $_HOST . "/jk/";

if(isset($_GET["id"]))
{
    HapusDataAPIByURLAndID($url . $_GET["id"], "jenisKendaraan");
}

?>
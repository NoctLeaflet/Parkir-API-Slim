<?php
$url = $_HOST . "/user/";

if(isset($_GET["id"]))
{
    HapusDataAPIByURLAndID($url . $_GET["id"], "dataUser");
}

?>
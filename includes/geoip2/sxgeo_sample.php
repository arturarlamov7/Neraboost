<?php
// include("SxGeo.php");
include($_SERVER['DOCUMENT_ROOT'] . "/includes/geoip2/SxGeo.php");

$SxGeo = new SxGeo($_SERVER['DOCUMENT_ROOT'] . "/includes/geoip2/SxGeo.dat");
$SxGeoIp = $_SERVER['REMOTE_ADDR'];

$SxGeoCountry = $SxGeo->getCountry($SxGeoIp);


<?php

// TODO - mit eigener Datenbak verbinden
$host = 'localhost';
$database = 'test';
$username = 'testuser';
$password = '12345';

// mit Datenbank verbinden
$mysqli = new mysqli($host, $username, $password, $database);

// Fehlermeldung, falls Verbindung fehl schlägt.
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}

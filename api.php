<?php
header("Access-Control-Allow-Origin: *"); // Replace with the domain you want to allow
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

if (isset($_GET['field']) && $_GET['field'] !== "" && isset($_GET['value']) && $_GET['value'] !== "") {
    $value = $_GET['value'];
    $field = $_GET['field'];
    $db = new PDO("sqlite:test.sqlite");
    $stmt = $db->prepare('SELECT * FROM mesclado WHERE ' . $field . ' = :value');
    $stmt->bindValue(':value', $value);
    $result = $stmt->execute();
    $res = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res = array("geometry" => ($row['WKT_GEOMETRY']));
    }
    echo json_encode($res);
    $db = null;
}

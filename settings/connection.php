<?php
include_once('./foo/sendJson.php');

try {
  $conn = new PDO("mysql:host=localhost;dbname=family-branches", "root", "");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e -> getMesage();
  exit( sendJson('false', array('data' => 'Error while connection')));
}

<?php

include_once('./settings/connection.php');
include_once('./foo/sendJson.php');
include_once('./foo/getInfo.php');

$id = 1;

if ($_POST['id']) {
  $id = $_POST['id'];
}

$query = 'select * from person where id = :id';

$stmt = $conn -> prepare($query);

$stmt -> bindValue(':id', $id);

$stmt -> execute();

$person_info = array();
$son_info = array();
$parent_info = array();

if ($stmt -> rowCount() > 0) {
  foreach ($stmt as $row) {
    $person_id = $row['id'];
    $son_id = $row['son_id'];
    $parent_id = $row['parent_id'];

    $person_info = getInfo($row['id'], $row['firstname'], $row['lastname'], $row['about']);

    if ($row['son_id']) {
      $son_query = 'select * from person where id = :son_id';

      $son_stmt = $conn -> prepare($son_query);

      $son_stmt -> bindValue(':son_id', $son_id);

      $son_stmt -> execute();
  
      foreach($son_stmt as $son_row) {
        $son_info = getInfo($son_row['id'], $son_row['firstname'], $son_row['lastname'], $son_row['about']);
      }
    } else {
      $son_info = 0;
    }

    if ($_POST['parent'] && $row['parent_id']) {
      $parent_query = 'select * from person where id = :parent_id';

      $parent_stmt = $conn -> prepare($parent_query);

      $parent_stmt -> bindValue(':parent_id', $parent_id);

      $parent_stmt -> execute();

      foreach($parent_stmt as $parent_row) {
        $parent_info = getInfo($parent_row['id'], $parent_row['firstname'], $parent_row['lastname'], $parent_row['about']);
      }
    } else {
      $parent_info = 0;
    }
  }
} else {
  exit(sendJson('false', array('data' => 'No such an id')));
}

echo sendJson('true', array('data' => array(
  'person_info' => $person_info,
  'son_info' => gettype($son_info) == 'array' ? $son_info : 0,
  'parent_info' => gettype($parent_info) == 'array' ? $parent_info : 0
)));

// print_r($person_info);























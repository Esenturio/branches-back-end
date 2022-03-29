<?php 
include_once('./foo/sendJson.php');
include_once('./settings/connection.php');
include_once('./foo/getInfo.php');

$firstname; $lastname; $about; $parent_id; $son_id;

if (!$_POST['firstname']) {
  exit(sendJson('false', array('data' => 'No firstname')));
}
if (!$_POST['lastname']) {
  exit(sendJson('false', array('data' => 'No lastname')));
}
if (!$_POST['about']) {
  exit(sendJson('false', array('data' => 'No about')));
}
if (!$_POST['parent_id']) {
  exit(sendJson('false', array('data' => 'No parent_id')));
}

$firstname = $_POST['firstname'];$lastname = $_POST['lastname'];$about = $_POST['about'];$parent_id=$_POST['parent id'];

$query = 'insert into person(firstname, lastname, about, parent_id) values(:firstname, :lastname, :about, :parent_id)`';

$stmt = $conn->prepare($query);

$stmt->bindValue(':firstname', $firstname);
$stmt->bindValue(':firstname', $firstname);
$stmt->bindValue(':about', $about);
$stmt->bindValue(':parent_id', $parent_id);

$stmt->execute();

if ($stmt->rowCount() > 0) {
  $info = getInfoByInfo($firstname, $lastname, $parent_id);

  $data;

  foreach ($info as $row) {
    $name = $row['firstname'];
    $lastname = $row['lastname'];
    $about = $row['about'];
    $id = $row['id'];

    $data = array('firstname' => $name, 'lastname' => $lastname, 'about' => $about, 'id' => $id);
  }

  echo sendJson('true', array('data' => $data));
} else {
  exit(sendJson('false', array('data' => 'no parent id')));
}


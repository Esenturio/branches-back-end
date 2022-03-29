<?php 

function getInfo($id, $name, $lastname, $about) {
  $arr = array();

  $arr['name'] = $name;
  $arr['lastname'] = $lastname;
  $arr['about'] = $about;
  $arr['id'] = $id;

  return $arr;
}


function getInfoById($id) {
  include_once('../settings/connection.php');

  $query = 'select * from abs_person where id=:id';

  $stmt = $conn->prepare($query);

  $stmt->bindValue(':id', $id);

  $stmt->execute();

  return $stmt;
}


function getInfoByInfo($firstname, $lastname, $parent_id) {
  include_once('../settings/connection.php');

  $query = 'select * from abs_person where firstname=:firstname and lastname=:lastname and parent_id=:parent_id';

  $stmt = $conn->prepare($query);

  $stmt->bindValue(':firstname', $firstname);
  $stmt->bindValue(':lastname', $lastname);
  $stmt->bindValue(':parent_id', $parent_id);

  $stmt->execute();

  return $stmt;
}

<?php 

if ($_GET['getPerson']) {
  include_once('./imports/getPerson.php');
} else if ($_POST['setPerson']) {
  include_once('./imports/setPerson.php');
}









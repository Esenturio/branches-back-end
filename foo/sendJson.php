<?php

function sendJson($success, $result) {
  return json_encode(array('success' => $success, 'result' => $result));
}
<?php

$data = json_decode(file_get_contents('php://input'));
if ($data) {
  include 'bot.php';
  return;
}
else {
  include 'views/main_view.html';
  return;
}

?>
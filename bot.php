<?php

include 'tables/ConfigTable.php';

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

class VKBotConfirm {
  private $confirmation_token;

  function __construct($confirmation_token) {
    $this->confirmation_token = $confirmation_token;
    $this->callbackConfirm();
  }

  public function callbackConfirm() {
    echo $this->confirmation_token;
  }
}


class VKBotRequestController {

  private $confirmation_token;
  private $access_token;
  private $data;

  function __construct($data, $confirmation_token, $access_token) {
    $this->data = $data;
    $this->confirmation_token = $confirmation_token;
    $this->access_token = $access_token;
  }

  public function run() {
    $confirm = false;
    switch ($this->data->type) { 
      //Если это уведомление для подтверждения адреса сервера... 
      case 'confirmation':
        new VKBotConfirm($this->confirmation_token);
        $confirm = true;
        break; 

      //Если это уведомление о новом сообщении... 
      case 'message_new':
        include 'bots/VKBotMessagesController.php';
        runMessageBot($this->data, $this->access_token);
        break;

    }
    if (!$confirm) {
      echo 'ok';
    }
  }

}

//Получаем и декодируем уведомление 
$data = json_decode(file_get_contents('php://input'));
// $data = $_GET;
if ($data) {
  $bot = new VKBotRequestController($data, '6fef10a5', 'dc102d4c63f9a4ff49c849ed1200a4cdf365e1c6489a2ced96a03d7cfb1c631d06e174085f48a90d8a04e');
  $bot->run();
}

?>
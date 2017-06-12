<?php 

class TelegramBot {

  public $token;

  function __construct($token) {
    $this->token = $token;
  }

  public function make_telegram_request($method, $params) {
    $api_url = "https://api.telegram.org/bot{$this->token}/{$method}?" . http_build_query($params);
    file_get_contents($api_url);
  }

  public function send_message($chat_id, $message) {
    self::make_telegram_request('sendMessage', array(
      "chat_id" => $chat_id,
      "text" => $message,
      "parse_mode" => "Markdown"
    ));
  }

}

?>
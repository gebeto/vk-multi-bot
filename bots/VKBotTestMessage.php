<?php 

class VKBotTestMessage {

  private $access_token;
  private $user_info;
  private $data;
  public $key_word = 'Hello';

  public function __construct($access_token, $data) {
    $this->access_token = $access_token;
    $this->data = $data;
  }

  public function setUserInfo($user_id) {
    $response = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&v=5.56"));
    $this->user_info = $response->response[0];
  }

  public function generateMessage() {
    $request_params = array( 
      'message' => "Йоу, {$this->user_info->first_name}! Вот твой ID {$this->user_info->id}.",
      'user_id' => $this->user_info->id,
      'access_token' => $this->access_token, 
      'v' => '5.64' 
    );
    $get_params = http_build_query($request_params);
    return $get_params;
  }

  public function sendMessage() {
    $response = file_get_contents('https://api.vk.com/method/messages.send?' . $this->generateMessage()); 
    return $response;
  }

  public function run() {
    $this->setUserInfo($this->data->user_id);
    $this->sendMessage();
  }

}

 ?>
<?php


class HelloWorldPlugin {

  private $access_token;
  private $data;
  public $key_word = 'Hello';

  public function __construct($data, $conf_token, $access_token) {
    $this->access_token = $access_token;
    $this->data = $data;
  }


  public function generateMessage() {
    $request_params = array(
      'message' => "Йоу! Hello world!",
      'user_id' => $this->data->object->user_id,
      'access_token' => $this->access_token, 
      'v' => '5.64' 
    );
    $get_params = http_build_query($request_params);
    return $get_params;
  }


  public function start() {
    file_get_contents('https://api.vk.com/method/messages.send?' . $this->generateMessage()); 
  }

}


PluginManager::registerPlugin(new HelloWorldPlugin($VK_CALLBACK, $CONFIRMATION_TOKEN, $ACCESS_TOKEN));


?>


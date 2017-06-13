<?php


class GroupJoinTelegramLog {

  private $access_token;
  private $data;

  public function __construct($data, $conf_token, $access_token) {
    $this->access_token = $access_token;
    $this->data = $data;
  }

  public function start() {
    $tb = new TelegramBot('302549573:AAGrJe_XGexvrHLm_m5q-VmBkBOH-rLoINM');
    $tb->send_message('@vkmultibot', "[{$this->data->object->user_id}](https://vk.com/id{$this->data->object->user_id}) вступил в [группу](https://vk.com/multi_bot)");
  }

}


PluginManager::registerPlugin(new GroupJoinTelegramLog($VK_CALLBACK, $CONFIRMATION_TOKEN, $ACCESS_TOKEN));


?>


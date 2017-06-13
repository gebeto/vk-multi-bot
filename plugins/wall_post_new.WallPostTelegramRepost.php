<?php


class WallPostTelegramRepost {

  private $access_token;
  private $data;

  public function __construct($data, $conf_token, $access_token) {
    $this->access_token = $access_token;
    $this->data = $data;
  }

  public function start() {
    $tb = new TelegramBot('302549573:AAGrJe_XGexvrHLm_m5q-VmBkBOH-rLoINM');
    $tb->send_message('@vkmultibot', "[{$this->data->object->from_id}](https://vk.com/id{$this->data->object->from_id}) создал [пост](https://vk.com/wall{$this->data->object->owner_id}_{$this->data->object->id}): \"{$this->data->object->text}\"");
  }

}


PluginManager::registerPlugin(new WallPostTelegramRepost($VK_CALLBACK, $CONFIRMATION_TOKEN, $ACCESS_TOKEN));


?>


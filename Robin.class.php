<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 15/10/29
 * Time: 下午11:02
 */

namespace dianjoy\batman;


use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version1X;

/**
 * Class Robin
 *
 * @author Meathill <lujia.zhai@dianjoy.com>
 * @package dianjoy\batman
 * @property Client socket
 */
class Robin {
  static $CACHE_PREFIX = 'robin-socket-';
  static $LIFE_TIME = 900;

  protected $socket;
  private $url;
  private $room;

  public function __construct($url, $auth, $room) {
    $this->url = $url;
    $this->room = $room;
    $this->auth = $auth;
    $this->apc_key = self::$CACHE_PREFIX . $url . $room;
    $this->has_cache = extension_loaded('apc');

    if ($this->has_cache && apc_exists($this->apc_key)) {
      $this->socket = apc_fetch($this->apc_key);
    } else {
      $url = $url . '?' . http_build_query([
        'auth' => $auth,
        'room' => $room,
      ]);
      $socket = $this->socket = new Client(new Version1X($url));
      $socket->initialize();
      if ($this->has_cache) {
        apc_add($this->apc_key, $this->socket, self::$LIFE_TIME);
      }
    }
  }

  public function log($data) {
    $this->socket->emit('log', ['content' => $data]);
  }

  public function release() {
    $this->socket->close();
    if ($this->has_cache) {
      apc_delete($this->apc_key);
    }
  }
}
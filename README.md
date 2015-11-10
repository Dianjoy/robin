# Robin

[Astinus](https://github.com/Dianjoy/astinus) 的PHP客户端，通过 [Elephant.io](http://elephant.io/) 与服务器建立WebSocket连接，然后发送日志。

## 需求

* PHP 5.3+
* elephant.io 3.0+
* Astinus
* NodeJS 4.0+
* [可选] [APC](http://php.net/manual/en/book.apc.php) 安装此组件可以在会话间共享robin实例，减少连接数

## 安装

### [composer](https://getcomposer.org)

修改 composer.json并且运行 <kbd>composer update</kbd> 即可。

    {
      "require": {
        "dianjoy/robin": "dev-master"
      }
    }
    
### 使用源码

参考 elephant.io 的[使用说明](http://elephant.io/#usage) 安装 elephant.io。

下载 robin 的代码到本地。

## 使用

使用composer依然很容易：

    require 'vendor/autoload.php';
    
    $robin = new Robin($url, $auth, $room);
    $robin->log('some thing');
    
没有composer的话，需要把第一句改成：

    require 'path/to/elephant.io/
    
### 连接参数

| 参数       | 说明 | 示例 |
|-----------|----------| ---------- |
| **$url**  | Astinus 服务的地址，如果不是80端口，需要包含端口 | http://www.dianjoy.com:3000/ |
| **$auth** | 用来校验权限的字符串，如果和服务器端不一致则无法链接 | `'dianjoy'` |
| **$room** | 房间名称，用于在查看时区分应用 | 'room' |

### `log`方法

通过日志输出点东西，参数可以为任意值，服务器端会按照JSON进行解析。

## 协议

[MIT](./LICENSE)



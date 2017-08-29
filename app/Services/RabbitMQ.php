<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 2017/8/29
 * Time: 16:18
 */

namespace App\Services;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Exception\AMQPConnectionException;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQ
{
    const EXCHANGE_TYPE_DIRECT = 'direct';

    const EXCHANGE_TYPE_FANOUT = 'fanout';

    const EXCHANGE_TYPE_TOPIC = 'topic';

    const EXCHANGE_TYPE_HEADER = 'header';

    const MESSAGE_DURABLE_YES = 2;

    const MESSAGE_DURABLE_NO = 1;

    private $_host = '127.0.0.1';

    private $_port = 5672;

    private $_user = 'guest';

    private $_password = 'guest';

    private $_vHost = '/';

    private $_connection = null;

    private $_queue = '';

    private $_exchange = 'stock';

    /**
     * 组件初始化
     */
    public function __construct($configFile = 'rabbit-stock')
    {
        $config = config($configFile);
        if (!empty($config)) {
            $this->_host = $config['host'];
            $this->_port = $config['port'];
            $this->_user = $config['user'];
            $this->_password = $config['password'];
            $this->_exchange = $config['exchange'];
        }

        //脚本退出前，关闭连接
        register_shutdown_function([$this, 'close']);
    }

    /**
     * 连接
     */
    public function connect()
    {
        $this->getConnect();
    }

    /**
     * 关闭连接
     */
    public function close()
    {
        if ($this->_isConnect()) {
            $this->_connection->close();
        }
    }

    /**
     * 设置默认 queue
     * @param $queue
     */
    public function setDefaultQueue($queue)
    {
        $this->_queue = $queue;

    }

    /**
     * 设置默认 exchange
     * @param $exchange
     */
    public function setDefaultExchange($exchange)
    {
        $this->_exchange = $exchange;
    }

    /**
     * 发布消息
     * @param $message
     * @param $queue
     * @param $exchange
     * @param bool $passive
     * @param bool $durable
     * @param bool $exclusive
     * @param string $type
     * @param bool $auto_delete
     * @return bool
     */
    public function publishMessage($message, $queue, $passive = false, $durable = true, $exclusive = false, $type = self::EXCHANGE_TYPE_DIRECT, $auto_delete = false)
    {
        $exchange = $this->_exchange;
        $newChannel = $this->getChannel();
        $newQueue = isset($queue) ? $queue : $this->_queue;
        $newExchange = $exchange;

        if ($this->_prepare($newChannel, $newQueue, $newExchange, $passive, $durable, $exclusive, $type, $auto_delete)) {
            $delivery_mode = ($durable) ? self::MESSAGE_DURABLE_YES : self::MESSAGE_DURABLE_NO;
            $msg = new AMQPMessage($message, array('content_type' => 'text/plain', 'delivery_mode' => $delivery_mode));
            $newChannel->basic_publish($msg, $exchange);
            $newChannel->close();
            return true;
        }
        $newChannel->close();
        return false;
    }

    /**
     * 拉取消息
     * @param $queue
     * @param $exchange
     * @param bool $passive
     * @param bool $durable
     * @param bool $exclusive
     * @param string $type
     * @param bool $auto_delete
     * @return bool
     */
    public function getMessage($queue, $passive = false, $durable = true, $exclusive = false, $type = self::EXCHANGE_TYPE_DIRECT, $auto_delete = false)
    {
        $exchange = $this->_exchange;
        $newChannel = $this->getChannel();
        $newQueue = isset($queue) ? $queue : $this->_queue;
        $newExchange = $exchange;
        $mix = false;

        if ($this->_prepare($newChannel, $newQueue, $newExchange, $passive, $durable, $exclusive, $type, $auto_delete)) {
            $msg = $newChannel->basic_get($queue);
            if ($msg) {
                $newChannel->basic_ack($msg->delivery_info['delivery_tag']);
                $mix = $msg->body;
            }
        }
        $newChannel->close();
        return $mix;
    }

    /**
     * @return bool
     */
    private function _isConnect()
    {
        if ($this->_connection && $this->_connection->isConnected()) {
            return true;
        }
        return false;
    }

    /**
     * @param $channel
     * @param $queue
     * @param $exchange
     * @param bool $passive
     * @param bool $durable
     * @param bool $exclusive
     * @param string $type
     * @param bool $auto_delete
     * @return bool
     */
    private function _prepare($channel, $queue, $exchange, $passive = false, $durable = true, $exclusive = false, $type = self::EXCHANGE_TYPE_DIRECT, $auto_delete = false)
    {

        if ($channel && is_a($channel, '\PhpAmqpLib\Channel\AMQPChannel')) {
            $channel->queue_declare($queue, $passive, $durable, $exclusive, $auto_delete);
            $channel->exchange_declare($exchange, $type, $passive, $durable, $auto_delete);
            $channel->queue_bind($queue, $exchange);
            return true;
        }
        return false;
    }

    /**
     * @param $host
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     * @param $port
     */
    public function setPort($port)
    {
        $this->_port = $port;
    }

    /**
     * @param $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @param $vHost
     */
    public function setVHost($vHost)
    {
        $this->_vHost = $vHost;
    }

    /**
     * @return AMQPChannel
     */
    public function getChannel()
    {
        return $this->getConnect()->channel();
    }


    /**
     * @return null|AMQPConnection
     */
    public function getConnect()
    {
        if (!$this->_isConnect()) {
            try {
                $this->_connection = new AMQPConnection($this->_host, $this->_port, $this->_user, $this->_password, $this->_vHost);
            } catch (\PhpAmqpLib\Exception\AMQPRuntimeException $e) {
                throw new \ErrorException('rabbitMQ server connect error', 500, 1);
            }
        }
        return $this->_connection;
    }

}
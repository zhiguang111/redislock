<?php

namespace lock\RedisLock;

use lock\Instance\Instance;

class RedisLock
{
    public $redis;

    public function __construct($host, $port, $password)
    {
        $redis = new \Redis();
        $redis->connect($host,$port);
        $redis->auth($password);
        $this->redis = $redis;
        return Instance::getInstance(self::class);

    }

    public function setLock($key, $data)
    {
       return $this->redis->setNx('aaa','bbb');
    }

    public function doEventRetry($key,callable $callable)
    {
        while (true) {
            if ($value = $this->redis->rPop($key)) {
                if (empty($value)) {
                    break;
                }
            }
            $callable();
        }
    }
}
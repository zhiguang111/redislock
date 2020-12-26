<?php

namespace lock\src\inc;


class RedisLock
{
    public $redis;

    public function __construct($host, $port, $password)
    {
        $redis = new \Redis();
        $redis->connect($host,$port);
        $redis->auth($password);
        $this->redis = $redis;

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
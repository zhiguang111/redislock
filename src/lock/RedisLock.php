<?php

namespace lock\RedisLock;

class RedisLock
{
    public $redis;

    public function __construct()
    {
        $self = Instance::getInstance(self::class);
        $self->redis = new Redis();
        $self->redis = $self->redis->connect('127.0.0.1',6379,30);
    }

    public function setLock()
    {
        $res = $this->redis->setNx('aaa','bbb');
    }
}
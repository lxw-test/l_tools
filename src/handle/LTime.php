<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/9/25
 * Time: 10:24
 */
namespace handle;

class LTime
{
    /**
     * 获取13位时间戳
     * @return float
     */
    public function get_microtime13()
    {
        return round(microtime(true) * 1000);
    }
}
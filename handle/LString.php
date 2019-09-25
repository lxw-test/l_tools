<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/9/25
 * Time: 10:21
 */

namespace handle;

class LString
{
    /**
     * 对象转数组
     * @param $data
     * @return mixed
     */
    public function object_to_array($data)
    {
        return json_decode(json_encode($data), true);
    }

    /**
     * 获取随机数数组
     * @param int $num 取值数量
     * @param int $min_num 随机最小值
     * @param int $max_num 随机最大值
     * @param bool $type 是否重复
     * @return array
     */
    public function get_rand_by_num($num, $min_num = 0, $max_num = 100, $type = false)
    {
        if($num > ($max_num - $min_num) && !$type)
        {
            $num     = 4;
            $min_num = 0;
            $max_num = $num + 200;
        }
        $rand_num   = array();
        while(1)
        {
            $temp_num = rand($min_num,$max_num);
            if (in_array($temp_num, $rand_num) && !$type)
            {
                continue;
            }
            $rand_num[] = $temp_num;
            if(count($rand_num) == $num)
            {
                break;
            }
        };
        return $rand_num;
    }

    /**
     * 过滤连续空格
     * @param $message
     */
    public function removeDoubleSpace($message) {
        $message = preg_replace_callback(
            '  ',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $message);

        return $message;
    }

    /**
     * 过滤emoji
     * @param $message
     * @return string|string[]|null
     */
    public function removeEmoji($message) {
        $message = preg_replace_callback(
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $message);

        return $message;
    }
}
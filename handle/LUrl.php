<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/9/25
 * Time: 10:30
 */
namespace handle;

class LUrl
{
    /**
     * 拼接url字段
     * @param $url
     * @param $get
     * @return string
     */
    public function CombinationUrl($url, $get)
    {
        $url .= '?';
        foreach ($get as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }
            $url .= $key . '=' . urlencode($value) . '&';
        }
        $url = rtrim($url, '&');
        return $url;
    }

    /**
     * 远程异步请求 不获取内容
     * @param $url
     */
    public function _sock($url)
    {
        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $port = $port ? $port : 80;
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        if ($query) $path .= '?' . $query;
        if ($scheme == 'https') {
            $host = 'ssl://' . $host;
        }

        $fp = fsockopen($host, $port, $error_code, $error_msg, 1);
        if (!$fp) {
            return;
        }else {
            //开启非阻塞模式
            stream_set_blocking($fp, true);
            //设置超时
            stream_set_timeout($fp, 1);
            $header = "GET $path HTTP/1.1\r\n";
            $header .= "Host: $host\r\n";
            $header .= "Connection: close\r\n\r\n";//长连接关闭
            fwrite($fp, $header);
            usleep(1000);
            fclose($fp);
            return;
        }
    }

}
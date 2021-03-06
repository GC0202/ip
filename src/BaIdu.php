<?php

// +----------------------------------------------------------------------
// | IP数据库
// +----------------------------------------------------------------------
// | 版权所有 2017~2020 [ https://www.dtapp.net ]
// +----------------------------------------------------------------------
// | 官方网站: https://gitee.com/liguangchun/ip
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | gitee 仓库地址 ：https://gitee.com/liguangchun/ip
// | github 仓库地址 ：https://github.com/GC0202/ip
// | Packagist 地址 ：https://packagist.org/packages/liguangchun/ip
// +----------------------------------------------------------------------

namespace DtApp\Ip;

use DtApp\Curl\CurlException;

/**
 * 百度
 * Class BaIdu
 * @package LiGuAngChUn\Ip
 */
class BaIdu extends BasicIp
{
    /**
     * 百度地图
     * http://lbsyun.baidu.com/index.php?title=webapi/ip-api
     * @param string $ip 用户上网的IP地址，参数如果不出现或为空，会针对发来请求的IP进行定位
     * @param string $coor 经纬度的坐标类型  coor = bd09ll：百度经纬度坐标，在国测局坐标基础之上二次加密而来、coor = gcj02：国测局02坐标，在原始GPS坐标基础上，按照国家测绘行业统一要求，加密后的坐标
     * @return bool|mixed|string
     * @throws CurlException
     * @throws IpException
     */
    public function getMap(string $ip = '', string $coor = 'bd09ll')
    {
        if (empty($this->config->get('bd_dt_key'))) throw new IpException('开发者密钥不能为空');
        if (empty($ip)) $ip = $this->getIp();
        $url = "https://api.map.baidu.com/location/ip?ak={$this->config->get('bd_dt_key')}&coor={$coor}";
        if (!empty($ip)) $url = "https://api.map.baidu.com/location/ip?ak={$this->config->get('bd_dt_key')}&ip={$ip}&coor={$coor}";
        return $this->getHttp($url, '', true);
    }

    /**
     * 百度搜索
     * @param string $ip IP地址
     * @return bool|false|mixed|string|string[]
     * @throws CurlException
     */
    public function getSearch(string $ip = '')
    {
        if (empty($ip)) $ip = $this->getIp();
        $url = "https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?query={$ip}&co=&resource_id=6006&ie=utf8&oe=utf8&cb=json";
        $res = $this->getHttp($url, '', false);
        $res = str_replace("/**/json", "", $res);
        $res = substr($res, 1);
        $res = substr($res, 0, -2);
        $res = json_decode($res, true);
        return $res;
    }
}

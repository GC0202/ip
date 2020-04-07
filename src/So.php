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
 * 好搜
 * Class So
 * @package DtApp\Ip
 */
class So extends BasicIp
{
    /**
     * 好搜
     * @param string $ip IP地址
     * @return bool|mixed|string
     * @throws CurlException
     */
    public function getOneBox(string $ip = '')
    {
        if (empty($ip)) $ip = $this->getIp();
        $url = "https://open.onebox.so.com/dataApi?type=ip&src=onebox&tpl=0&num=1&query=ip&ip={$ip}&url=ip";
        return $this->getHttp($url, '', true);
    }
}

<?php

namespace App\Enums;


class CodeEnum extends Enum
{
    const SUCCESS            = [0,'success'];
    const ERROR_UNKNOW       = [1000,'未知错误'];
    const ERROR_SERVER       = [1001,'服务器错误'];
    const ERROR_MISS_PARAM   = [1002,'缺少参数'];
    const ERROR_NO_RECORD    = [1003,'记录不存在'];
    const ERROR_LOGIN        = [2000,'请先登录'];
    const ERROR_NO_AUTH      = [2001,'账号或密码不正确'];
}

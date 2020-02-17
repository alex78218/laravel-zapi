<?php

namespace App\Enums;


class CodeEnum
{
    const SUCCESS           = [0,'success'];
    const E_UNKNOW          = [1000,'未知错误'];
    const E_SERVER          = [1001,'服务器错误'];
    const E_MISS_PARAM      = [1002,'缺少参数'];
    const E_NO_RECORD       = [1003,'记录不存在'];
}

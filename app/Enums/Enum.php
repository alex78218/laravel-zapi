<?php

namespace App\Enums;


class Enum
{
    /**
     * 获取常量列表
     * @return array
     * @throws \ReflectionException
     */
    public static function getList()
    {
        $ref = new \ReflectionClass(get_called_class());
        $list = [];
        foreach($ref->getConstants() as $k=>$v){
            $list[$v[0]] = $v[1];
        }
        return $list;
    }
}

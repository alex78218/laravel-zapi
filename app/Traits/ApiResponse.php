<?php

namespace App\Traits;


use App\Enums\CodeEnum;

Trait ApiResponse
{
    public function pageData($paginator)
    {
        $page = $paginator->toArray();
        return [
            'total'         => $page['total'],
            'current_page'  => $page['current_page'],
            'per_page'      => $page['per_page'],
            'list'          => $page['data']
        ];
    }

    public function success($data,$codeEnum=CodeEnum::SUCCESS)
    {
        $back = [
            'code' => $codeEnum[0],
            'msg'  => $codeEnum[1],
            'data' => $data
        ];
        return response()->json($back);
    }

    public function error($data,$codeEnum=CodeEnum::E_UNKNOW)
    {
        $back = [
            'code' => $codeEnum[0],
            'msg'  => $codeEnum[1],
            'data' => $data
        ];
        return response()->json($back);
    }
}
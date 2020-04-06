<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CodeEnum;
use App\Exceptions\ApiException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends BaseController
{
    public function upload(Request $request)
    {
        $files = $request->file();
        $data = [];
        $pos = 0;
        foreach($files as $file){
            $pos++;
            if($file->isValid()){
                //$filename = $file->getClientOriginalName();
                $path = Storage::putFile('article',$file);
                $data[] = ['pos'=>$pos, 'url'=>config('app.url').Storage::url($path)];
            }
        }
        return $this->success($data);
    }
}

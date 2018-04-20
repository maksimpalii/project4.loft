<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function clearAll($dataIn, $isArray = false)
    {
        if ($isArray === false) {
            $data_ = strip_tags($dataIn);
            $data = htmlspecialchars($data_, ENT_QUOTES);
        } else {
            $data = [];
            foreach ($dataIn as $key => $value) {
                $data[$key] = htmlspecialchars(strip_tags($value), ENT_QUOTES);
            }
        }
        return $data;
    }
}

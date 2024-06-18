<?php

namespace App\Lib;

class Response
{
    private $status = 302;

    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }
}
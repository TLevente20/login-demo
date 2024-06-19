<?php namespace App;


class Response
{
    private $status = 200;

    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }
}
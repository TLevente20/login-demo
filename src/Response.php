<?php namespace App;


class Response
{
    private $status = 200;

    //Retrun the status code 
    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }
}
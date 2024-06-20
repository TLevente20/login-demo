<?php namespace App;


class Response
{
    //Retrun the status code 
    private $status = 200;

    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }
}
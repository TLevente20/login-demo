<?php namespace App;

use Error;

class Request
{
    public $params;
    public $reqMethod;
    public $contentType;

    //Construct the request with the relevant informations
    public function __construct($params = [])
    {

        $this->params = $params;
        $this->reqMethod = trim($_SERVER["REQUEST_METHOD"]);
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    //In case of POST request, get the additional data from the request
    public function getBody()
    {
        if ($this->reqMethod !== 'POST') {
            return '';
        }

        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = $value;
        }
        
        return $body;
    }
}
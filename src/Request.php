<?php namespace App;

class Request
{
    public $params;
    public $reqMethod;
    public $contentType;

    public function __construct($params = [])
    {

        $this->params = $params;
        $this->reqMethod = trim($_SERVER["REQUEST_METHOD"]);
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    public function getBody()
    {
        if ($this->reqMethod !== 'POST') {
            return '';
        }

        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }
}
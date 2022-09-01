<?php

namespace App\Http;

class Response
{
    private $httpCode = 200;
    private $headers = [];
    private $contentType = 'application/json; charset=UTF-8';
    private $access = '*';
    private $accessCred = 'true';
    private $accessPost = 'GET, POST, OPTIONS, PATCH, PUT';
    private $accessHeaders = 'Content-Type, Authorization, X-Request-With';
    private $content;

    public function __construct ($httpCode, $content, $contentType = 'application/json; charset=UTF-8', $access = '*', $accessPost = 'GET, POST, OPTIONS, PATCH, PUT', $accessHeaders = 'Content-Type, Authorization, X-Request-With', $accessCred = 'true')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType, $access, $accessPost, $accessHeaders, $accessCred);
    }

    public function setContentType ($contentType, $access, $accessPost, $accessHeaders, $accessCred)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
        $this->addHeader('Access-Control-Allow-Origin', $access);
        $this->addHeader('Access-Control-Allow-Methods', $accessPost);
        $this->addHeader('Access-Control-Allow-Headers', $accessHeaders);
        $this->addHeader('Access-Control-Allow-Credentials', $accessCred);
    }

    public function addHeader ($key, $value)
    {
        $this->headers[$key] = $value;
    }

    private function sendHeaders ()
    {
        http_response_code($this->httpCode);

        foreach ($this->headers as $key=>$value) {
            header($key.': '.$value);
        }
    }

    public function sendReponse ()
    {
        $this->sendHeaders();
        switch ($this->contentType) {
            case 'application/json; charset=UTF-8':
                echo $this->content;
                exit;
        }
    }
}
<?php

namespace Core;

class Request
{
    /**
     * @var false|string
     */
    public $url;

    /**
     * Request constructor.
     */
    public function __construct(){
        $this->url = substr($_SERVER['REQUEST_URI'], 1);
    }
}
<?php

/*
 * This file is part of the yuki package.
 * Copyright (c) 2011 olamedia <olamedia@gmail.com>
 *
 * This source code is release under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace yuki;

/**
 * request
 *
 * @package yuki
 * @subpackage request
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class request{
    public $server = null;
    public $headers = null;
    public $get = null;
    public $post = null;
    public function __construct(){
        $this->server = new registry();
        $this->headers = new headersRegistry();
        $this->headers->load($this->server);
        $this->get = new registry();
        $this->post = new registry();
    }
    public function loadFromEnvironment(){
        $this->server->load($_SERVER);
        $this->get->load($_GET);
        $this->post->load($_POST);
    }
    public static function fromEnvironment(){
        $request = new self();
        $request->loadFromEnvironment();
        return $request;
    }
    public function isCli(){
        return (PHP_SAPI == 'cli');
    }
    public function getMethod($default = null){
        return $this->server->get('REQUEST_METHOD', $default);
    }
    public function isGet(){
        return $this->getMethod() == 'GET';
    }
    public function isPost(){
        return $this->getMethod() == 'POST';
    }
    public function isPut(){
        return $this->getMethod() == 'PUT';
    }
    public function isDelete(){
        return $this->getMethod() == 'DELETE';
    }
    public function isAjax(){
        return 'XMLHttpRequest' == $this->headers->get('X-Requested-With');
    }
    public function getReferer($default = false){
        return $this->server->get('HTTP_REFERER', $default);
    }
    public function getUseragent($default = ''){
        return $this->server->get('HTTP_USER_AGENT', $default);
    }
    public function getIp($default = ''){
        // 1. REMOTE_ADDR - default
        // 2. X-Forwarded-For - proxy
        // 3. HTTP_X_FORWARDED_FOR - proxy 
        return $this->server->get(array('HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'), $default);
    }
    public function getRequestUriString($default = ''){
        return $this->server->get(array(
                    'DOCUMENT_URI', // nginx SSI REQUEST_URI = /
                    'REQUEST_URI' // common key
                        ), $default
        );
    }
    /**
     * Get domain name
     * @return string Domain name
     */
    public function getServerName($default = ''){
        return $this->getServerParameter(array(
                    'HTTP_HOST', // From Host: HTTP header
                    'SERVER_NAME' // From server_name directive
                        ), $default
        );
    }
    /**
     * Get domain name, !excluding www. prefix
     * @return string Domain name
     */
    public function getDomainName(){
        $n = $this->getServerName();
        if (strpos($n, 'www.') === 0){
            return substr($n, 4);
        }
        return $n;
    }
}


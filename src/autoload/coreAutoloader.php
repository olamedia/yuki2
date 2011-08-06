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
 * coreAutoloader
 *
 * @package yuki
 * @subpackage autoload
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class coreAutoloader extends autoloader{
    protected static $_instance = null;
    /**
     * @internal
     * @var array
     */
    protected $_classes = array(
        'autoloader'=>'autoload/autoloader.php',
        'console'=>'console/console.php',
        'coreAutoloader'=>'autoload/coreAutoloader.php',
        'exception'=>'exception/exception.php',
        'headersRegistry'=>'request/headersRegistry.php',
        'registry'=>'registry/registry.php',
        'request'=>'request/request.php',
        'trackingRegistry'=>'registry/trackingRegistry.php',
        'yuki'=>'yuki/yuki.php',
    );
    protected function __construct(){
        $this->_locationPrefix = realpath(dirname(__FILE__).'/..').'/';
    }
    /**
     *
     * @return coreAutoloader
     */
    public static function getInstance(){
        if (self::$_instance === null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    /**
     * Rebuilds the association array between class names and paths.
     * Idea (to rebuild self) taken from Symfony sfCoreAutoload
     *
     * @internal
     * @param string $path
     * @param boolean $finalize
     */
    public function rebuild($path = '', $finalize = true){
        if ($finalize){
            ob_implicit_flush(true);
            echo "Rebuilding coreAutoloader...\n";
            $this->_classes = array();
        }
        $locationPrefix = substr($path, 0, strlen($path) - 1).'/';
        $searchpath = realpath(dirname(__FILE__).'/..').'/'.$path;
        foreach (glob($searchpath.'*', GLOB_NOSORT) as $filename){
            $name = basename($filename);
            if (is_dir($filename)){
                $this->rebuild($path.$name.'/', false);
            }elseif (is_file($filename)){
                //if ($name{0} == 'y'){
                $ext = end(explode('.', $name));
                if ($ext === 'php'){
                    $class = reset(explode('.', $name));
                    $this->add(array($class=>$name), $locationPrefix);
                }
                //}
            }
        }
        if (!$finalize){
            return;
        }
        ksort($this->_classes);
        $classesString = 'protected $_classes = array('."\n";
        foreach ($this->_classes as $k=>$v){
            $classesString .= "        '".$k."'=>'".$v."',\n";
        }
        $classesString .= "    );";
        $contents = file_get_contents(__FILE__);
        $contents = preg_replace("#(protected\s+\\\$_classes\s*=\s*array\([^)]*\);)#ims", $classesString, $contents);
        file_put_contents(__FILE__, $contents);
        echo "Finished.\n";
    }
}


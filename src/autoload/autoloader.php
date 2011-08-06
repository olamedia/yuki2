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
 * autoloader - implementation for __autoload()
 * 
 * @package yuki
 * @subpackage autoload
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class autoloader{
    protected $_locationPrefix = '';
    protected $_classes = array();
    public function getClassPath($class){
        if (isset($this->_classes[$class])){
            return $this->_locationPrefix.$this->_classes[$class];
        }
        return false;
    }
    /**
     * Register given classes within current autoloader.
     * @param array $classes
     * @param string $locationPrefix 
     */
    public function add($classes, $locationPrefix = ''){
        foreach ($classes as $class=>$location){
            $this->_classes[$class] = $locationPrefix.$location;
        }
    }
    /**
     * Handles autoloading of classes.
     * @param string $class A class name.
     * @return boolean Returns true if the class has been loaded
     */
    public function autoload($class){
        console::info('autoloading '.$class);
        if (($p = strrpos($class, '\\'))){
            $ns = substr($class, 0, $p);
            $class = substr($class, $p + 1);
            console::info('ns: '.$ns);
            console::info('class: '.$class);
            if ($ns !== 'yuki'){
                return false;
            }
        }
        if (($path = $this->getClassPath($class))){
            console::info($path);
            require $path;
            return true;
        }
        return false;
    }
}


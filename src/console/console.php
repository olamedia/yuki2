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
 * console
 *
 * @package yuki
 * @subpackage console
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class console{
    public static function log($message){
        echo $message;
        echo "\n";
    }
    public static function error($message){
        echo 'Error: ';
        echo $message;
        echo "\n";
    }
    public static function info($message){
        echo 'Info: ';
        echo $message;
        echo "\n";
    }
}


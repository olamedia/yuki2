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
 * yuki
 *
 * @package yuki
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yuki{
    public static function run($controller = 'defaultController'){
        $request = request::fromEnvironment();
        var_dump($request);
    }
}


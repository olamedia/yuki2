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
 * headersRegistry
 *
 * @package yuki
 * @subpackage request
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class headersRegistry extends registry{
    protected function _normalizeKey($key){
        if (!is_string($key)){
            $key = strval($key);
        }
        $key = 'HTTP_'.strtoupper(strtr($key, '-', '_'));
        return $key;
    }
}


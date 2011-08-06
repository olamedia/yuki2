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

date_default_timezone_set('Asia/Yekaterinburg');

require_once __DIR__.'/../src/console/console.php';
require_once __DIR__.'/../src/autoload/autoloader.php';
require_once __DIR__.'/../src/autoload/coreAutoloader.php';
\spl_autoload_register(array(coreAutoloader::getInstance(), 'autoload'));

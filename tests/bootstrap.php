<?php

/**
 * This file is part of PicaWriter.
 *
 * PicaWriter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PicaWriter is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PicaWriter.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    David Maus <maus@hab.de>
 * @copyright Copyright (c) 2013 by Herzog August Bibliothek Wolfenbüttel
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License v3
 */

require_once realpath(__DIR__ . '/../vendor/autoload.php');

define('PHPUNIT_FIXTURES', realpath(__DIR__ . '/fixtures'));

$loader = new Composer\Autoload\ClassLoader();
$loader->add('HAB', realpath(__DIR__ . '/src'));
$loader->register();

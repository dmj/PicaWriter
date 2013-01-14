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
 * @package   PicaWriter
 * @author    David Maus <maus@hab.de>
 * @copyright Copyright (c) 2012, 2013 by Herzog August Bibliothek Wolfenbüttel
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License v3
 */

namespace HAB\Pica\Writer;

use HAB\Pica\Record\Record;
use HAB\Pica\Record\Field;

abstract class Writer {

    /**
     * True if occurrence of 0 should be ommited in the output.
     *
     * @var boolean
     */
    protected $_omitOccurrenceIfZero = true;

    /**
     * Write the record.
     *
     * An implementing class SHOULD either return the written record or a
     * boolean true if the record was successfully written to an output stream
     * or buffer.
     *
     * @param  Record $record The Pica+ record to write
     * @return string|boolean
     */
    abstract public function write (Record $record);

    /**
     * Write a single Pica+ field.
     *
     * @param  Field $field The Pica+ field to write
     * @return string|boolean
     */
    abstract public function writeField (Field $field);
}
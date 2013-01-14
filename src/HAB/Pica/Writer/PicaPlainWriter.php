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

use HAB\Pica\Record\Subfield;
use HAB\Pica\Record\Record;
use HAB\Pica\Record\Field;

class PicaPlainWriter extends Writer
{

    /**
     * Newline characters to separate fields.
     *
     * @var string
     */
    const NEWLINE = "\r\n";

    /**
     * Return the written PicaPlain record.
     *
     * @see Writer::write()
     *
     * @param  Record $record Record to write
     * @return string
     */
    public function write (Record $record)
    {
        return implode($this->getNewline(), array_map(array($this, 'writeField'), $record->getFields()));
    }

    /**
     * Return a field encoded in PicaPlain.
     *
     * @param  Field The Pica+ field
     * @return string
     */
    public function writeField (Field $field)
    {
        $line = $field->getTag();
        if ($field->getOccurrence() != 0 || !$this->_omitOccurrenceIfZero) {
            $line .= sprintf('/%02d', $field->getOccurrence());
        }
        return $line . ' ' . implode('', array_map(array($this, 'writeSubfield'), $field->getSubfields()));
    }

    /**
     * Return a subfield encoded in PicaPlain.
     *
     * @param  Subfield $subfield The Pica+ subfield
     * @return string
     */
    protected function writeSubfield (Subfield $subfield) {
        return '$' . $subfield->getCode() . str_replace('$', '$$', $subfield->getValue());
    }

    /**
     * Return the writer's newline characters to separate fields.
     *
     * This currently always returns the constant PicaPlainWriter::NEWLINE.
     *
     * @return string Newline character(s)
     */
    public function getNewline() {
        return self::NEWLINE;
    }

}
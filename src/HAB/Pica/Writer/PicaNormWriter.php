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

namespace HAB\Pica\Writer;

class PicaNormWriter extends Writer
{
    /**
     * Separators.
     *
     * @var string
     */
    const FIELD_SEPARATOR    = "\x1e";
    const RECORD_SEPARATOR   = "\x1d";
    const SUBFIELD_SEPARATOR = "\x1f";

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
    public function write (Record $record)
    {
        $buffer = self::RECORD_SEPARATOR;
        foreach ($record->getFields() as $field) {
            $buffer .= $this->writeField($field);
        }
        $buffer;
    }

    /**
     * Write a single Pica+ field.
     *
     * @param  Field $field The Pica+ field to write
     * @return string|boolean
     */
    public function writeField (Field $field)
    {
        $buffer  = self::FIELD_SEPARATOR;
        $buffer .= $field->getTag();
        if ($field->getOccurrence()) {
            $buffer .= sprintf('%02d', $field->getOccurrence());
        }
        $buffer .= ' ' . self::SUBFIELD_SEPARATOR;
        foreach ($field->getSubfields() as $subfield) {
            $buffer .= self::SUBFIELD_SEPARATOR . $subfield->getCode() . $subfield->getValue();
        }
        return $buffer;
    }
}
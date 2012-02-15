<?php

/**
 * The Writer class file.
 *
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
 * @copyright Copyright (c) 2012 by Herzog August Bibliothek Wolfenbüttel
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License v3
 */

namespace HAB\Pica\Writer;

/**
 * Abstract base class of Pica+ writers.
 *
 * @package   PicaWriter
 * @author    David Maus <maus@hab.de>
 * @copyright Copyright (c) 2012 by Herzog August Bibliothek Wolfenbüttel
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License v3
 */
abstract class Writer {

  /**
   * TRUE if occurrence of 0 should be ommited in the output.
   *
   * @var boolean
   */
  protected $_omitOccurrenceIfZero = true;

  /**
   * Write the record.
   *
   * An implementing class SHOULD either return the written record or a
   * boolean TRUE if the record was successfully written to an output stream
   * or buffer.
   *
   * @param  \HAB\Pica\Record\Record $record The Pica+ record to write
   * @return string|boolean Written record or TRUE if record was written to
   *         output stream or buffer
   */
  abstract public function write (\HAB\Pica\Record\Record $record);

}
<?php

/**
 * Unit test for the PicaXmlWriter class.
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
 * @copyright Copyright (c) 2012, 2013 by Herzog August Bibliothek Wolfenbüttel
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License v3
 */

namespace HAB\Pica\Writer;

use HAB\Pica\Record\TitleRecord;
use HAB\Pica\Record\Field;
use HAB\Pica\Record\Subfield;

use PHPUnit_FrameWork_TestCase;

class PicaXmlWriterTest extends PHPUnit_FrameWork_TestCase
{

    protected $_writer;

    public function SetUp ()
    {
        $this->_writer = new PicaXmlWriter();
    }

    public function testWrite ()
    {
        $r = new TitleRecord(array(new Field('003@', 0, array(new Subfield('0', 'something')))));
        $xml = $this->_writer->write($r);
        $this->assertEquals('<pica:record xmlns:pica="info:srw/schema/5/picaXML-v1.0"><pica:datafield tag="003@"><pica:subfield code="0">something</pica:subfield></pica:datafield></pica:record>', $xml);
    }

    public function testWriteField ()
    {
        $f = new Field('003@', 0, array(new Subfield('0', 'something')));
        $xml = $this->_writer->writeField($f);
        $this->assertInternalType('string', $xml);
    }
}
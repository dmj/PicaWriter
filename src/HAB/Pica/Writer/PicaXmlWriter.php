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
use XMLWriter;

class PicaXmlWriter extends Writer
{

    /**
     * XML namespace URI of PicaXML.
     *
     * @var string
     */
    const PICAXML_NAMESPACE_URI = 'info:srw/schema/5/picaXML-v1.0';

    /**
     * XML namespace prefix for PicaXML tags.
     *
     * Defaults to 'pica'.
     *
     * @var string
     */
    protected $_namespacePrefix = 'pica';

    /**
     * The XMLWriter instance.
     *
     * @var XMLWriter
     */
    protected $_xmlWriter;

    /**
     * Return record encoded in PicaXML.
     *
     * @see Writer::write()
     *
     * @param  Record $record Record to write
     * @return string
     */
    public function write (Record $record)
    {
        $writer = $this->getXmlWriter();
        $nsPrefix = $this->getNamespacePrefix();
        $writer->startElementNS($nsPrefix, 'record', self::PICAXML_NAMESPACE_URI);
        foreach ($record->getFields() as $field) {
            $this->writeField($field, $writer);
        }
        $writer->endElement();
        return $writer->flush();
    }

    /**
     * Return field encoded in PicaXML.
     *
     * @see Writer::writeField()
     *
     * @param  Record    $record    Record to write
     * @param  XMLWriter $outbuf    XML Writer instance acting as output buffer
     * @param  boolean   $declareNS Declare PicaXML namespace if set to TRUE
     * @return string
     */
    public function writeField (Field $field, XMLWriter $outbuf = null, $declareNS = false)
    {
        $writer = $outbuf ?: $this->getXmlWriter();

        if ($declareNS) {
            $writer->startElementNS($this->getNamespacePrefix(), 'datafield', self::PICAXML_NAMESPACE_URI);
        } else {
            $writer->startElement($this->getQualifiedName('datafield'));
        }

        $writer->writeAttribute('tag', $field->getTag());
        if ($field->getOccurrence() != 0 || !$this->_omitOccurrenceIfZero) {
            $writer->writeAttribute('occurrence', sprintf('%02d', $field->getOccurrence()));
        }
        foreach ($field->getSubfields() as $subfield) {
            $writer->startElement($this->getQualifiedName('subfield'));
            $writer->writeAttribute('code', $subfield->getCode());
            $writer->text($subfield->getValue());
            $writer->endElement();
        }
        $writer->endElement();
        return !!$outbuf ?: $writer->flush();
    }

    /**
     * Return the XMLWriter instance or create a new one.
     *
     * @return XMLWriter
     */
    public function getXmlWriter ()
    {
        if (!$this->_xmlWriter) {
            $writer = new XMLWriter();
            $writer->openMemory();
            $this->setXmlWriter($writer);
        }
        return $this->_xmlWriter;
    }

    /**
     * Return the namespace prefix for PicaXML tags.
     *
     * @return string|null
     */
    public function getNamespacePrefix ()
    {
        return $this->_namespacePrefix;
    }

    /**
     * Set the namespace prefix for PicaXML tags.
     *
     * To use the default namespace set the namespace prefix to NULL.
     *
     * @param  string $nsPrefix Namespace prefix
     * @return void
     */
    public function setNamespacePrefix ($nsPrefix)
    {
        $this->_namespacePrefix = $nsPrefix;
    }

    /**
     * Set the XMLWriter instance to be used to write XML record.
     *
     * @param  XMLWriter $xmlWriter XMLWriter instance
     * @return void
     */
    protected function setXmlWriter (XMLWriter $xmlWriter)
    {
        $this->_xmlWriter = $xmlWriter;
    }

    /**
     * Return the qualified name of a XML tag.
     *
     * @param  string $lname XML local name of the tag
     * @return string
     */
    protected function getQualifiedName ($lname)
    {
        $nsPrefix = $this->getNamespacePrefix();
        return $nsPrefix ? "{$nsPrefix}:{$lname}" : $lname;
    }
}
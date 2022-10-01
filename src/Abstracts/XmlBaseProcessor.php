<?php
namespace Bookstore\Abstracts;

abstract class XmlBaseProcessor {
    protected $xmlString;

    public function __construct($xmlString)
    {
        $this->xmlString = $xmlString;
    }

    public function getContents()
    {
        if (!empty($this->xmlString)) {
            return new \SimpleXMLElement($this->xmlString);
        }

        return false;
    }
}
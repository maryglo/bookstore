<?php
namespace Bookstore\Processors;

require 'src/Abstracts/XmlBaseProcessor.php';
use Bookstore\Abstracts\XmlBaseProcessor;

class BookXmlProcessor extends XmlBaseProcessor {
    public function __construct($xmlString)
    {
        parent::__construct($xmlString);
    }

    /**
     * Get books from xml
     */
    public function getBooks(): array
    {
        $books = [];
        $contents = $this->getContents();

        if ($contents) {
            foreach($contents->book as $book) {
                $author = (string) $book->author;
                $books[$author][] = (string) $book->name;
            }
        }

        return $books;
    }
}
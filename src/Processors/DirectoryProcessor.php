<?php
namespace Bookstore\Processors;

require 'src/Processors/BookXmlProcessor.php';
use Bookstore\Processors\BookXmlProcessor;

class DirectoryProcessor {

    public function __construct()
    {

    }

    public function getDirectoryAndFiles(string $dir, &$contents = []): array
    {
        $dh = new \DirectoryIterator($dir);
        foreach ($dh as $item) {
            if (!$item->isDot()) {
               if ($item->isDir()) {
                    $this->getDirectoryAndFiles("$dir/$item", $contents);
               } else if (pathinfo($dir . "/" . $item->getFilename(), PATHINFO_EXTENSION) === 'xml'){
                    $string = file_get_contents($dir . "/" . $item->getFilename());
                    $authors = new BookXmlProcessor($string);
                    $contents[] = $authors->getBooks();
               }
            }
        }

        return $contents;
    }
}
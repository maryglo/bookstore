# Project Description

This is test project to test PHP skills. There is a tree of start folder, it's subfolders, their subfolders, etc. In each folder, subfolder, etc. there are the same structured XML files stored.

Example:

<books>
    <book>
        <author>Isak Azimov</author>
        <name>End of spirit</name>
    </book>
    <book>
        <author>3</author>
        <name>Standard</name>
    </book>
</books>

## How to test

1. Database 'bookstore' with two tables, books and authors should be created. (use 1:many and unique author’s ID as link between the tables).

2. Run /importer.php file to import data from xml files.

3. To view the list, got to / .
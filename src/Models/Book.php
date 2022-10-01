<?php
namespace Bookstore\Model;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book {
    protected $table = 'books';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'author_id'];
}
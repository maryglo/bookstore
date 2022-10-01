<?php
namespace Bookstore\Model;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Author {
    protected $table = 'authors';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
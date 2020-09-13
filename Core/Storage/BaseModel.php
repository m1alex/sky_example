<?php

namespace Core\Storage;

/**
 * @class Core\Storage\BaseModel
 * 
 * base model class
 */
abstract class BaseModel
{
    /** @var SQLite3 connection */
    protected $_conn;
    
    /** @var int id */
    protected $_id; // for found object
    
    /**
          * class constructor
          */
    function __construct()
    {
        $this->_conn = new \SQLite3('../db/sky.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
    }
    
    /**
          * find item by id
          * 
          * @param int $id
          */
    abstract public function find(int $id);
    
    
    /**
          * create new item
          *
          * @param array $attributes
          */
    abstract public function create(array $attributes);
}

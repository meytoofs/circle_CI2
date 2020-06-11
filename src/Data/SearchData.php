<?php

namespace App\Data;

class SearchData
{

     /**
     * @var bolean
     */
    public $tri=false ;



    /**
     * @var int
     */
    public $page = 1;
    /**
     * @var string
     */
    public $q = '';
    /**
     * @var null|integer
     */
    public $max;

    /**
     * @var null|integer
     */
    public $min;
}
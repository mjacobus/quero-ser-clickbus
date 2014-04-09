<?php

namespace MJ\CacheMachine\Bills;

use PO\Object;

class Base extends Object
{
    protected $_value;

    public function getValue()
    {
        return $this->_value;
    }

}

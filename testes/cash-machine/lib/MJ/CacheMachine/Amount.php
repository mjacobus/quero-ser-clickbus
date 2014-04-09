<?php

namespace MJ\CacheMachine;

class Amount
{
    protected $_value;

    public function __construct($value)
    {
        $this->_value = $value;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function decrease(Amount $value)
    {
        $this->_value -= $value->getValue();
        return $this;
    }

    public function isPositive()
    {
        return $this->getValue() > 0;
    }
}

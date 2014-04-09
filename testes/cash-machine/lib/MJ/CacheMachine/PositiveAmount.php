<?php

namespace MJ\CacheMachine;
use InvalidArgumentException;

class PositiveAmount extends Amount
{

    public function __construct($value)
    {
        parent::__construct($value);
        $this->_validate();
    }

    protected function _validate()
    {
        if (!$this->isPositive()) {
            throw new InvalidArgumentException('Number must be positive');
        }
    }

}

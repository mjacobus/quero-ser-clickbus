<?php

namespace MJ\CacheMachine;
use PO\Hash;

class Withdraw extends Hash
{

    public function getTotal()
    {
        $values = $this->map(
            function ($bill) {
                return $bill->getValue();
            }
        )->toArray();

        return array_sum($values);
    }

}

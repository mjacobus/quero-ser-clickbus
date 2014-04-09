<?php

namespace MJ;
use PO\Hash;
use MJ\CacheMachine\Withdraw;
use MJ\CacheMachine\Bills\Hundred;
use MJ\CacheMachine\Bills\Fifty;
use MJ\CacheMachine\Bills\Twenty;
use MJ\CacheMachine\Bills\Ten;
use MJ\CacheMachine\Bills\Null;
use MJ\CacheMachine\Amount;
use MJ\CacheMachine\PositiveAmount;
use MJ\CacheMachine\UnavailableBillException;

class CacheMachine
{
    protected $_bills;

    public function __construct()
    {
        $this->_bills = new Hash(array(
            new Hundred,
            new Fifty,
            new Twenty,
            new Ten,
        ));
    }

    public function withdraw($amount)
    {

        $withdraw = new Withdraw();

        if ($amount === null) {
            return $withdraw;
        }

        $amount   = new PositiveAmount($amount);

        while ($amount->isPositive()) {
            $bill = $this->_nextHigherBillFor($amount);
            $withdraw[] = $bill;
            $amount->decrease(new Amount($bill->getValue()));
        }

        return $withdraw;
    }

    public function getAvailableBills()
    {
        return $this->_bills;
    }

    public function _nextHigherBillFor(Amount $amount)
    {
        foreach ($this->getAvailableBills() as $bill) {
            if ($bill->getValue() <= $amount->getValue()) {
                $class = $bill->getClass();
                return new $class();
            }
        }

        throw new UnavailableBillException;
    }

}

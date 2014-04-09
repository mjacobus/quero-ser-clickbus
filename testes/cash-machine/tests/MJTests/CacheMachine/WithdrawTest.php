<?php

namespace MJTests\CacheMachine;
use PHPUnit_Framework_TestCase;

use MJ\CacheMachine\Withdraw;
use MJ\CacheMachine\Bills\Fifty;
use MJ\CacheMachine\Bills\Ten;


class WithdrawTest extends PHPUnit_Framework_TestCase
{

    public function testGetBills()
    {
        $withdraw   = new Withdraw();
        $fifty      = new Fifty;
        $ten        = new Ten;
        $withdraw[] = $fifty;
        $withdraw[] = $ten;

        $this->assertEquals(array($fifty, $ten), $withdraw->toArray());
    }

    public function testGetTotal()
    {
        $withdraw   = new Withdraw();
        $withdraw[] = new Fifty;
        $withdraw[] = new Ten;
        $this->assertEquals(60, $withdraw->getTotal());
    }
}

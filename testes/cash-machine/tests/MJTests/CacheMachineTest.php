<?php

namespace MJTests;

use MJ\CacheMachine;

class CacheMachineTest extends \PHPUnit_Framework_TestCase
{

    public function testCanAutoLoad()
    {
        $object = new CacheMachine;
        $this->assertInstanceOf('MJ\CacheMachine', $object);
    }

    public function providerForTestCanWidraw() 
    {
        return array(
            array(30, array(20, 10)),
            array(80, array(50, 20, 10)),
            array(null, array()),
        );
    }

    /**
     * @dataProvider providerForTestCanWidraw
     */
    public function testCanWithdraw($amount, $values)
    {
        $machine  = new CacheMachine;
        $withdraw = $machine->withdraw($amount);

        $this->assertEquals($values, $this->values($withdraw));
    }

    /**
     * @expectedException MJ\CacheMachine\UnavailableBillException
     */
    public function testThrowsExceptionWhenBillIsUnavailable()
    {
        $machine  = new CacheMachine;
        $withdraw = $machine->withdraw(125);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionWhenValueIsNegative()
    {
        $machine  = new CacheMachine;
        $withdraw = $machine->withdraw(-130);
    }

    protected function values($withdraw)
    {
        return $withdraw->map(
            function ($bill) {
                return $bill->getValue();
            }
        )->toArray();
    }

}

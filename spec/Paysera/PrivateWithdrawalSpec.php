<?php

namespace spec\Paysera;

use Paysera\PrivateWithdrawal;
use PhpSpec\ObjectBehavior;

/**
 * Class PrivateWithdrawalSpec
 * @package spec\Paysera
 */
class PrivateWithdrawalSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PrivateWithdrawal::class);
    }

    function it_should_add_first_withdrawal_as_first()
    {
    	$this
    		->addWithdrawal(new \DateTime(), 20)
    		->getWithdrawalCount()
    		->shouldEqual(1);
    }

    function it_should_accumulate_weeks_withdrawals()
    {
    	$this->addWithdrawal(new \DateTime('2017-03-27'), 20);
    	$this->addWithdrawal(new \DateTime('2017-03-28'), 21);
    	$this->addWithdrawal(new \DateTime('2017-03-29'), 22);
    	$this->addWithdrawal(new \DateTime('2017-03-30'), 23);

		$this->getWithdrawalCount()->shouldEqual(4);
		$this->getSumTaken()->shouldEqual(86);
    }

    function it_should_start_new_week_withdrawals_from_zero()
    {
        $this->addWithdrawal(new \DateTime('2017-03-25'), 20);
        $this->addWithdrawal(new \DateTime('2017-03-26'), 21);
        $this->addWithdrawal(new \DateTime('2017-03-27'), 22);

        $this->getWithdrawalCount()->shouldEqual(1);
        $this->getSumTaken()->shouldEqual(22);
    }
}

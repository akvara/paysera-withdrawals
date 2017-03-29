<?php

namespace spec\Paysera;

use Paysera\UsersWithdrawals;
use PhpSpec\ObjectBehavior;

/**
 * Class UsersWithdrawalsSpec
 * @package spec\Paysera
 */
class UsersWithdrawalsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UsersWithdrawals::class);
    }
}

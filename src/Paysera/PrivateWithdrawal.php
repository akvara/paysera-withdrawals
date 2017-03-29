<?php

namespace Paysera;

/**
 * Class PrivateWithdrawal
 * @package Paysera
 */
class PrivateWithdrawal
{

    /** @var \DateTime */
    private $lastWithdrawalDate;

    /** @var int */
    private $withdrawalCount;

    /** @var double */
    private $sumTaken;

    /**
     * PrivateWithdrawal constructor.
     */
    public function __construct()
    {
        $this->lastWithdrawalDate = null;
        $this->withdrawalCount = 0;
        $this->sumTaken = 0;
    }

    /**
     * Getter for withdraw count
     *
     * @return int
     */
    public function getWithdrawalCount()
    {
        return $this->withdrawalCount;
    }

    /**
     * Getter for sumTaken
     *
     * @return float
     */
    public function getSumTaken()
    {
        return $this->sumTaken;
    }

    /**
     * Register user withdrawal
     *
     * @param \DateTime $date
     * @param $money
     * @return $this
     */
    public function addWithdrawal(\DateTime $date, $money)
    {

		if (
		   !$this->lastWithdrawalDate ||
		    $this->weekStartsOn($this->lastWithdrawalDate) !== $this->weekStartsOn($date)
		) {
		    $this->lastWithdrawalDate = null;
		    $this->sumTaken = 0;//$money->amountIn(Config::BASE_CURRENCY, $rates);
		    $this->withdrawalCount = 0;
		}
		$this->lastWithdrawalDate = $date;
		$this->sumTaken += $money;//$money->amountIn(Config::BASE_CURRENCY, $rates);
		$this->withdrawalCount += 1;

        return $this;
    }

    /**
     * Calculates week start date
     *
     * @param $date
     * @return false|string|void
     */
    private function weekStartsOn($date)
    {
        if (!$date) return;
        return date('Y-m-d', strtotime('Last Sunday + 1 day', $date->getTimestamp()));
    }
}

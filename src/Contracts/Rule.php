<?php declare(strict_types = 1);

namespace HealthChecker\Contracts;

use HealthChecker\Contracts\RuleResult;

interface Rule
{
    /**
     * @return RuleResult
     */
    public function run(): RuleResult;
}



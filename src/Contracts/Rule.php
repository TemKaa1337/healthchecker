<?php declare(strict_types = 1);

namespace App\Contracts;

interface Rule
{
    /**
     * @return RuleResult
     */
    public function run(): RuleResult;
}



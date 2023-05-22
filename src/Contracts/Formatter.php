<?php declare(strict_types = 1);

namespace App\Contracts;

interface Formatter
{
    /**
     * @param list<RuleResult> $ruleResults
     * @return string
     */
    public static function format(array $ruleResults): string;
}

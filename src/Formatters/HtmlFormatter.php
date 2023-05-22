<?php declare(strict_types = 1);

namespace App\Formatters;

use App\Contracts\Formatter;
use App\Contracts\RuleResult;

final class HtmlFormatter implements Formatter
{
    /**
     * @param list<RuleResult> $ruleResults
     * @return string
     */
    public static function format(array $ruleResults): string
    {
        // TODO: Implement format() method.

    }
}

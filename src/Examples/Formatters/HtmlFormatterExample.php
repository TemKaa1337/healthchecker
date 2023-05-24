<?php declare(strict_types=1);

namespace HealthChecker\Examples\Formatters;

use HealthChecker\Formatters\HtmlFormatter;

/**
 * This is example of how to use HtmlFormatter
 */
final class HtmlFormatterExample
{
    public function example(): void
    {
        // let's say we have rule results stored in array result, containing array of objects
        // which implements RuleResult interface
        $result = ...;
        // html variable will store html formatted result of every rule
        $html = HtmlFormatter::format($result);
    }
}

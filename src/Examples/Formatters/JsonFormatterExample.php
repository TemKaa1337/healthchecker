<?php declare(strict_types = 1);

namespace HealthChecker\Examples\Formatters;

use HealthChecker\Formatters\JsonFormatter;

/**
 * This is example of how to use JsonFormatter
 */
final class JsonFormatterExample
{
    public function example(): void
    {
        // let's say we have rule results stored in array result, containing array of objects
        // which implements RuleResult interface
        $result = ...;
        // json variable will store json formatted result of every rule
        $json = JsonFormatter::format($result);
    }
}

<?php declare(strict_types=1);

namespace App\Examples\Formatters;

/**
 * This is example of how to use XmlFormatter
 */
final class XmlFormatterExample
{
    public function example(): void
    {
        // let's say we have rule results stored in array result, containing array of objects
        // which implements RuleResult interface
        $result = ...;
        // xml variable will store xml formatted result of every rule
        $xml = XmlFormatter::format($result);
    }
}

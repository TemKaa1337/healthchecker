<?php declare(strict_types = 1);

namespace App\Formatters;

use App\Contracts\Formatter;
use App\Contracts\RuleResult;

final class XmlFormatter implements Formatter
{
    /**
     * @param list<RuleResult> $ruleResults
     * @return string
     */
    public static function format(array $ruleResults): string
    {
        $xml = '<?xml version="1.0"?>';
        $xml .= '<rule-results>';
        foreach ($ruleResults as $ruleResult) {
            assert($ruleResult instanceof RuleResult, 'Can only format rule which implements RuleResult interface');
            $xml .= '<rule>';
            $xml .= "<success>".($ruleResult->isOk() ? 'true' : 'false')."</success>";
            $xml .= "<name>{$ruleResult->getName()}</name>";
            $xml .= "<description>{$ruleResult->getDescription()}</description>";

            $error = $ruleResult->getErrorMessage();
            if ($error === null) {
                $xml .= '<error null="true"/>';
            } else {
                $xml .= "<error>$error</error>";
            }

            $xml .= '</rule>';
        }
        $xml .= '</rule-results>';
        return $xml;
    }
}

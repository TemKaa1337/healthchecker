<?php declare(strict_types = 1);

namespace App\Formatters;

use App\Contracts\Formatter;
use App\Contracts\RuleResult;

final class XmlFormatter implements Formatter
{
    private const DEFAULT_SPACES_COUNT = 2;
    /**
     * @param list<RuleResult> $ruleResults
     * @return string
     */
    public static function format(array $ruleResults): string
    {
        $xml = '<?xml version="1.0"?>';
        $rootLevelSpaceIndent = str_repeat(' ', self::DEFAULT_SPACES_COUNT);
        $outerLevelSpaceIndent = str_repeat(' ', self::DEFAULT_SPACES_COUNT * 2);
        $innerLevelSpaceIndent = str_repeat(' ', self::DEFAULT_SPACES_COUNT * 3);
        $xml .= '\n'.$rootLevelSpaceIndent.'<rule-result>';
        foreach ($ruleResults as $ruleResult) {
            assert($ruleResult instanceof RuleResult, 'Can only format rule which implements RuleResult interface');
            $xml .= '\n'.$outerLevelSpaceIndent.'<rule>';

            $xml .= '\n'.$innerLevelSpaceIndent."<is-ok>{$ruleResult->isOk()}</is-ok>";
            $xml .= '\n'.$innerLevelSpaceIndent."<name>{$ruleResult->getName()}</name>";
            $xml .= '\n'.$innerLevelSpaceIndent."<description>{$ruleResult->getDescription()}</description>";
            $xml .= '\n'.$innerLevelSpaceIndent."<error>{$ruleResult->getErrorMessage()}</error>";

            $xml .= '\n'.$outerLevelSpaceIndent.'</rule>';
        }
        $xml .= '\n'.$rootLevelSpaceIndent.'</rule-result>';
        return $xml;
    }
}

<?php declare(strict_types = 1);

namespace HealthChecker\Formatters;

use HealthChecker\Contracts\Formatter;
use HealthChecker\Contracts\RuleResult;

final class JsonFormatter implements Formatter
{
    /**
     * @param list<RuleResult> $ruleResults
     * @return string
     */
    public static function format(array $ruleResults): string
    {
        $formatted = [];
        foreach ($ruleResults as $ruleResult) {
            assert($ruleResult instanceof RuleResult, 'Can only format rule which implements RuleResult interface');
            $formatted[] = [
                'success' => $ruleResult->isOk(),
                'name' => $ruleResult->getName(),
                'description' => $ruleResult->getDescription(),
                'error' => $ruleResult->getErrorMessage()
            ];
        }
        return json_encode($formatted);
    }
}

<?php declare(strict_types = 1);

namespace App\Formatters;

use App\Contracts\Formatter;
use App\Rules\RuleResult;

final class JsonFormatter implements Formatter
{
    /**
     * @param list<RuleResult> $ruleResults
     * @return string
     */
    public function format(array $ruleResults): string
    {
        $formatted = [];
        foreach ($ruleResults as $ruleResult) {
            assert($ruleResult instanceof RuleResult, 'Can only format rule which implements RuleResult interface');
            $formatted[] = $ruleResult->jsonSerialize();
        }
        return json_encode($formatted);
    }
}

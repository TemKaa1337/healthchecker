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
        $html = '<div class="rule-results">';
        foreach ($ruleResults as $ruleResult) {
            assert($ruleResult instanceof RuleResult, 'Can only format rule which implements RuleResult interface');
            $html .= '<div class="rule-result">';
            $html .= "<div>".($ruleResult->isOk() ? 'true' : 'false')."</div>";
            $html .= "<div>{$ruleResult->getName()}</div>";
            $html .= "<div>{$ruleResult->getDescription()}</div>";
            $error = $ruleResult->getErrorMessage();
            $error = $error === null ? 'null' : $error;
            $html .= "<div>$error</div>";
            $html .= '</div>';
        }

        $html .= '</div>';
        return $html;
    }
}

<?php declare(strict_types = 1);

namespace App;

use App\Rules\RuleResult as ErrorRuleResult;
use App\Contracts\RuleResult;
use App\Contracts\Rule;

final readonly class HealthChecker
{
    /**
     * @param list<Rule> $rules
     */
    public function __construct(
        private array $rules
    )
    {}

    /**
     * @return list<RuleResult>
     */
    public function run(): array
    {
        $result = [];
        foreach ($this->rules as $rule) {
            assert($rule instanceof Rule, 'Each runnable rule must implement Rule interface');
            try {
                $ruleResult = $rule->run();
            } catch (\Exception $e) {
                $ruleResult = new ErrorRuleResult(
                    isOk: false,
                    name: $rule::class,
                    description: null,
                    errorMessage: $e->getMessage()
                );
            }

            $result[] = $ruleResult;
        }
        return $result;
    }
}

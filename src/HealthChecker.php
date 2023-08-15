<?php declare(strict_types = 1);

namespace HealthChecker;

use HealthChecker\Rules\RuleResult as ErrorRuleResult;
use HealthChecker\Contracts\RuleResult;
use HealthChecker\Contracts\Rule;

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
            if (!$rule instanceof Rule) {
                throw new \RuntimeException('Each runnable rule must implement Rule interface');
            }
            
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

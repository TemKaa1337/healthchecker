<?php declare(strict_types=1);

namespace tests;

use App\Contracts\Rule;
use App\Contracts\RuleResult;
use App\HealthChecker;
use PHPUnit\Framework\TestCase;
use App\Rules\RuleResult as DefaultRuleResult;

final class HealthCheckerTest extends TestCase
{
    public function testCheckerDoesntThrowException(): void
    {
        $checker = new HealthChecker([]);
        $this->assertNotEmpty($checker);
    }

    public function testCheckerDoesntThrowExceptionWithIncorrectRule(): void
    {
        $testRule = new class implements Rule {
            /**
             * @return RuleResult
             */
            public function run(): RuleResult
            {
                throw new \Exception('Test exception');
            }
        };

        $checker = new HealthChecker([$testRule]);
        $result = $checker->run();

        $expected = [
            [
                'success' => false,
                'name' => $testRule::class,
                'description' => null,
                'error' => 'Test exception'
            ]
        ];
        $actual = [
            [
                'success' => $result[0]->isOk(),
                'name' => $result[0]->getName(),
                'description' => $result[0]->getDescription(),
                'error' => $result[0]->getErrorMessage()
            ]
        ];
        $this->assertEquals($expected, $actual);
    }

    public function testCheckerWorksCorrectly(): void
    {
        $testFirstRule = new class implements Rule {
            /**
             * @return RuleResult
             */
            public function run(): RuleResult
            {
                return new DefaultRuleResult(
                    true,
                    'name',
                    'description',
                    null
                );
            }
        };
        $testSecondRule = new class implements Rule {
            /**
             * @return RuleResult
             */
            public function run(): RuleResult
            {
                return new DefaultRuleResult(
                    false,
                    'name',
                    'description',
                    'error'
                );
            }
        };

        $checker = new HealthChecker([$testFirstRule, $testSecondRule]);
        $result = $checker->run();

        $expected = [
            [
                'success' => true,
                'name' => 'name',
                'description' => 'description',
                'error' => null
            ],
            [
                'success' => false,
                'name' => 'name',
                'description' => 'description',
                'error' => 'error'
            ]
        ];
        $actual = [
            [
                'success' => $result[0]->isOk(),
                'name' => $result[0]->getName(),
                'description' => $result[0]->getDescription(),
                'error' => $result[0]->getErrorMessage()
            ],
            [
            'success' => $result[1]->isOk(),
            'name' => $result[1]->getName(),
            'description' => $result[1]->getDescription(),
            'error' => $result[1]->getErrorMessage()
        ]
        ];
        $this->assertEquals($expected, $actual);
    }
}
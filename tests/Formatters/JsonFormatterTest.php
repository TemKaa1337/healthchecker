<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Formatters\JsonFormatter;
use App\Rules\RuleResult;

final class JsonFormatterTest extends TestCase
{
    public function testFormatterDoesntThrowException(): void
    {
        $results = [
            new RuleResult(
                true,
                'test',
                'description',
                null
            )
        ];
        $result = JsonFormatter::format($results);
        $this->assertNotEmpty($result);
    }

    public function testReturnsCorrectResultWithFailedRule(): void
    {
        $results = [
            new RuleResult(
                false,
                'test',
                'description',
                'error'
            )
        ];
        $result = JsonFormatter::format($results);
        $expected = json_encode([
            [
                'success' => false,
                'name' => 'test',
                'description' => 'description',
                'error' => 'error'
            ]
        ]);
        $this->assertEquals($expected, $result);
    }

    public function testReturnsCorrectResultWithSucceedAndFailedRules(): void
    {
        $results = [
            new RuleResult(
                true,
                'test',
                'description',
                null
            ),
            new RuleResult(
                false,
                'test2',
                'description2',
                'error'
            )
        ];
        $result = JsonFormatter::format($results);
        $expected = json_encode([
            [
                'success' => true,
                'name' => 'test',
                'description' => 'description',
                'error' => null
            ],
            [
                'success' => false,
                'name' => 'test2',
                'description' => 'description2',
                'error' => 'error'
            ]
        ]);
        $this->assertEquals($expected, $result);
    }
}
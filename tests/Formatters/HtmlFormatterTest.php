<?php
declare(strict_types=1);

use App\Rules\RuleResult;
use PHPUnit\Framework\TestCase;
use App\Formatters\HtmlFormatter;

final class HtmlFormatterTest extends TestCase
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
        $result = HtmlFormatter::format($results);
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
        $result = HtmlFormatter::format($results);
        $expected = '<div class="rule-results">'
                    .'<div class="rule-result">'
                    .'<div>false</div>'
                    .'<div>test</div>'
                    .'<div>description</div>'
                    .'<div>error</div>'
                    .'</div>'
                    .'</div>';
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
        $result = HtmlFormatter::format($results);
        $expected = '<div class="rule-results">'
                    .'<div class="rule-result">'
                    .'<div>true</div>'
                    .'<div>test</div>'
                    .'<div>description</div>'
                    .'<div>null</div>'
                    .'</div>'
                    .'<div class="rule-result">'
                    .'<div>false</div>'
                    .'<div>test2</div>'
                    .'<div>description2</div>'
                    .'<div>error</div>'
                    .'</div>'
                    .'</div>';

        $this->assertEquals($expected, $result);
    }
}
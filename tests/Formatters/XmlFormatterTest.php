<?php declare(strict_types = 1);

use App\Rules\RuleResult;
use PHPUnit\Framework\TestCase;
use App\Formatters\XmlFormatter;

final class XmlFormatterTest extends TestCase
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
        $result = XmlFormatter::format($results);
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
        $result = XmlFormatter::format($results);
        $expected = '<?xml version="1.0"?>'
                    .'<rule-results>'
                    .'<rule><success>false</success><name>test</name><description>description</description><error>error</error></rule>'
                    .'</rule-results>';
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
        $result = XmlFormatter::format($results);
        $expected = '<?xml version="1.0"?>'
                    .'<rule-results>'
                    .'<rule><success>true</success><name>test</name><description>description</description><error null="true"/></rule>'
                    .'<rule><success>false</success><name>test2</name><description>description2</description><error>error</error></rule>'
                    .'</rule-results>';

        $this->assertEquals($expected, $result);
    }
}
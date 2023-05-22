<?php declare(strict_types = 1);

namespace App\Examples;

use App\Contracts\Rule;
use App\Contracts\RuleResult;

/**
 * This class sends HTTP request to given resource and depending on response
 * status code generates RuleResult object.
 */
final readonly class ServerResponseRule implements Rule
{
    public function __construct(
        private string $url,
        private string $httpMethod,
        private int $expectedCode
    )
    {}

    /**
     * @return RuleResult
     */
    public function run(): RuleResult
    {
        // Make request here
        // Make your own class that implements RuleResult interface
        return new class implements RuleResult {
            /**
             * @param bool $success
             * @param string $name
             * @param string|null $description
             * @param string|null $errorMessage
             */
            public function __construct(
                private readonly bool $success,
                private readonly string $name,
                private readonly string|null $description,
                private readonly string|null $errorMessage
            )
            {}

            /**
             * @return bool
             */
            public function isOk(): bool
            {
                return $this->success;
            }

            /**
             * @return string
             */
            public function getName(): string
            {
                return $this->name;
            }

            /**
             * @return string|null
             */
            public function getDescription(): null|string
            {
                return $this->description;
            }

            /**
             * @return string|null
             */
            public function getErrorMessage(): null|string
            {
                return $this->errorMessage;
            }
        };
    }
}

<?php declare(strict_types = 1);

namespace App\Examples\Rules;

use App\Contracts\Rule;
use App\Contracts\RuleResult;

/**
 * This class checks if given directory exists in OS.
 */
final readonly class DirectoryRule implements Rule
{
    public function __construct(
        private string $path
    )
    {}

    /**
     * @return RuleResult
     */
    public function run(): RuleResult
    {
        // Check if directory exists in given path
        // Make your own class that implements RuleResult interface and return its object
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

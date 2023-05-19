<?php declare(strict_types = 1);

namespace App\Rules;

use App\Contracts\RuleResult as RuleResultInterface;

final readonly class RuleResult implements RuleResultInterface
{
    public function __construct(
        private bool $isOk,
        private string $name,
        private null|string $description,
        private null|string $errorMessage
    )
    {}

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->isOk;
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
}

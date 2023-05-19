<?php declare(strict_types = 1);

namespace App\Contracts;

interface RuleResult
{
    /**
     * @return bool
     */
    public function isOk(): bool;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string|null
     */
    public function getDescription(): null|string;

    /**
     * @return string|null
     */
    public function getErrorMessage(): null|string;
}



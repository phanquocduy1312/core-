<?php

namespace App\Services\PageImporter\Exceptions;

class ValidationException extends ImporterException
{
    /** @var array<string, mixed> */
    protected array $errors = [];

    public function __construct(string $message = 'Validation failed', array $errors = [], int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

<?php

namespace HttpClient;

use Exception;

class ClientException extends Exception
{
    private string $errorMessage;
    private int $errorNo;
    private ?string $errorCodeDescription;
    private string|bool $response;
    private array $info;

    public function __construct(string $errorMessage, int $errorNo, ?string $errorCodeDescription, string|bool $response, array $info)
    {
        $this->errorMessage = $errorMessage;
        $this->errorNo = $errorNo;
        $this->errorCodeDescription = $errorCodeDescription;
        $this->response = $response;
        $this->info = $info;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getErrorNo(): int
    {
        return $this->errorNo;
    }

    public function getErrorCodeDescription(): ?string
    {
        return $this->errorCodeDescription;
    }

    public function getResponse(): string|bool
    {
        return $this->response;
    }

    public function getInfo(): array
    {
        return $this->info;
    }
}

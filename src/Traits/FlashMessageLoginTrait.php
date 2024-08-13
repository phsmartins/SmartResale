<?php

namespace Smart\Resale\Traits;

trait FlashMessageLoginTrait
{
    private function addErrorMessage(string $errorMessage): void
    {
        $_SESSION['error_message_login'] = $errorMessage;
    }
}

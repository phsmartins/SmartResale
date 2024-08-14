<?php

namespace Smart\Resale\Traits;

trait FlashMessageLoginTrait
{
    private function addErrorMessage(string $errorMessage): void
    {
        $_SESSION['error_message_login'] = $errorMessage;
    }

    private function addSuccessMessageAlert(string $titleMessage, string $textMessage): void
    {
        $_SESSION['success_title_message_login'] = $titleMessage;
        $_SESSION['success_text_message_login'] = $textMessage;
    }

    private function addErrorMessageAlert(string $titleMessage, string $textMessage): void
    {
        $_SESSION['error_title_message_login'] = $titleMessage;
        $_SESSION['error_text_message_login'] = $textMessage;
    }
}

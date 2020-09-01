<?php

namespace Domain\SSN\Auth\UseCases\Registration;

interface RegistrationPresenterInterface
{
    public function presents(RegistrationResponse $response): void;
}

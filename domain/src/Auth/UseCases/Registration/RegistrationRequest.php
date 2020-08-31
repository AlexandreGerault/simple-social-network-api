<?php

namespace Domain\SSN\Auth\UseCases\Registration;

use Assert\Assertion;
use Assert\AssertionFailedException;

class RegistrationRequest
{
    private string $username;
    private string $email;
    private string $plainPassword;
    private string $plainPasswordConfirmation;

    /**
     * RegistrationRequest constructor.
     * @param string $username
     * @param string $email
     * @param string $plainPassword
     * @param string $plainPasswordConfirmation
     */
    public function __construct(
        string $username,
        string $email,
        string $plainPassword,
        string $plainPasswordConfirmation
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->plainPassword = $plainPassword;
        $this->plainPasswordConfirmation = $plainPasswordConfirmation;
    }

    /**
     * @throws AssertionFailedException
     */
    public function validate(): void
    {
        Assertion::notBlank($this->username);
        Assertion::notBlank($this->email);
        Assertion::notBlank($this->plainPassword);
        Assertion::notBlank($this->plainPasswordConfirmation);
        Assertion::email($this->email);
        Assertion::same($this->plainPassword, $this->plainPasswordConfirmation);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }
}

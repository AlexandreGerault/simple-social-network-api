<?php

namespace Domain\SSN\Auth\UseCases\Login;

class LoginRequest
{
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $plainPassword;

    /**
     * LoginRequest constructor.
     * @param string $email
     * @param string $plainPassword
     */
    public function __construct(string $email, string $plainPassword)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
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

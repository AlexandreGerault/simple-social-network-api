<?php

namespace Domain\SSN\Auth\Entity;

use Domain\SSN\Auth\UseCases\Registration\RegistrationRequest;

class User
{
    private string $username;
    private string $email;
    private string $password;

    /**
     * User constructor.
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public static function createFromRegistration(RegistrationRequest $request)
    {
        return new self(
            $request->getUsername(),
            $request->getEmail(),
            password_hash($request->getPlainPassword(), PASSWORD_ARGON2ID)
        );
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}

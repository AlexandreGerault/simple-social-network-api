<?php

namespace Domain\SSN\Auth\Entity;

use Domain\SSN\Auth\UseCases\Registration\RegistrationRequest;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User
{
    private UuidInterface $id;
    private string $username;
    private string $email;
    private string $password;

    /**
     * User constructor.
     * @param UuidInterface $id
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(UuidInterface $id, string $username, string $email, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public static function createFromRegistration(RegistrationRequest $request)
    {
        return new self(
            Uuid::uuid4(),
            $request->getUsername(),
            $request->getEmail(),
            password_hash($request->getPlainPassword(), PASSWORD_ARGON2ID)
        );
    }

    /**
     * @return UuidInterface
     */
    public function getId()
    {
        return $this->id;
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

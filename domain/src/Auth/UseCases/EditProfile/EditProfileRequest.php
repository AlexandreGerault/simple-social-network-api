<?php

namespace Domain\SSN\Auth\UseCases\EditProfile;

use Assert\Assertion;
use Ramsey\Uuid\UuidInterface;

class EditProfileRequest
{
    private UuidInterface $id;
    private ?string $username;
    private ?string $email;

    /**
     * EditProfileRequest constructor.
     * @param UuidInterface $id
     * @param string|null $username
     * @param string|null $email
     */
    public function __construct(UuidInterface $id, ?string $username, ?string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function validate(): void
    {
        if ($this->email) {
            Assertion::email($this->email);
        }
    }
}

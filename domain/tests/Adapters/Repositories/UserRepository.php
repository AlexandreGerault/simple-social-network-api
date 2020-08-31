<?php

namespace Domain\Tests\Adapters\Repositories;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;

class UserRepository implements UserGateway
{
    /**
     * @var User[]
     */
    private array $users;

    /**
     * UserRepository constructor.
     * @param User[] $users
     */
    public function __construct()
    {
        $this->users = [];
    }


    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User
    {
        if ($email == 'good@domain.tld') {
            return new User("username", $email, password_hash('correctPassword', PASSWORD_ARGON2ID));
        }

        foreach ($this->users as $user) {
            if ($user->getEmail() == $email) {
                return $user;
            }
        }
        throw new UserNotFoundException();
    }

    public function registers(User $user): void
    {
        $this->users[] = $user;
    }
}

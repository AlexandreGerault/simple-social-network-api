<?php


namespace Domain\Tests\Adapters\Repositories;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;

class UserRepository implements UserGateway
{
    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User
    {
        if ($email == 'good@domain.tld') {
            return new User($email, password_hash('correctPassword', PASSWORD_ARGON2ID));
        }
        throw new UserNotFoundException();
    }
}

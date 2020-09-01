<?php

namespace App\Repositories;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;

class UserRepository extends BaseRepository implements UserGateway
{
    protected string $table = 'users';

    /**
     * @param string $email
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): User
    {
        $dbUser = $this->connection->table($this->table)->where('email', $email)->first();

        if ($dbUser) {
            return new User(
                $dbUser->username,
                $dbUser->email,
                $dbUser->password
            );
        }
        throw new UserNotFoundException();
    }

    public function registers(User $user): void
    {
        $this->connection->table($this->table)->insert([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }
}

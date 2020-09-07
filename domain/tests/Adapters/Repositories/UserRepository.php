<?php

namespace Domain\Tests\Adapters\Repositories;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

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
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): User
    {
        if ($email == 'good@domain.tld') {
            return new User(
                Uuid::uuid4(),
                "username",
                $email,
                password_hash('correctPassword', PASSWORD_ARGON2ID)
            );
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

    /**
     * @param UuidInterface $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserById(UuidInterface $id): User
    {
        foreach ($this->users as $user) {
            if ($user->getId()->equals($id)) {
                return $user;
            }
        }
        throw new UserNotFoundException();
    }

    /**
     * @param User $user
     * @return User
     * @throws UserNotFoundException
     */
    public function update(User $user): User
    {
        foreach ($this->users as $loop_user) {
            if ($loop_user->getId()->equals($user->getId())) {
                $loop_user = new User(
                    $user->getId(),
                    $user->getUsername(),
                    $user->getEmail(),
                    $user->getPassword()
                );

                return $loop_user;
            }
        }
        throw new UserNotFoundException();
    }
}

<?php

namespace Domain\SSN\Auth\Gateway;

use Domain\SSN\Auth\Entity\User;

interface UserGateway
{
    public function getUserByEmail(string $email): User;
}

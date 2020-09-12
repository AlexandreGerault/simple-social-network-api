<?php

namespace Domain\SSN\Auth\Gateway;

use Domain\SSN\Auth\Entity\User;

interface AuthenticationGateway
{
    public function getAuthenticatedUser(): User;
}

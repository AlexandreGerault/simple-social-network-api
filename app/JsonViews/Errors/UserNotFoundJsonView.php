<?php

namespace App\JsonViews\Errors;

class UserNotFoundJsonView extends NotFoundJsonView
{
    /**
     * UserNotFoundJsonView constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->title = "User not found";
        $this->message = "No user has been found with the email ${email}";
    }
}

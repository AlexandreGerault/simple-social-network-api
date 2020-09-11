<?php

namespace App\JsonViews\Errors;

class UserNotFoundJsonView extends NotFoundJsonView
{
    /**
     * UserNotFoundJsonView constructor.
     * @param string $email
     */
    public function __construct(string $email = null)
    {
        $this->title = "User not found";
        if ($email) {
            $this->message = "No user has been found with the email ${email}";
        } else {
            $this->message = "No user has been found";
        }
    }
}

<?php

namespace App\JsonViews\Errors;

class InvalidCredentialsJsonView extends ErrorJsonView
{
    /**
     * InvalidCredentialsJsonView constructor.
     */
    public function __construct()
    {
        $this->title = "Invalid credentials";
        $this->message = "No user found with these credentials";
        $this->status = "Bad request";
        $this->httpCode = 401;
    }
}

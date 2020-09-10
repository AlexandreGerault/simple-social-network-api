<?php

namespace App\JsonViews\Errors;

abstract class NotFoundJsonView extends ErrorJsonView
{
    protected string $status = "Resource not found";
    protected int $httpCode = 404;
}

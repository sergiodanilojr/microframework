<?php

namespace Core\Database\Exceptions;

class DatabaseConnectionException extends \Exception
{
    protected $message = 'Something is wrong when try connect with database.';
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct($this->message, 0, $previous);
    }

}
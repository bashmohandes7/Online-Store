<?php

namespace App\Exceptions;

use Exception;

class InvalidOrderException extends Exception
{
    public function render()
    {
        return to_route('home')
        ->withInput()
        ->withErrors([
            'message' => $this->getMessage()
        ])
        ->with('info', 'Invalid Order');
    } // end of render
}

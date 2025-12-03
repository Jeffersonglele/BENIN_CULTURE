<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\ConfirmPasswordViewResponse as ConfirmPasswordViewResponseContract;

class PasswordConfirmationViewResponse implements ConfirmPasswordViewResponseContract
{
    public function toResponse($request)
    {
        return view('auth.confirm-password');
    }
}
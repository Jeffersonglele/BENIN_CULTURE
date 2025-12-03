<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorVerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        if ($request->user('auteur')->hasVerifiedEmail()) {
            return redirect()->intended(route('author.dashboard').'?verified=1');
        }

        if ($request->user('auteur')->markEmailAsVerified()) {
            event(new \Illuminate\Auth\Events\Verified($request->user('auteur')));
        }

        return redirect()->intended(route('author.dashboard').'?verified=1');
    }
}

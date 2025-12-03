<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorEmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('auteur')->hasVerifiedEmail()) {
            return redirect()->intended(route('author.dashboard'));
        }

        $request->user('auteur')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}

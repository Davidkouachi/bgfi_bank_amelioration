<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [];

    /**
     * Get the CSRF token expiration time.
     *
     * @return int
     */
    protected function csrfTokenExpiration()
    {
        return now()->addMinutes(60); // Définir la durée de vie du jeton CSRF en minutes (par exemple, 120 minutes)
    }
}

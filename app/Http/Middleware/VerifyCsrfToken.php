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
    protected $except = [
        // API routes (biasanya pakai token authentication)
        'api/*',
        
        // Webhook endpoints dari third-party services
        'webhooks/stripe',
        'webhooks/paypal',
        'webhooks/midtrans',
        
        // Payment gateway callbacks
        'payments/*/callback',
        'payments/*/notify',
        
        // Mobile app endpoints (jika tidak pakai Sanctum)
        // 'mobile/api/*',
    ];
}
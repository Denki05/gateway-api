<?php

namespace App\Http\Middleware;

use Closure;

class VerifyGatewayToken
{
    public function handle($request, Closure $next)
    {
        $expected = config('gateway.token');

        // Dukung 2 cara: X-GW-KEY (server-to-server) atau Bearer (JS/app).
        $given = $request->header('X-GW-KEY')
            ?? $this->bearer($request);

        if (empty($expected) || $given !== $expected) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized gateway.',
            ], 401);
        }

        return $next($request);
    }

    private function bearer($request)
    {
        $h = $request->header('Authorization', '');
        if (strpos($h, 'Bearer ') === 0) {
            return substr($h, 7);
        }
        return null;
    }
}

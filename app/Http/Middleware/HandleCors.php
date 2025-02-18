<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
{
    public function handle(Request $request, Closure $next)
    {
        // 任意のオリジンやヘッダーを設定
        $allowedOrigins = ['https://dkq73z-5173.csb.app'];  // ここにCodeSandboxのURLを設定
        $allowedMethods = 'GET, POST, PUT, DELETE, OPTIONS';  // 許可するメソッド
        $allowedHeaders = 'Content-Type, X-Requested-With';  // 許可するヘッダー

        // CORSヘッダーを追加
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', implode(', ', $allowedOrigins));
        $response->headers->set('Access-Control-Allow-Methods', $allowedMethods);
        $response->headers->set('Access-Control-Allow-Headers', $allowedHeaders);

        // 必要に応じてOPTIONSリクエストに対応する
        if ($request->getMethod() == "OPTIONS") {
            return $response;
        }

        return $response;
    }
}

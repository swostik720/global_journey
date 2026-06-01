<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NormalizeApostropheEntities
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $contentType = (string) $response->headers->get('Content-Type', '');
        if (stripos($contentType, 'text/html') === false) {
            return $response;
        }

        if (!method_exists($response, 'getContent') || !method_exists($response, 'setContent')) {
            return $response;
        }

        $content = $response->getContent();
        if (!is_string($content) || $content === '' || strpos($content, '&') === false) {
            return $response;
        }

        $normalized = preg_replace(
            [
                '/&amp;#0*39;?/i',
                '/&#0*39;?/i',
                '/&amp;#x0*27;?/i',
                '/&#x0*27;?/i',
                '/&amp;#8217;?/i',
                '/&#8217;?/i',
                '/&amp;rsquo;?/i',
                '/&rsquo;?/i',
            ],
            "'",
            $content,
        );

        if (is_string($normalized) && $normalized !== $content) {
            $response->setContent($normalized);
        }

        return $response;
    }
}

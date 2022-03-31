<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use voku\helper\AntiXSS;

/**
 * Class XssFilterMiddleware
 * @package App\Middleware
 *
 * Hyperf middleware that relies on anti-xss
 *
 */
class XssFilterMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $queryParams = [];
        foreach ($request->getQueryParams() as $key => $val) {
            $queryParams[$key] = $this->xssFilter($val);
        }
        $parseBody = [];
        foreach ($request->getParsedBody() as $key => $val) {
            $parseBody[$key] = $this->xssFilter($val);
        }
        $request = $request->withParsedBody($parseBody)->withQueryParams($queryParams);
        return $handler->handle($request);
    }

    private function xssFilter($str)
    {
        $antiXss = new AntiXSS();
        return $antiXss->xss_clean($str);
    }
}
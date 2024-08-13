<?php

namespace App\Core;

use App\Helpers\Str;
use ReflectionMethod;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Router
{
    private static RouteCollection $routes;
    private static RequestContext  $context;

    private static string $currentRouteName;

    public static function init(): void
    {
        // Symfony Collection Init
        static::$routes  = new RouteCollection();
        static::$context = new RequestContext();

    }

    public static function get($url, $options): self
    {
        static::setRouter($url, $options , "GET");
        return new self;
    }

    public static function post($url, $options): self
    {
        static::setRouter($url, $options, "POST");
        return new self;
    }
    
    public static function put($url, $options): self
    {
        static::setRouter($url, $options, "PUT");
        return new self;
    }
    
    public static function delete($url, $options): self
    {
        static::setRouter($url, $options, "DELETE");
        return new self;
    }

    private static function setRouter(string $url, array $options, string $method): void
    {
        $route = new Route($url, [
            '_controller' => $options[0],
            '_method'     => $options[1],
            '_params'     => Str::extractPlaceholders($url)
        ], [], [], '', [], $method);

        static::$currentRouteName = md5($url . $method);
        static::addRouter($route);
    }

    private static function addRouter($route): void
    {
        static::$routes->add(static::$currentRouteName, $route);
    }

    public function name(string $name): self
    {

        $route = static::$routes->get(static::$currentRouteName);

        static::$routes->remove(static::$currentRouteName);
        static::$currentRouteName = $name;
        static::addRouter($route);

        return $this;
    }

    public static function getRoutes(): RouteCollection
    {
        return static::$routes;
    }

    public static function getParameters(UrlMatcher $matcher, $context): array
    {
        return $matcher->match($context->getPathInfo());
    }

    public static function dispatch()
    {
         
        if ( isset($_REQUEST['_method']) ){
            $_SERVER['REQUEST_METHOD'] = $_REQUEST['_method'];
        }

        static::$context->fromRequest(Request::createFromGlobals());

        $matcher    = new UrlMatcher(static::$routes, static::$context);
        $parameters = static::getParameters($matcher, static::$context);
        
        $controller = $parameters['_controller'];
        $method     = $parameters['_method'];

        // Unset Key for prepared parameters
        unset($parameters['_controller']);
        unset($parameters['_method']);
        unset($parameters['_route']);
        unset($parameters['_params']);

        // Controller Init
        $controller = new $controller();

        // Reflection method to check if method has request parameter
        $reflectionMethod = new ReflectionMethod($controller, $method);
        
        foreach( $reflectionMethod->getParameters() as $parameterFunction ){
            if ( $parameterFunction->getType() && $parameterFunction->getType()->getName() === Request::class){
                $parameters['request'] = Request::createFromGlobals();
            }
        }
        
        call_user_func_array([$controller, $method], $parameters);
    }
}

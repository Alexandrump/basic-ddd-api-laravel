<?php


namespace Api\Infrastructure\Bus;


use Api\Application\Bus\Contracts\ContainerInterface;
use Illuminate\Container\Container as IoC;

class LaravelContainer implements ContainerInterface

{
    /**
     * @var IoC
     */
    private $container;

    /**
     * LaravelContainer constructor.
     * @param IoC $container
     */
    public function __construct(IoC $container)
    {
        $this->container = $container;
    }

    /**
     * @param $class
     * @return mixed|object
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function make($class)
    {
        return $this->container->make($class);
    }
}

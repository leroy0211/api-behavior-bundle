<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Request;

use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactoryInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class ArgumentNameConverter
{
    private $argumentMetadataFactory;

    /**
     * @var bool
     */
    private $isParameterTypeSupported;

    public function __construct(ArgumentMetadataFactoryInterface $argumentMetadataFactory)
    {
        $this->argumentMetadataFactory = $argumentMetadataFactory;
        $this->isParameterTypeSupported = method_exists('ReflectionParameter', 'getType');
    }

    public function getControllerArguments(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        $request = $event->getRequest();

        if (\is_array($controller)) {
            $r = new \ReflectionMethod($controller[0], $controller[1]);
        } elseif (\is_object($controller) && \is_callable([$controller, '__invoke'])) {
            $r = new \ReflectionMethod($controller, '__invoke');
        } else {
            $r = new \ReflectionFunction($controller);
        }

        foreach ($r->getParameters() as $param) {
            if ($param->getClass() && $param->getClass()->isInstance($request)) {
                continue;
            }

            $name = $param->getName();
            $class = $param->getClass();
            $hasType = $this->isParameterTypeSupported && $param->hasType();

            if ($class || $hasType) {
            }
        }
    }
}

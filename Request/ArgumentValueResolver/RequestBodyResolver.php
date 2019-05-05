<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Request\ArgumentValueResolver;

use BaxMusic\Bundle\ApiToolkit\Annotation\RequestBody;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;

final class RequestBodyResolver implements ArgumentValueResolverInterface
{
    private $serializer;

    private $contentTypes = ['json', 'xml'];

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $requestBody = $this->getRequestBody($request);

        if (!$requestBody instanceof RequestBody) {
            return false;
        }

        if (!\in_array($request->getContentType(), $this->contentTypes)) {
            return false;
        }

        return $requestBody->getProperty() === $argument->getName();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $requestBody = $this->getRequestBody($request);
        $body = $request->getContent();
        $type = $argument->getType();

        yield $this->serializer->deserialize($body, $type, $request->getContentType(), $requestBody->getContext());
    }

    private function getRequestBody(Request $request): ?RequestBody
    {
        return $request->attributes->get('_request_body');
    }
}

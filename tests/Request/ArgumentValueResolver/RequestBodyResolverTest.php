<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Request\ArgumentValueResolver;

use Flexsounds\Bundle\ApiBehavior\Annotation\RequestBody;
use Flexsounds\Bundle\ApiBehavior\Request\ArgumentValueResolver\RequestBodyResolver;
use Doctrine\Common\Annotations\AnnotationReader;
use Flexsounds\Bundle\ApiBehavior\Tests\Fixtures\EventListener\FooModel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class RequestBodyResolverTest extends TestCase
{
    public function testSupportsJson()
    {
        $resolver = new RequestBodyResolver($this->createMock(Serializer::class));
        $requestBody = new RequestBody([]);
        $requestBody->setProperty($property = 'foo');

        $request = $this->createRequest('{}', $requestBody);

        $this->assertTrue($resolver->supports($request, $this->createArgumentMetadata($property)));
    }

    public function testSupportsXml()
    {
        $resolver = new RequestBodyResolver($this->createMock(Serializer::class));
        $requestBody = new RequestBody([]);
        $requestBody->setProperty($property = 'foo');

        $request = $this->createRequest('<item></item>', $requestBody, 'application/xml');

        $this->assertTrue($resolver->supports($request, $this->createArgumentMetadata($property)));
    }

    public function testDoesNotSupportsRaw()
    {
        $resolver = new RequestBodyResolver($this->createMock(Serializer::class));
        $requestBody = new RequestBody([]);
        $requestBody->setProperty($property = 'foo');

        $request = $this->createRequest('<item></item>', $requestBody, 'text/html');

        $this->assertFalse($resolver->supports($request, $this->createArgumentMetadata($property)));
    }

    public function testConvertsRequestBody()
    {
        $resolver = new RequestBodyResolver($this->createSerializer());
        $requestBody = new RequestBody([]);
        $requestBody->setProperty($property = 'foo');
        $requestBody->setContext([
            'groups' => ['groupA'],
        ]);

        $request = $this->createRequest(json_encode([
            'foo' => 'john',
            'bar' => 'doe',
        ]), $requestBody);

        $this->assertTrue($resolver->supports($request, $argumentMetadata = $this->createArgumentMetadata($property)));

        $value = $resolver->resolve($request, $argumentMetadata)->current();

        $this->assertInstanceOf(FooModel::class, $value);
        $this->assertSame('john', $value->getFoo());
        $this->assertNotSame('doe', $value->getBar());
    }

    private function createRequest(string $content, RequestBody $requestBody = null, $contentType = 'application/json')
    {
        $headers = ['CONTENT_TYPE' => $contentType];

        $attributes = ['_request_body' => $requestBody];

        return new Request([], [], $attributes, [], [], $headers, $content);
    }

    private function createSerializer()
    {
        $classMetaDataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        return new Serializer([
            new PropertyNormalizer($classMetaDataFactory),
        ], [
            new JsonEncoder(),
            new XmlEncoder(),
        ]);
    }

    private function createArgumentMetadata($name)
    {
        return new ArgumentMetadata($name, FooModel::class, false, false, null);
    }
}

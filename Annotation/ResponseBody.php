<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 */
class ResponseBody extends ConfiguredAnnotation
{
    /**
     * @var string[]
     */
    private $serializerGroups = [];

    /**
     * @param string|string[] $serializerGroups
     */
    public function setSerializerGroups($serializerGroups): void
    {
        if (!\is_array($serializerGroups)) {
            $serializerGroups = [$serializerGroups];
        }
        $this->serializerGroups = $serializerGroups;
    }

    public function getSerializerGroups(): array
    {
        return $this->serializerGroups;
    }

    public function getContext()
    {
        $context = [];
        if (!empty($this->serializerGroups)) {
            $context['groups'] = $this->serializerGroups;
        }

        return $context;
    }

    /**
     * {@inheritdoc}
     */
    public function allowArray(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getAliasName(): string
    {
        return 'response_body';
    }
}

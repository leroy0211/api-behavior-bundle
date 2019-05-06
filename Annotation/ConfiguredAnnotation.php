<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

abstract class ConfiguredAnnotation implements AnnotationInterface
{
    public function __construct(array $values)
    {
        if ($valueProperty = $this->getValueProperty()) {
            if (isset($values['value'])) {
                $values[$valueProperty] = $values['value'];
                unset($values['value']);
            }
        }

        foreach ($values as $k => $v) {
            if (!method_exists($this, $name = 'set'.$k)) {
                throw new \RuntimeException(sprintf('Unknwon key "%s" for annotation "@%s.', $k, \get_class($this)));
            }

            $this->$name($v);
        }
    }

    protected function getValueProperty(): ?string
    {
        return null;
    }
}

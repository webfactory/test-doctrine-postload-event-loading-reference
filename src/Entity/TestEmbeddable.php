<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class TestEmbeddable
{
    public function __construct(
        #[ORM\Column]
        public string $content = '',
        public string $unmappedProperty = ''
    ) {
    }

    public function getUnmappedProperty(): string
    {
        return $this->unmappedProperty;
    }
}

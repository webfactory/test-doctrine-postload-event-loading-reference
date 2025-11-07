<?php

use Doctrine\ORM\Event\PostLoadEventArgs;

class PostLoadListener
{
    public function postLoad(PostLoadEventArgs $args): void
    {
        echo 'PostLoad EventListener called for '.$args->getObject()::class.'#'.($args->getObject()->id ?? '[->id-Property nicht vorhanden?]').\PHP_EOL;

        $object = $args->getObject();

        if (!is_a($object, Entity\Test::class)) {
            echo 'Got '.$object::class.\PHP_EOL;

            return;
        }

        $object->embeddable->unmappedProperty = 'Set by PostLoadListener';
    }
}

<?php

use Doctrine\ORM\Event\PostLoadEventArgs;

class PostLoadListener
{
    public function postLoad(PostLoadEventArgs $args): void
    {
        echo 'PostLoad EventListener called for '.$args->getObject()::class.'#'.($args->getObject()->id ?? '[->id-Property nicht vorhanden?]').\PHP_EOL;
    }
}

<?php

namespace App\EventListener;

use App\Entity\Problem;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\PersistentCollection;

class ProblemTest
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Problem) {
            return;
        }

        /** @var PersistentCollection $otherProblems */
        $otherProblems = $entity->getOtherProblems();
        dump($otherProblems->getDeleteDiff());
        dump($entity->getTitle() . ': ' . count($entity->getOtherProblems()));
    }
}

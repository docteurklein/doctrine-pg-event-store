<?php declare(strict_types=1);

namespace DocteurKlein\DoctrineEventStore;
use Doctrine\Common;
use Doctrine\ORM\Events;
use DocteurKlein\DoctrineEventStore\Example\Entity\Event;

final class EventSubscriber implements Common\EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist($event): void
    {
        if (!$event->getEntity() instanceof Event) {
            return;
        }
        $event->getEntityManager()->getConnection()->executeQuery('select pg_notify(:channel, :payload)', [
            'channel' => $event->getEntity()->getName(),
            'payload' => json_encode($event->getEntity()->getPayload()),
        ]);
    }
}

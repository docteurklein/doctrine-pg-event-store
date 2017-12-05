<?php declare(strict_types=1);

namespace DocteurKlein\DoctrineEventStore\Example\Entity;

use DocteurKlein\DoctrineEventStore\Example\Entity;

/**
 * @Entity
 */
final class Event
{
    /**
     * @Id
     * @Column(type="guid")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="DocteurKlein\DoctrineEventStore\Example\Entity", inversedBy="events")
     */
    private $entity;

    /**
     * @Column(type="json_array", options={"jsonb": true})
     */
    private $payload;

    public function __construct(Entity $entity, array $payload)
    {
        $this->id = uuid_create();
        $this->entity = $entity;
        $this->payload = $payload;
    }

    public function getName(): string
    {
        return 'test';
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}

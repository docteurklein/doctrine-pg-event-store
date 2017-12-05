<?php declare(strict_types=1);

namespace DocteurKlein\DoctrineEventStore\Example;

use Doctrine\Common\Collections\ArrayCollection;
use DocteurKlein\DoctrineEventStore\Example\Entity\Event;

/**
 * @Entity
 */
final class Entity
{
    /**
     * @Id
     * @Column(type="guid")
     */
    private $id;

    /**
     * @OneToMany(targetEntity="DocteurKlein\DoctrineEventStore\Example\Entity\Event", mappedBy="entity", cascade={"persist"})
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection;
        $this->id = uuid_create();
        $this->events->add(new Event($this, [
            'id' => $this->id,
            'shit happened!' => true,
        ]));
    }

    public function shit()
    {
        $this->events->add(new Event($this, [
            'id' => $this->id,
            'shit happened again!' => true,
        ]));
    }
}

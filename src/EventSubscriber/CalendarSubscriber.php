<?php

namespace App\EventSubscriber;

use App\Repository\EventRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private EventRepository $eventRepository,
    ){}

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        $colors = ["#FBF7EE", "#EC5D39", "#0282F1", "#FF72CE"];

        $events = $this->eventRepository->findAll();

        foreach($events as $event) {
            $calendarEvent = new Event(
                $event->getName(),
                $event->getDate()
            );

            $calendarEvent->setOptions([
                'backgroundColor' => array_rand($colors)
            ]);

            $calendar->addEvent($calendarEvent);
        }

        // If the end date is null or not defined, it creates a all day event
        $calendar->addEvent(new Event(
            'All day event',
            new \DateTime('Friday this week')
        ));
    }
}
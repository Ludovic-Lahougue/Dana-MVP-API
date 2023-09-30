<?php

namespace AppBundle\Listener;

use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use App\Repository\EventRepository;
use AppBundle\Entity\CalendarEvent as MyCustomEvent;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;

class LoadDataListener
{
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(CalendarEvent $calendar, EventRepository $eventRepository)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        $colors = ["#FBF7EE", "#EC5D39", "#0282F1", "#FF72CE"];

        $events = $eventRepository->findAll();

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
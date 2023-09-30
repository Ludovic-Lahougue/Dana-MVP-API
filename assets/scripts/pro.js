import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import bootstrap5Plugin from '@fullcalendar/bootstrap';
import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

import 'bootstrap-icons/font/bootstrap-icons.css';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new Calendar(calendarEl, {
        plugins: [ interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin, bootstrap5Plugin ],
        headerToolbar: {
            left: 'timeGridDay,timeGridWeek,dayGridMonth,listWeek',
            center: 'title',
            right: 'prev,next today'
        },
        footerToolbar: {
        },
        eventSources: [
            {
                url: Routing.generate('app_event_load'),
                method: "POST",
                extraParams: {
                    filters: JSON.stringify({})
                },
                failure: () => {
                    console.warn('error');
                },
            },
        ],
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        views: {
            dayGridMonth: {
                titleFormat: { month: 'long', year: 'numeric' },
            },
            timeGridWeek: {
                titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },
            },
            timeGridDay: {
                titleFormat: { day: 'numeric', month: 'short', year: 'numeric' },
            }
        },
        buttonText: {
            today: 'Aujourd\'hui',
            month: 'Mois',
            week: 'Semaine',
            year: 'Année',
            list: 'Liste',
            day: 'Jour'
        },
    });
    
    calendar.render();
});
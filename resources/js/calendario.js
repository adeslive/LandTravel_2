$(function(){
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl,{
        plugins:['timeGrid'],
        defaultView: 'timeGridWeek',
        nowIndicator: true,
        
        eventSources: [
            {
              url: 'tours/feed', // use the `url` property
              color : 'yellow',    // an option!
              textColor: 'black'  // an option!
            }
        ]
    });
    calendar.render();
});
document.addEventListener('DOMContentLoaded', function() {
  
    let selector = document.querySelector("#selector");
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'th',
      eventOrder: true,
      headerToolbar: {
        start: '',
        center: 'title',
        end: 'prev,next'
      },


      eventDidMount: function(arg) {
        // if (!(val == arg.event.extendedProps.posit_id)) {
        //   arg.el.style.display = "none";
        // }
        // console.log(val);
        var newLine = "\r\n"
        $(arg.el).popover({
          title: arg.event.title,
          placement: 'top',
          trigger: 'hover',
          content: arg.event.extendedProps.name+"<br />โทร: "+arg.event.extendedProps.phone,
          container: 'body',
          html: true
      });

      },
      eventSources: [{
          url: '../api/booking-night.php',
          method: 'GET',
          extraParams: function() {
            return {
              positid: $('#selector').val()
            }
          },
          failure: function() {
            alert('there was an error while fetching events!');
            //console.log();
          },
          color: '#356BF8', // a non-ajax option
          textColor: 'white' // a non-ajax option
        },{
          url: '../api/booking-day.php',
          method: 'GET',
          extraParams: function() {
            return {
              positid: $('#selector').val()
            }
          },
          failure: function() {
            alert('there was an error while fetching events!');
            //console.log();
          },
          color: '#FF8E00', // a non-ajax option
          textColor: 'white' // a non-ajax option
        },
           {
          url: '../api/booking-afternoon.php',
          method: 'GET',
          extraParams: function() {
            return {
              positid: $('#selector').val()
            }
          },
          failure: function() {
            alert('there was an error while fetching events!');
            //console.log();
          },
          color: '#3BCEAC', // a non-ajax option
          textColor: 'white' // a non-ajax option
        }
      
    
    ]


    });
    calendar.render();

    selector.addEventListener('change', function() {
      calendar.refetchEvents();
    });
  });
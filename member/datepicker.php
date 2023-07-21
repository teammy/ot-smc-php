<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {

      function fetchDataForDay(dataName, formatDate) {
        $.ajax({
          url: "../api/getSlot.php", // TODO: replace with your server script URL
          data: {
            datename: dataName, // Pass the selected date to the server script
            formatdate: formatDate
          },
          success: function(result) {
            // The server responded successfully, log the result
            console.log(result);

            // Clear any previous radio buttons
            $('#radioButtonContainer').html("");

            // Create the specified number of radio buttons
            for (var i = 1; i <= result; i++) {
              // Create a radio button dynamically
              var radioButton = $('<input>');

              // Set the radio button properties
              radioButton.attr('type', 'radio');
              radioButton.attr('class', 'btn-check');
              radioButton.attr('name', 'otSlot');
              radioButton.attr('id', 'otSlot' + i);
              radioButton.attr('value', i);

              // Add an onchange event handler to the radio button
              radioButton.on('change', function() {
                // If a radio button is selected, show the submit button
                $('#submitOT').show();
              });

              // Create a label for the radio button
              var label = $('<label>');
              label.attr('for', 'otSlot' + i);
              label.attr('class', 'btn btn-outline-danger me-2');
              label.text("Reserve OT Slot " + i);

              // Add the radio button and label to the DOM
              $('#radioButtonContainer').append(radioButton, label);
            }

            // Add a submit button
            var submitButton = $('<button>');
            submitButton.attr('id', 'submitOT');
            submitButton.text("Submit OT Reservation");
            submitButton.hide(); // Initially hide the submit button

            // Add a click event handler to the submit button
            submitButton.on('click', function() {
              // Get the selected slot
              var selectedSlot = $('input[name="otSlot"]:checked').val();

              // Make an AJAX request to your reservation script
              $.ajax({
                url: "../member/createSlot.php",
                method: "POST",
                data: {
                  dateSelect: formatDate,
                  slot: selectedSlot
                },
                success: function(reservationResult) {
                  // The server responded successfully, log the result
                  console.log(reservationResult);
                  Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                  }).then((result) => {
                    location.reload();
                  })
                },
                error: function(reservationResult) {
                  // The server responded with an error, log the error
                  console.log(error);
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                  })
                }
              });
            });

            // Add the submit button to the DOM
            $('#radioButtonContainer').append(submitButton);
          }
        });
      }

      $("#datepicker").datepicker({
        onSelect: function(dateText) {
          var date = $(this).datepicker('getDate');
          var timezoneOffset = date.getTimezoneOffset() * 60000;
          var formattedDate = (new Date(date - timezoneOffset)).toISOString().split('T')[0];
          var dayOfWeek = date.getDay(); // Sunday - Saturday : 0 - 6
          var dayOfName = date.toLocaleDateString('en-US', {
            weekday: 'long'
          }); // Sunday - Saturday : 0 - 6

          if (dayOfWeek >= 0 && dayOfWeek <= 6) {
            fetchDataForDay(dayOfName, formattedDate);
          }
        }
      });
    });
    document
  </script>
</head>

<body>
  <input type="text" name="" id="datepicker">
  <div id="radioButtonContainer"></div>
</body>

</html>
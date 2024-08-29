  // Function to update the current date and time
  function updateDateTime() {
    // Get the current date and time
    var currentDate = new Date();
    
    // Format the date and time
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
    var formattedDateTime = currentDate.toLocaleDateString(undefined, options);
    
    // Set the formatted date and time in the HTML element
    document.getElementById("currentDateTime").textContent = formattedDateTime;
}

// Call the function to update date and time initially
updateDateTime();

// Update the date and time every second
setInterval(updateDateTime, 1000);

/***** Start price-index-recent-property Section *****/
document.addEventListener("DOMContentLoaded", function() {
  const priceElements = document.querySelectorAll('.price');
  priceElements.forEach(function(element) {
      const price = element.textContent.trim().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      element.textContent = price;
  });
});
/***** End price-index-recent-property Section *****/


/***** Start recent index carosel Section *****/
$('.property-slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 2,
  prevArrow: $('.prev-button'),
  nextArrow: $('.next-button'),
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
   
  ]
});
/***** End recent index carosel Section *****/
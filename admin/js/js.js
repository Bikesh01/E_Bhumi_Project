
  
 function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  // Get all elements with class "price"
  var priceElements = document.querySelectorAll('.price');

  // Loop through each element and format its content
  priceElements.forEach(function(element) {
    var price = parseInt(element.textContent);
    element.textContent = formatNumberWithCommas(price);
  }); 
  
  
  function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  // Get all elements with class "price"
  var areaElements = document.querySelectorAll('.area');

  // Loop through each element and format its content
  areaElements.forEach(function(element) {
    var area = parseInt(element.textContent);
    element.textContent = formatNumberWithCommas(area);
  });


// page loader 

  /***** Start toggle property view Section *****/
  document.querySelectorAll(".toggle-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var row = this.parentNode.parentNode;
      var content = row.nextElementSibling;

      if (content.classList.contains("active")) {
        content.classList.remove("active");
        this.textContent = "+";
      } else {
        content.classList.add("active");
        this.textContent = "-";
      }
    });
  });
  /***** End toggle property view Section *****/
function menuButton(x) {
  x.classList.toggle("change");
}

function loadModal(modalId) {
  var showModal = document.getElementById(modalId);
  if (showModal.style.display !== "none") {
    showModal.style.display = "block";
    loadHtmlPage(modalId);
  } else {
    showModal.style.display = "none";
  }
}

function loadHtmlPage(id){
  if (id === "myModal") {
    document.getElementById(id).innerHTML='<object type="text/html" width="1500" height="1500" data="../html/login.html" ></object>';
  }
  else {
    document.getElementById(id).innerHTML='<object type="text/html" width="1500" height="1500" data="../html/create-account.html" ></object>';
  }
}

function closeModal() {
  var hideModal = document.getElementById("myModal").hide();

}

function displayBlog(){
  document.getElementById("blogContainer").display="block";
}

function displayPost(){
  document.getElementById("postContainer").display="block";
}
//From Dr. Alan Hunt
//function for making ajax call to the server.
function submitJson(formname, suburl, data, callback) {

  // default the JSON to what is passed in the data param
  var form = data;

  // if the data block is not defined, then serialize the form that was passed in
  if (!form) {
    form = $(formname).serializeJSON();
  }

  // make an ajax call to post the form and deal with the response
  $.ajax({
    url: urlBase + suburl,
    type: "POST",
    dataType: 'json',
    contentType: 'application/json; charset=UTF-8',
    data: JSON.stringify(form),
    success: function(maindta) {
      if (callback) {
        callback(maindta);
      } else {
        $("#display").html("<pre>" + JSON.stringify(maindta, null, 2) + "</pre>");
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // if there is an error, pop up an alert box.  You may want to replace this with a more subtle and context
      // friendly way of dealing with errors.
      var message = "ERROR:" + errorThrown;
      alert(message);
    }
  })
  return false;
}

// make a get request.  This assumes that the URL already contains the parameters necessary for the call.
// If you include a callback, it will get called with the response from the API, and if you don't it just
// prints out the response to the page.
function getJson(suburl) {
  $.ajax({
    url: urlBase + suburl,
    type: "GET",

    success: function(maindta) {
      if (callback) {
        callback(maindta);
      } else {
        // note, this accomplishes the same thing as the jQuery notation in the post version of the function
        // above.  It's all just javascript - jQuery is providing "shorthand" for the DOM access
        document.getElementById("display").innerHTML = "<pre>" + JSON.stringify(maindta, null, 2) + "</pre>";
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      var message = "ERROR:" + errorThrown;
      alert(errorThrown);
    }
  })
};

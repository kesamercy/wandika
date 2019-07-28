 function startAjax(data, callback){
          var form=data;
          $.ajax({
               url: '../php/newsfeed-api/data.php',
               type: "POST",
               dataType: 'json',
               contentType: 'application/json; charset=UTF-8',
               data: JSON.stringify(form),
               //console.log(data);
                success: function(msg){
                //alert( "Data Saved: " + msg );
                if (callback) {
                    callback(msg);
                  } else {
                     $("#display").html("<pre>" + JSON.stringify(msg, null, 2) + "</pre>");
                  }
                console.log(msg);
              },
               error : function(request,error){
                alert("Request: "+JSON.stringify(request));
               }
         });
          return false;
        };

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

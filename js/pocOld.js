function startAjax(urlbase, data, callback){
          var form=data;
          //data["blog-post"] = "buffalo";
          var post = $('.textbox').val();
          data["blog-post"] = post;
          data["blog-title"]= "Test Post";
          data["genre"]="Cultural";
          data["image-title"]="sunset.jpeg";
          data["timeToRead"]="5 minutes to read";
          data["username"]="stuti";
          console.log("sending data "  + JSON.stringify(data));
          $.ajax({
               url: urlbase,
               type: 'POST',
               dataType: 'json',
               data: form,
               success: function(maindta){
                console.log("received data" + JSON.stringify(maindta));
                if (callback) {
                    callback(maindta);
                    } else {
                    $("#display").html("<pre>" + JSON.stringify(maindta, null, 2) + "</pre>");
                     }
                   },
               error: function(request, error){
                console.log("request sent" + JSON.stringify(request));
               }
             });
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
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" type="text/css" href="..\..\css\style.css?version=1">

  <title>News Feed</title>

</head>
<body>

<div class="headerGrid">
    <div class="item1"><img src="..\..\Images\newcolorlogo.png" class="logo" alt=""></div>
    <div class="item2"><p>News Feed</p></div>
    <div class="item3"><div class="menu_bar"  id="right side" onclick="myFunction(this)">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div> 
  </div>  
</div>

<div class="postBlogOuter"><img src="..\..\Images\feather-filled-shape.png" class="feather1"  alt="">
  <img src="..\..\Images\feather-filled-shape.png" class="feather2" align="middle"  alt="">
  <div class="postBlogInner">
    <input class="textbox" name="blog-post" type="text" placeholder="Start typing your post here...">
    <button class="button-type1 button1" type="submit" name="writerTip">Post as Writer's Tip</button>
    <button class="button-type1 button2" type="submit" name="blog">Post as Blog</button>
  </div>
</div>

<div class="blogAndPostGrid">
  <div class="blogContainer"> 
    <div class="smallElements">
      <img src="..\..\Images\username.jpeg" class="userlogo" alt="">
      <p class="username"><b>username</b></p>
      <p class="timeToRead"><b>5 min read</b></p>
      <p class="postedAt"><b>Posted 2 hours ago</b></p>
      <div class="blogSpace"><p>Lorem ipsum dolor sit amet, sapien etiam, nunc amet dolor ac odio mauris justo.  Luctus arcu, urna praesent at id quisque ac. Arcu es massa vestibulum malesuada, integer vivamus elit eu mauris eus, cum eros quis aliquam wisi.</p></div>
      <img src="..\..\Images\sunset.jpeg" class="blogPicture" alt="">
    </div>
    <div class="bottomElements">
      <p class="genre"><b>fiction</b></p>
      <div class="blogbuttons">
        <button class="button-type2 button3" id="tag" type="submit" name="tag">Tag</button>
        <button class="button-type2 button4" id="feedback" type="submit" name="feedback">Feedback to Writer</button>
        <button class="button-type2 button5" id="save" type="submit" name="saveBlog">Save Blog</button>
      </div>
    </div>
</div>

<div class="postContainer">
    <div class="smallElements"> 
     <img src="..\..\Images\username.jpeg" class="userlogo" alt="">
     <p class="username2"><b>username</b></p>
     <div class="postSpace"><p>Lorem ipsum dolor sit amet, sapien etiam, nunc amet dolor ac odio mauris justo. Luctus arcu, urna praesent at id quisque ac.</p></div>
   </div>
   <button class="button-type1 button6" type="submit" name="saveTip">Save Writer's Tip</button>
   <p class="genre2"><b>non-fiction</b></p>
 </div>
</div>

<div class="sideBar">
  <p style="color:black;">SORT BY:</p>
  <div class="typesOfGenre">
    <p class="sideGenre"><b>GENRE</b></p>
    <img src="..\..\Images\feather-filled-shape.png" class="sidebarFeather" alt="">
  </div>
  <div class="writersTip">
   <p class="sideWriter"><b>WRITER'S  TIPS</b></p>
 </div>  <img src="..\..\Images\feather-filled-shape.png" class="sidebarFeather2" alt="">
</div>

<!--code for displaying tags-->

<div id="tagDisplay" class="innerContent">
  <span class="close">&times;</span>
  <p class="tagElements">I struggled to relate with this content.</p>
  <p class="tagElements">I related to this content</p>
  <p class="tagElements">This will benefit from additional time and work. Good start</p>
  <p class="tagElements">You are brave for being vulnerable.</p>
</div>

<!--javascript-->
<script>
  // Get the tags
var tags = document.getElementById("tagDisplay");
// Get the button that opens the tags
var tagclick = document.getElementById("tag");
// Get the <span> element that closes the tags
var span = document.getElementsByClassName("close")[0];
tagclick.onclick = function() {
  tags.style.display = "block";
}
// When the user clicks on <span> (x), close the tags
span.onclick = function() {
  tags.style.display = "none";
}
// When the user clicks anywhere outside of the tags, close it
window.onclick = function(event) {
  if (event.target == tags) {
    tags.style.display = "none";
  }
}
</script>


</body>
</html>
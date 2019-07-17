//javascript for the menu button
function myFunction(x) {
  x.classList.toggle("change");
}
//script for the login
// Get the modal
var modal = document.getElementById("myModal");
// Get the button that opens the modal
var log = document.getElementById("left_btn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal
log.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
//script for create account
// Get the modal
var acct_modal = document.getElementById("create_acct");
// Get the button that opens the modal
var signup = document.getElementById("right_btn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("acct_close")[0];
// When the user clicks the button, open the modal
signup.onclick = function() {
  acct_modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  acct_modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == acct_modal) {
    acct_modal.style.display = "none";
  }
}
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


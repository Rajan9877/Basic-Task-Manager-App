let hidebtn = document.getElementById("hidebtn");
let content = document.getElementById("show");
hidebtn.addEventListener("click", show);
function show(){
    if (hidebtn.innerHTML == "Hide") {
        hidebtn.innerHTML = "Show";
        content.style.display = "none";
      }else{
        hidebtn.innerHTML = "Hide";
        content.style.display = "block";
      }
}
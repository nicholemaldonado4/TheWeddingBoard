const closebtns = document.querySelectorAll('.closebtn');

function CloseMsg(event) {
    console.log("here");
	this.parentElement.style.display = 'none';
}

closebtns.forEach(function(btn) {
    btn.addEventListener("click", CloseMsg, false);
});

const boardMsg = document.querySelector('textarea[name="board_msg"]');
const charLeft = document.getElementById('char-left');
const boardImg = document.getElementById('board_img');

function UpdateMsgCharCount() {
    var numChars = this.value.length;
    if (numChars > 200) {
        this.value = this.value.substring(0, 200);
    }
    charLeft.innerHTML = 200 - this.value.length;
}

function ShowImage(event) {
	if (event.target.files.length <= 0) {
        return;
    }
	var faImg = document.querySelector('.fa-image');
    console.log(faImg);
    if (!faImg.classList.contains("hidden")) {
    	faImg.classList.add("hidden");
    }
	var imgPreview = document.querySelector(".img-preview");
	if (imgPreview.classList.contains("hidden")) {
		imgPreview.classList.remove("hidden");
	}
	
	var src = URL.createObjectURL(event.target.files[0]);
    imgPreview.src = src;
}

boardMsg.addEventListener("input", UpdateMsgCharCount, false);
boardImg.addEventListener("change", ShowImage, false);

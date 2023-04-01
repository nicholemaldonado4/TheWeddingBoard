const gallery = document.querySelector('.gallery');
const bkgrd_color_picker = document.querySelector('input[name="background_color"]');
const foregrd_color_picker = document.querySelector('input[name="foreground_color"]');
const msg_font_color_picker = document.querySelector('input[name="msg_font_color"]');
const posts = document.querySelectorAll('.post');

function SetBackground() {
  gallery.style.backgroundColor = bkgrd_color_picker.value
}

function SetForeground() {
  
}

function InitializePage() {
  SetBackground();
  posts.forEach(function (post) {
    const post_overlay = post.querySelector('.post-overlay');
    post_overlay.style.backgroundColor = foregrd_color_picker.value;
    const post_msg = post.querySelector('.post-msg');
    post_msg.style.color = msg_font_color_picker.value;
  });
}


InitializePage();


//function ShowImage(event) {
//	if (event.target.files.length <= 0) {
//        return;
//    }
//	var faImg = document.querySelector('.fa-image');
//    console.log(faImg);
//    if (!faImg.classList.contains("hidden")) {
//    	faImg.classList.add("hidden");
//    }
//	var imgPreview = document.querySelector(".img-preview");
//	if (imgPreview.classList.contains("hidden")) {
//		imgPreview.classList.remove("hidden");
//	}
//	
//	var src = URL.createObjectURL(event.target.files[0]);
//    imgPreview.src = src;
//}
//
//boardMsg.addEventListener("input", UpdateMsgCharCount, false);
//boardImg.addEventListener("change", ShowImage, false);

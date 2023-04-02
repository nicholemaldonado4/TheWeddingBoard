const gallery = document.querySelector('.gallery');
const bkgrd_color_picker = document.querySelector('input[name="background_color"]');
const foregrd_color_picker = document.querySelector('input[name="foreground_color"]');
const msg_font_color_picker = document.querySelector('input[name="msg_font_color"]');
const posts = document.querySelectorAll('.post');

function SetBackground() {
  gallery.style.backgroundColor = bkgrd_color_picker.value
}

function SetForeground(post) {
  const post_overlay = post.querySelector('.post-overlay');
  post_overlay.style.backgroundColor = foregrd_color_picker.value;
  
}

// TODO: Restart animation otherwise will keep color from previous and be delayed.
function SetAllForegrounds() {
  keyframe_foregrd.style.backgroundColor = 'red';
  posts.forEach(function (post) {
    SetForeground(post);
  });
}

function SetMsgColor(post) {
  const post_msg = post.querySelector('.post-msg');
  post_msg.style.color = msg_font_color_picker.value;
}

function SetAllMsgsColor() {
  posts.forEach(function (post) {
    SetMsgColor(post);
  });
}

function InitializePage() {
  SetBackground();
  posts.forEach(function (post) {
    SetForeground(post);
    SetMsgColor(post);
  });
}

InitializePage();

bkgrd_color_picker.addEventListener("change", (event) => { SetBackground(); });
foregrd_color_picker.addEventListener("change", (event) => { SetAllForegrounds(); });
msg_font_color_picker.addEventListener("change", (event) => { SetAllMsgsColor(); });

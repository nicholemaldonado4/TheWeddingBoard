const gallery = document.querySelector('.gallery');

const title_label = document.querySelector('label[for="title"]');
const bkgrd_color_label = document.querySelector('label[for="background_color"]');
const foregrd_color_label = document.querySelector('label[for="foreground_color"]');
const msg_font_color_label = document.querySelector('label[for="msg_font_color"]');

const title_picker = document.querySelector('input[name="title"]');
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

// TODO: Maybe just store prev active label and input.
function ShowPopUpInput(label, input) {
  if (input.classList.contains("active")) {
    input.classList.remove("active");
    label.classList.remove("selected-label");
  } else {
    input.classList.add("active");
    label.classList.add("selected-label");
    
    const label_mapping = [[title_label, title_picker],
                        [bkgrd_color_label, bkgrd_color_picker],
                        [foregrd_color_label, foregrd_color_picker],
                        [msg_font_color_label, msg_font_color_picker]];
    label_mapping.forEach(function (entry) {
      curr_label = entry[0];
      curr_input = entry[1];
      if (curr_label == label) {
        return;
      }
      curr_input.classList.remove("active");
      curr_label.classList.remove("selected-label");
    });

  }
}

InitializePage();


bkgrd_color_picker.addEventListener("change", (event) => { SetBackground(); });
foregrd_color_picker.addEventListener("change", (event) => { SetAllForegrounds(); });
msg_font_color_picker.addEventListener("change", (event) => { SetAllMsgsColor(); });

var smaller_screen_width = window.matchMedia("(max-width: 800px)");
if (smaller_screen_width.matches) {
  title_label.addEventListener("click", (event) => {ShowPopUpInput(title_label, title_picker)});
  bkgrd_color_label.addEventListener("click", (event) => {ShowPopUpInput(bkgrd_color_label, bkgrd_color_picker)});
  foregrd_color_label.addEventListener("click", (event) => {ShowPopUpInput(foregrd_color_label, foregrd_color_picker)});
  msg_font_color_label.addEventListener("click", (event) => {ShowPopUpInput(msg_font_color_label, msg_font_color_picker)});
  
}

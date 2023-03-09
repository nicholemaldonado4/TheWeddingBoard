const postOverlays = document.querySelectorAll('.post-overlay');

function switchImgAndMsg(event) {
	postOverlays.forEach((item) => {
      const displayStyle = window.getComputedStyle(item).getPropertyValue("display");
      console.log(displayStyle);
      item.style.display = displayStyle == "none" ? "flex" : "none";
    });
}

setInterval(switchImgAndMsg, 5000);  // Switch every 5 seconds.
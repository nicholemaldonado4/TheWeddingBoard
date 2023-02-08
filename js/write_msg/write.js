const boardMsg = document.querySelector('textarea[name="board_msg"]');
const charLeft = document.getElementById('char-left');

function UpdateMsgCharCount() {
    var numChars = this.value.length;
    if (numChars > 200) {
        this.value = this.value.substring(0, 200);
    }
    charLeft.innerHTML = 200 - this.value.length;
}

boardMsg.addEventListener("input", UpdateMsgCharCount, false);

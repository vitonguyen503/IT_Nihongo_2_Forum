document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById("postModal");
    const newPostBtn = document.getElementById("newPostButton");
    const modal1 = document.getElementById("postModal1");
    const openPopupButtons  = document.querySelectorAll(".openPopup");
    const closeBtn = document.querySelector(".close");
    const emoteSpan = document.querySelector(".emote");
    const emojiPicker = document.getElementById("emojiPicker");
    const postContent = document.getElementById("postContent");


    // Open modal when "New Post" button is clicked
    newPostBtn.addEventListener('click', function() {
        modal.style.display = "flex";
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = "none";
    });


    openPopupButtons.forEach(button => {
        button.addEventListener('click', function() {
            modal1.style.display = "flex";  
        });
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal1) {
            modal1.style.display = "none";  
        }
    });

    // Close modal when clicking outside of modal content
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
        if (event.target === modal1) {
            modal1.style.display = "none";
        }
    });

    // Toggle emoji picker visibility when clicking on the emote span
    emoteSpan.addEventListener('click', function(event) {
        if (emojiPicker.style.display === "block") {
            emojiPicker.style.display = "none";
        } else {
            displayEmojiList(); // Display the list of emojis
            emojiPicker.style.display = "block";
            // Position the emoji picker inside the modal content
            const rect = emoteSpan.getBoundingClientRect();
            const modalRect = document.querySelector(".modal-content").getBoundingClientRect();
            emojiPicker.style.top = `${rect.bottom - modalRect.top}px`; // Position relative to modal content
            emojiPicker.style.left = `${rect.left - modalRect.left}px`;
        }
        event.stopPropagation(); // Prevent the click event from closing the emoji picker
    });

    // Hide emoji picker when clicking outside of it
    window.addEventListener('click', function(event) {
        if (!emojiPicker.contains(event.target) && event.target !== emoteSpan) {
            emojiPicker.style.display = "none";
        }
    });

    // Function to display emojis in the picker
    function displayEmojiList() {
        emojiPicker.innerHTML = ""; // Clear the previous list
        faceEmojis.forEach(emoji => {
            const emojiElement = document.createElement("span");
            emojiElement.className = "emoji";
            emojiElement.textContent = emoji;
            emojiElement.addEventListener('click', function() {
                insertEmoji(emoji);
            });
            emojiPicker.appendChild(emojiElement);
        });

        // Add more emoji categories similarly...
    }

    // Function to insert emoji at the cursor position in the textarea
    function insertEmoji(emoji) {
        const startPos = postContent.selectionStart;
        const endPos = postContent.selectionEnd;
        const textBefore = postContent.value.substring(0, startPos);
        const textAfter = postContent.value.substring(endPos, postContent.value.length);

        postContent.value = textBefore + emoji + textAfter;
        postContent.selectionStart = postContent.selectionEnd = startPos + emoji.length;

        emojiPicker.style.display = "none"; // Hide the emoji picker
    }
});


// List of emojis to display
const faceEmojis = [
"😇", "🤩", "😆", "😅", "🤣", "😏", "🙃", "😋", "🤤", "😛", "😝", "😜", 
"😑", "😒", "🙄", "😬", "🤥", "🤐", "🤢", "🤮", "😵", "🤯", "🥴", "😲", "🥵", 
"🥶", "😶‍🌫️", "😳", "😰", "😨", "😧", "😦", "😮", "😯", "😴", "🤒", "🤕", "🤧", 
"😷", "🤠", "🥳", "🥺", "😤", "😩", "😫", "😖", "😣", "😔", "😞", "😢", "😭"
];
const handEmojis = [
"👋", "🤚", "🖐️", "✋", "🖖", "👌", "🤏", "✌️", "🤞", "🤟", "🤘", "🤙", 
"👈", "👉", "👆", "👇", "👍", "👎", "✊", "👊", "👏", "🙌", "👐", "🤲", "🙏", 
"✍️", "💅", "🤳", "💪", "🦾", "✋🏽", "👍🏾", "👎🏼"
];
const heartEmojis = [
"❤️", "🧡", "💛", "💚", "💙", "💜", "🖤", "🤍", "🤎", "💔", "❣️", "💕", "💞", 
"💓", "💗", "💖", "💘", "💝", "💟", "💌"
];
const animalEmojis = [
"🐶", "🐱", "🐭", "🐹", "🐰", "🦊", "🐻", "🐼", "🐨", "🐯", "🦁", "🐮", "🐷", 
"🐸", "🐵", "🐔", "🐧", "🐦", "🐤", "🦆", "🦅", "🦉", "🦇", "🐺", "🐗", "🐴", 
"🦄", "🐝", "🐛", "🦋", "🐌", "🐞", "🐜", "🦗", "🕷️", "🦂", "🐢", "🐍", "🦎", 
"🦖", "🦕", "🐙", "🦑", "🦀", "🐡", "🐠", "🐟", "🐬", "🐳", "🐋", "🦈"
];
const foodEmojis = [
"🍏", "🍎", "🍐", "🍊", "🍋", "🍌", "🍉", "🍇", "🍓", "🫐", "🍈", "🍒", "🍑", 
"🥭", "🍍", "🥥", "🥝", "🍅", "🍆", "🥑", "🥦", "🥬", "🥒", "🌶️", "🌽", "🥕", 
"🫒", "🧄", "🧅", "🥔", "🍠", "🥐", "🥯", "🍞", "🥖", "🥨", "🧀", "🍗", "🍖", 
"🍤", "🍳", "🍔", "🍟", "🍕", "🌭", "🥪", "🌮", "🌯", "🥙", "🧆", "🥘", "🍝", 
"🍜", "🍲", "🍣", "🍱", "🍛", "🍚", "🍙", "🍘", "🍥", "🥠", "🥟", "🍢", "🍡", 
"🍧", "🍨", "🍦", "🥧", "🍰", "🎂", "🧁", "🍮", "🍭", "🍬", "🍫", "🍿", "🧃", 
"🥤", "🧋", "🍵", "🍶", "🍾", "🍷", "🍸", "🍹", "🍺", "🍻", "🥂", "🥃", "🧉"
];
const natureEmojis = [
"🌵", "🎄", "🌲", "🌳", "🌴", "🌱", "🌿", "☘️", "🍀", "🎋", "🍂", "🍁", "🍄", 
"🌾", "💐", "🌷", "🌹", "🥀", "🌻", "🌼", "🌸", "🌺", "🌎", "🌍", "🌏", "🌕", 
"🌖", "🌗", "🌘", "🌑", "🌒", "🌓", "🌔", "🌚", "🌝", "🌞", "⭐", "🌟", "🌠", 
"☀️", "⛅", "🌤", "🌦", "🌧", "⛈", "🌩", "🌨", "☁️", "🌫", "🌪", "🌬", "🌀", 
"🌈", "☔", "⚡", "❄️", "☃️", "⛄", "🔥", "💧", "🌊"
];
const transportEmojis = [
"🚗", "🚕", "🚙", "🚌", "🚎", "🏎️", "🚓", "🚑", "🚒", "🚐", "🚚", "🚛", "🚜", 
"🛺", "🚲", "🛴", "🛵", "🏍️", "🛶", "⛵", "🛳️", "🚢", "✈️", "🛩️", "🚁", 
"🚀", "🛸", "🛰️", "🚨", "🚔", "🚍", "🚠", "🚡", "🚟", "🚃", "🚋", "🚞", "🚝", 
"🚄", "🚅", "🚈", "🚂", "🛤️", "🛣️"
];
const activityEmojis = [
"⚽", "🏀", "🏈", "⚾", "🥎", "🎾", "🏐", "🏉", "🎱", "🎳", "🏓", "🏸", "🥅", 
"🏒", "🏑", "🏏", "⛳", "🪁", "🏹", "🎣", "🤿", "🥊", "🥋", "🎽", "🛹", "🛷", 
"⛸️", "🥌", "🎿", "⛷️", "🏂", "🪂", "🏋️‍♀️", "🤼‍♂️", "🤸‍♂️", "⛹️‍♀️", 
"🏌️‍♀️", "🏄‍♂️", "🚣‍♀️", "🏊‍♀️", "🤽‍♂️", "🚴‍♀️", "🚵‍♀️", "🏇", "🧘‍♂️", 
"🧗‍♀️", "🏋️‍♂️"
];
            

// Close modal when clicking outside of modal content
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

// Toggle emoji picker visibility when clicking on the emote span


// Function to display emojis in the picker
function displayEmojiList() {
    emojiPicker.innerHTML = ""; // Clear the previous list
    faceEmojis.forEach(emoji => {
        const emojiElement = document.createElement("span");
        emojiElement.className = "emoji";
        emojiElement.textContent = emoji;
        emojiElement.onclick = function() {
            insertEmoji(emoji);
        };
        emojiPicker.appendChild(emojiElement);
    });

    handEmojis.forEach(emoji => {
        const emojiElement = document.createElement("span");
        emojiElement.className = "emoji";
        emojiElement.textContent = emoji;
        emojiElement.onclick = function() {
            insertEmoji(emoji);
        };
        emojiPicker.appendChild(emojiElement);
    });
    heartEmojis.forEach(emoji => {
        const emojiElement = document.createElement("span");
        emojiElement.className = "emoji";
        emojiElement.textContent = emoji;
        emojiElement.onclick = function() {
            insertEmoji(emoji);
        };
        emojiPicker.appendChild(emojiElement);
    });
    animalEmojis.forEach(emoji => {
        const emojiElement = document.createElement("span");
        emojiElement.className = "emoji";
        emojiElement.textContent = emoji;
        emojiElement.onclick = function() {
            insertEmoji(emoji);
        };
        emojiPicker.appendChild(emojiElement);
    });
    foodEmojis.forEach(emoji => {
        const emojiElement = document.createElement("span");
        emojiElement.className = "emoji";
        emojiElement.textContent = emoji;
        emojiElement.onclick = function() {
            insertEmoji(emoji);
        };
        emojiPicker.appendChild(emojiElement);
    });
    natureEmojis.forEach(emoji => {
        const emojiElement = document.createElement("span");
        emojiElement.className = "emoji";
        emojiElement.textContent = emoji;
        emojiElement.onclick = function() {
            insertEmoji(emoji);
        };
        emojiPicker.appendChild(emojiElement);
    });
    transportEmojis.forEach(emoji => {
        const emojiElement = document.createElement("span");
        emojiElement.className = "emoji";
        emojiElement.textContent = emoji;
        emojiElement.onclick = function() {
            insertEmoji(emoji);
        };
        emojiPicker.appendChild(emojiElement);
    });
    activityEmojis.forEach(emoji => {
        const emojiElement = document.createElement("span");
        emojiElement.className = "emoji";
        emojiElement.textContent = emoji;
        emojiElement.onclick = function() {
            insertEmoji(emoji);
        };
        emojiPicker.appendChild(emojiElement);
    });
}

// Function to insert emoji at the cursor position in the textarea
function insertEmoji(emoji) {
    const startPos = postContent.selectionStart;
    const endPos = postContent.selectionEnd;
    const textBefore = postContent.value.substring(0, startPos);
    const textAfter = postContent.value.substring(endPos, postContent.value.length);

    postContent.value = textBefore + emoji + textAfter;
    postContent.selectionStart = postContent.selectionEnd = startPos + emoji.length;

    emojiPicker.style.display = "none"; // Hide the emoji picker
}

// Hide emoji picker when clicking outside of it
window.onclick = function(event) {
    if (!emojiPicker.contains(event.target) && event.target !== emoteSpan) {
        emojiPicker.style.display = "none";
    }
}

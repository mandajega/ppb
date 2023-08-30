// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// trackScript.js

// Function to add a diaper change to the log
function addDiaperChange() {
    const dateInput = document.getElementById('date');
    const poopCheckbox = document.getElementById('poop');
    const wetCheckbox = document.getElementById('wet');
    const notesTextarea = document.querySelector('.wd-text');

    const date = dateInput.value;
    const poop = poopCheckbox.checked;
    const wet = wetCheckbox.checked;
    const notes = notesTextarea.value;

    const logItem = document.createElement('li');
    logItem.textContent = `Date: ${date}  | Poop: ${poop ? 'Yes' : 'No'}  | Wet: ${wet ? 'Yes' : 'No'}  | Notes: ${notes}`;

    const log = document.getElementById('log');
    log.appendChild(logItem);
  
    clearFields();
}

// Function to clear input fields after adding a diaper change
function clearFields() {
    document.getElementById('date').value = '';
    document.getElementById('poop').checked = false;
    document.getElementById('wet').checked = false;
    document.querySelector('.wd-text').value = '';
}
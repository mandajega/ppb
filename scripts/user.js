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

/*user navigation part common option*/
// If you want to add additional functionality, such as clicking the user picture to toggle visibility, you can use JavaScript:
const userPic = document.querySelector('.user-pic');
const userInfo = document.querySelector('.user-info');

userPic.addEventListener('click', () => {
  userInfo.style.display = userInfo.style.display === 'block' ? 'none' : 'block';
});

//for edit button in search icon
const nameEditIcon = document.querySelector('.user-name .edit-icon');
const phoneNumberEditIcon = document.querySelector('.user-contact .edit-icon:first-child');
const emailEditIcon = document.querySelector('.user-contact .edit-icon:last-child');
const userName = document.querySelector('.user-name u');
const userPhoneNumber = document.querySelector('.user-contact span:first-child');
const userEmail = document.querySelector('.user-contact span:last-child');

const editName = () => {
  const newName = prompt('Enter new name:', userName.textContent);
  if (newName !== null && newName.trim() !== '') {
    userName.textContent = newName;
  }
};

const editPhoneNumber = () => {
  const newPhoneNumber = prompt('Enter new phone number:');
  if (newPhoneNumber !== null && newPhoneNumber.trim() !== '') {
    userPhoneNumber.textContent = newPhoneNumber;
    userPhoneNumber.previousSibling.textContent = 'Phone: '; // Display the label "Phone"
    userPhoneNumber.previousSibling.style.display = 'inline'; // Show the label "Phone"
  }
};

const editEmail = () => {
  const newEmail = prompt('Enter new email address:');
  if (newEmail !== null && newEmail.trim() !== '') {
    userEmail.textContent = newEmail;
    userEmail.previousSibling.textContent = 'E-mail: '; // Hide the label "Email"
    userPhoneNumber.previousSibling.style.display = 'inline'; // Show the label "Phone"
  }
};

nameEditIcon.addEventListener('click', editName);
phoneNumberEditIcon.addEventListener('click', editPhoneNumber);
emailEditIcon.addEventListener('click', editEmail);

//logo
const logoContainer = document.querySelector('.logo-container');
    const logoChangeButton = document.querySelector('.logo-change-button');
    const logoUpload = document.getElementById('logo-upload');
    const logoImage = document.querySelector('.logo-image');

    logoContainer.addEventListener('click', function() {
      logoUpload.click();
    });

    logoChangeButton.addEventListener('click', function(event) {
      event.stopPropagation();
    });

    logoUpload.addEventListener('change', function() {
      const file = this.files[0];
      const reader = new FileReader();

      reader.onload = function(e) {
        logoImage.src = e.target.result;
      };

      reader.readAsDataURL(file);
    });

    logoContainer.classList.remove('show-change');


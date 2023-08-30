//this is for heading and content part
const headings = document.getElementsByClassName('heading');

for (let heading of headings) {
  heading.addEventListener('click', function() {
    this.classList.toggle('open');
    const content = this.nextElementSibling;
    if (content.style.display === 'block') {
      content.style.display = 'none';
    } else {
      content.style.display = 'block';
    }
  });
}
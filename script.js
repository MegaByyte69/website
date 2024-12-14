// Simple function to simulate booking a tutor
function bookTutor() {
    alert("Thank you for booking a tutor with Gurukul Academy! We will contact you soon.");
}

// Contact form validation
const contactForm = document.getElementById('contactForm');
contactForm.addEventListener('submit', function (e)) {
    e.preventDefault();
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    if (name && email && message) {
        alert('Thank you');
    }
}

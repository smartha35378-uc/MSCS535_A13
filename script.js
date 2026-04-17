function showMessage(message) {
  const formMessage = document.getElementById("formMessage");
  formMessage.textContent = message;
  formMessage.classList.add("error");
}

function clearMessage() {
  const formMessage = document.getElementById("formMessage");
  formMessage.textContent = "";
  formMessage.classList.remove("error");
}

function validateForm() {
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  clearMessage();

  if (!name || !email || !password) {
    showMessage("All fields are required.");
    return false;
  }

  if (name.length < 2) {
    showMessage("Name must be at least 2 characters long.");
    return false;
  }

  if (!emailPattern.test(email)) {
    showMessage("Enter a valid email address.");
    return false;
  }

  if (password.length < 8) {
    showMessage("Password must be at least 8 characters long.");
    return false;
  }

  return true;
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("registrationForm");

  form.addEventListener("submit", (event) => {
    if (!validateForm()) {
      event.preventDefault();
    }
  });
});

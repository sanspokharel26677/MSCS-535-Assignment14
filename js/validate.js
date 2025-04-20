// validate.js
// Validates the login form before submission

function validateForm() {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
  
    if (username === "" || password === "") {
      alert("Username and password cannot be empty.");
      return false;
    }
  
    return true;
  }
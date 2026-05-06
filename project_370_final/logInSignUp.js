function showLogin() {
    document.getElementById("loginForm").classList.add("active-form");
    document.getElementById("signupForm").classList.remove("active-form");
}

function showSignup() {
    document.getElementById("signupForm").classList.add("active-form");
    document.getElementById("loginForm").classList.remove("active-form");
}
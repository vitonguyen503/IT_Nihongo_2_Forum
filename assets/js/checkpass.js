// Hàm để chuyển đổi mật khẩu giữa dạng ẩn và hiện
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}

// Hàm kiểm tra tính hợp lệ của mật khẩu
function isValidPassword(password) {
    const minLength = 8;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumbers = /\d/.test(password);
    const hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    
    // Kiểm tra tất cả điều kiện mật khẩu
    return password.length >= minLength && hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChars;
}

// Thêm sự kiện cho ô nhập mật khẩu
document.getElementById("password").addEventListener("input", function() {
    const password = this.value;
    const passwordError = document.getElementById("password-error");

    if (!isValidPassword(password)) {
        passwordError.style.display = 'block'; // Hiện thông báo lỗi
        this.classList.add("invalid");
        this.classList.remove("valid");
    } else {
        passwordError.style.display = 'none'; // Ẩn thông báo lỗi
        this.classList.add("valid");
        this.classList.remove("invalid");
    }
});

// Thêm sự kiện cho ô nhập lại mật khẩu
document.getElementById("re-password").addEventListener("input", function() {
    const password = document.getElementById("password").value;
    const rePassword = this.value;
    const mismatchError = document.getElementById("mismatch-error");

    // Reset class và thông báo
    this.classList.remove("valid", "invalid");
    mismatchError.style.display = 'none';

    // Kiểm tra nếu mật khẩu khớp
    if (rePassword === password) {
        this.classList.add("valid");
    } else {
        this.classList.add("invalid");
        mismatchError.style.display = 'block'; // Hiện thông báo không khớp
    }
});

// Ngăn gửi form nếu mật khẩu không hợp lệ
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    const password = document.getElementById("password").value;
    const passwordError = document.getElementById("password-error");

    // Nếu mật khẩu không hợp lệ, ngăn gửi form
    if (!isValidPassword(password)) {
        event.preventDefault(); // Ngăn gửi form
        passwordError.style.display = 'block'; // Hiện thông báo lỗi
    }
});
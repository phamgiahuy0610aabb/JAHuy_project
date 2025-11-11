<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Classic Medical Login</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Lora&display=swap" rel="stylesheet">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Lora', serif;
        background: url('https://images.unsplash.com/photo-1560243563-062bfc001d68?auto=format&fit=crop&w=1770&q=80') no-repeat center center/cover;
        background-attachment: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #3e2c1a;
    }

    .login-container {
        background: rgba(255, 249, 236, 0.95);
        border: 2px solid #bfa073;
        border-radius: 12px;
        box-shadow: 0 0 30px rgba(0,0,0,0.3);
        padding: 45px 50px;
        width: 360px;
        text-align: center;
        backdrop-filter: blur(3px);
        position: relative;
    }

    .login-container::before {
        content: "⚕";
        position: absolute;
        top: -35px;
        left: calc(50% - 20px);
        font-size: 32px;
        color: #8b6f47;
        background: rgba(255, 249, 236, 0.9);
        border-radius: 50%;
        padding: 5px 10px;
        border: 1px solid #bfa073;
    }

    h2 {
        font-family: 'Playfair Display', serif;
        color: #5a3e1b;
        font-size: 28px;
        margin-bottom: 25px;
        letter-spacing: 1px;
    }

    label {
        display: block;
        text-align: left;
        font-weight: bold;
        color: #3e2c1a;
        margin-top: 15px;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #bfa073;
        border-radius: 6px;
        background-color: #fffef9;
        font-size: 16px;
        outline: none;
        transition: border 0.3s, box-shadow 0.3s;
    }

    input:focus {
        border-color: #8b6f47;
        box-shadow: 0 0 8px #c7a870;
    }

    button {
        margin-top: 25px;
        width: 100%;
        padding: 12px;
        background-color: #8b6f47;
        color: #fffaf1;
        border: none;
        border-radius: 6px;
        font-family: 'Playfair Display', serif;
        font-size: 17px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    button:hover {
        background-color: #6f5535;
        transform: scale(1.04);
    }

    .footer {
        margin-top: 20px;
        font-size: 14px;
        color: #5c4026;
    }

    .footer a {
        color: #8b6f47;
        text-decoration: none;
        font-weight: bold;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    /* Hiệu ứng xuất hiện mờ dần */
    .fade-in {
        opacity: 0;
        transform: translateY(15px);
        transition: opacity 1s ease, transform 1s ease;
    }
    .fade-in.show {
        opacity: 1;
        transform: translateY(0);
    }

</style>
</head>
<body>

<div class="login-container fade-in">
    <h2>Classic Medical Institute</h2>
    <form id="loginForm">
        <label for="username">Username</label>
        <input type="text" id="username" placeholder="Enter your name">

        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter password">

        <button type="submit">Sign In</button>
    </form>

    <div class="footer">
        <p>Forgot password? <a href="#">Recover</a></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function(){
    // hiệu ứng hiện dần khi tải trang
    setTimeout(function(){
        $(".fade-in").addClass("show");
    }, 200);

    $("#loginForm").submit(function(e){
        e.preventDefault();
        let user = $("#username").val().trim();
        let pass = $("#password").val().trim();

        if(user === "" || pass === ""){
            alert("Please fill in all fields!");
            return;
        }

        alert("Welcome, Dr. " + user + " ⚕");
        // Thêm AJAX call tới API xử lý đăng nhập tại đây nếu cần
    });
});
</script>

</body>
</html>

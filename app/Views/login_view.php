<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(-45deg, #1e3c72, #2a5298, #1e3c72, #2a5298);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      position: relative;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    #particles-js {
      position: absolute;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    .container {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 0 30px 5px #0003;
      overflow: hidden;
      width: 700px;
      max-width: 95%;
      display: flex;
      flex-direction: row;
    }

    .left {
      background: linear-gradient(135deg,rgb(19, 92, 250),rgb(0, 66, 180));
      color: #fff;
      flex: 1;
      padding: 40px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }

    .left h2 {
      font-size: 2.5em;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .left p {
      font-size: 1em;
      text-align: center;
      line-height: 1.5em;
      max-width: 250px;
    }

    .right {
      background: #f8faff;
      flex: 1;
      padding: 40px 30px;
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
    }

    .right h2 {
      margin-bottom: 25px;
      color: #1e3c72;
      text-align: center;
    }

    .right form {
      display: flex;
      flex-direction: column;
    }

    .right input[type="text"],
    .right input[type="password"] {
      padding: 10px 15px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      outline: none;
    }

    .right button {
      padding: 10px;
      border: none;
      border-radius: 8px;
      background-color:rgb(19, 92, 250);
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .right button:hover {
      background-color:rgb(0, 64, 173);
    }

    .extra {
      margin-top: 10px;
      display: flex;
      justify-content: space-between;
      font-size: 0.9em;
    }

    .extra a {
      text-decoration: none;
      color: #1e3c72;
    }

    .divider {
      margin: 15px 0;
      text-align: center;
      font-size: 0.8em;
      color: #999;
    }

    .other-login {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: #f5f5f5;
      cursor: pointer;
      text-align: center;
    }

    .signup-text {
      text-align: center;
      margin-top: 15px;
      font-size: 0.9em;
    }

    .signup-text a {
      color: #1e3c72;
      text-decoration: none;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        width: 90%;
        border-radius: 12px;
      }

      .left, .right {
        border-radius: 0;
        padding: 30px 20px;
      }

      .left {
        border-bottom: 1px solid #fff5;
      }
    }
  </style>
</head>
<body>

  <div id="particles-js"></div>

  <div class="container">
    <div class="left">
      <h2>WELCOME</h2>
      <p>Log in to see Laptops that might become yours!</p>
    </div>
    <div class="right">
      <h2>Sign in</h2>
      <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
      <?php endif; ?>
      <form action="<?= site_url('/login') ?>" method="post">
        <?= csrf_field() ?>
        <input type="text" name="username" placeholder="User Name" required>
        <input type="password" name="password" placeholder="Password" required>
        <div class="extra">
          <label><input type="checkbox"> Remember me</label>
          <a href="#">Forgot Password?</a>
        </div>
        <button type="submit">Sign in</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script>
    particlesJS("particles-js", {
      "particles": {
        "number": { "value": 40 },
        "color": { "value": "#ffffff" },
        "shape": { "type": "circle" },
        "opacity": {
          "value": 0.2,
          "random": true,
          "anim": { "enable": true, "speed": 0.5, "opacity_min": 0.1, "sync": false }
        },
        "size": {
          "value": 80,
          "random": true
        },
        "move": {
          "enable": true,
          "speed": 0.6,
          "direction": "none",
          "random": true,
          "out_mode": "out"
        }
      },
      "interactivity": {
        "events": {
          "onhover": { "enable": false },
          "onclick": { "enable": false }
        }
      },
      "retina_detect": true
    });
  </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
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

    .register-form {
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.15);
      width: 350px;
      z-index: 1;
    }

    .register-form h2 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      font-size: 1.6em;
    }

    .register-form input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-family: 'Poppins', sans-serif;
    }

    .register-form button {
      width: 100%;
      padding: 10px;
      background: #1e3c72;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 1em;
      cursor: pointer;
    }

    .register-form a {
      display: block;
      text-align: center;
      margin-top: 10px;
      color: #1e3c72;
      text-decoration: none;
    }

    .register-form p {
      color: red;
      text-align: center;
    }
  </style>
</head>
<body>

  <div id="particles-js"></div>

  <div class="register-form">
    <h2>Daftar Akun</h2>
    <?php if (session()->getFlashdata('error')): ?>
      <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    <form action="<?= site_url('/register') ?>" method="post">
      <?= csrf_field() ?>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Daftar</button>
    </form>
    <a href="<?= site_url('/login') ?>">Sudah punya akun? Login</a>
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

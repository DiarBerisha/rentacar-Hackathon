<?php include_once "config.php";
include_once "header.php"; ?>

<body>
  <form action="loginLogic.php" class="login" method="POST">
    <h2>Kyçu</h2>
    <p>Nese nuk kini nje llogari ne <a href="index.php">Rent A Car Diari</a> <a href="register.php" class="reg">regjistrohuni </a>tani!</p>
    <input type="email" name="email" class="email-l" placeholder="Email" required>
    <input type="password" name="password" class="password-l" placeholder="Fjalkalimi" required>
    <p><a href="forgot-password.html">Kam harruar fjalkalimin!</a></p>
    <button type="submit" class="button-l">Kyçu</button>
  </form>
</body>
<?php include_once "config.php";
include_once "header.php"; ?>

<style>
  body {
    background-color: #f9f9f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
  }

  form.login {
    max-width: 400px;
    margin: 50px auto 100px;
    background: white;
    padding: 30px 40px;
    border-radius: 8px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.1);
    display: flex;
    flex-direction: column;
  }

  form.login h2 {
    color: #f7941d;
    margin-bottom: 25px;
    font-weight: 700;
    font-size: 28px;
    text-align: center;
  }

  form.login p {
    font-size: 14px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
  }

  form.login p a {
    color: #f7941d;
    text-decoration: none;
    font-weight: 600;
    margin-left: 4px;
  }


  form.login p a:hover {
    text-decoration: underline;
  }

  form.login input[type="email"],
  form.login input[type="password"] {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 20px;
    font-size: 16px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    transition: border-color 0.3s ease;
  }

  form.login input[type="email"]:focus,
  form.login input[type="password"]:focus {
    border-color: #f7941d;
    outline: none;
  }

  form.login .button-l {
    background-color: #f7941d;
    border: none;
    padding: 14px 0;
    color: white;
    font-size: 18px;
    font-weight: 700;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
  }

  form.login .button-l:hover {
    background-color: #e88312;
  }

  form.login p.forgot-password {
    margin-top: 10px;
    text-align: center;
  }

  form.login p.forgot-password a {
    font-size: 14px;
    color: #f7941d;
    font-weight: 600;
  }

  form.login p.forgot-password a:hover {
    text-decoration: underline;
  }

  @media (max-width: 480px) {
    form.login {
      margin: 30px 20px 60px;
      padding: 25px 20px;
    }

    form.login h2 {
      font-size: 24px;
    }
  }
</style>
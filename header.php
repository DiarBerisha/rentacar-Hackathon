<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Nav Bar</title>
  <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
  margin: 0;
  font-family: Arial, sans-serif;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #333;
  padding: 14px 20px;
}

.logo {
  color: #fff;
  font-size: 20px;
  font-weight: bold;
}

.nav-links {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}

.nav-links li {
  margin-left: 20px;
}

.nav-links a {
  color: #fff;
  text-decoration: none;
  padding: 8px;
  transition: background 0.3s;
}

.nav-links a:hover {
  background-color: #575757;
  border-radius: 4px;
}

</style>
<body>
  <nav class="navbar">
    <div class="logo">Rent A Car Diari</div>
    <ul class="nav-links">
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>
</body>
</html>

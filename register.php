<?php include_once "config.php"; ?>
<?php include_once "header.php"; ?>

<style>
  body {
    background-image: url('https://www.mbusa.com/content/dam/mb-nafta/us/myco/my25/gls-class/gls-suv/gallery/series/gallery-class/2025-GLS-SUV-GAL-002-K-FE-DR.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }

  form.registration-form {
    max-width: 900px;
    margin: 40px auto;
    padding: 30px;
    background: rgba(255, 255, 255, 0.85);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
    font-family: Arial, sans-serif;
  }

  form.registration-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #f7941d;
    font-weight: 700;
  }

  form.registration-form input {
    padding: 12px;
    margin: 8px 0;
    width: 100%;
    border-radius: 6px;
    border: 1.5px solid #ccc;
    font-size: 16px;
    box-sizing: border-box;
  }

  .form-columns {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
  }

  .form-column {
    flex: 1 1 45%;
  }

  form.registration-form button {
    margin-top: 25px;
    background-color: #f7941d;
    color: white;
    font-weight: 700;
    font-size: 18px;
    border: none;
    padding: 14px 0;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
  }

  form.registration-form button:hover {
    background-color: #e88312;
  }

  @media (max-width: 700px) {
    .form-columns {
      flex-direction: column;
    }

    .form-column {
      flex: 1 1 100%;
    }
  }
</style>

<form class="registration-form" method="POST" action="registerLogic.php">
  <h2>Krijo Llogari</h2>

  <input type="email" name="email" placeholder="Email*" required />
  <input type="password" name="password" placeholder="Fjalëkalimi*" required />
  <input type="password" name="confirm_password" placeholder="Konfirmo Fjalëkalimin*" required />

  <div class="form-columns">
    <div class="form-column">
      <h3>Të dhënat e shoferit</h3>
      <input type="text" name="emri" placeholder="Emri*" required />
      <input type="text" name="mbiemri" placeholder="Mbiemri*" required />
    
      <input type="date" name="birthday" id="birthday"  placeholder="Data e Lindjes*" required/>
      <input type="text" name="patentshoferi" placeholder="Patent Shoferi*" required />
    </div>

    <div class="form-column">
      <h3>Kontaktet</h3>
      <input type="text" name="numri_telefonit" placeholder="Numri i telefonit*" required />
      <input type="text" name="adresa" placeholder="Adresa*" required />
      <input type="text" name="qyteti" placeholder="Qyteti*" required />
      <input type="text" name="shteti" placeholder="Shteti*" required />
    </div>
  </div>

  <button type="submit">Regjistrohu</button>
</form>

<?php include_once "footer.php"; ?>

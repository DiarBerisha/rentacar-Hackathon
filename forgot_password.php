<?php 
include_once "header.php";  // Your existing header.php outputs doctype, head, body start, navbar etc.
?>

<style>
  /* Just the content styles, no html/body styles */
  main {
    padding: 80px 30px 60px;
    min-height: calc(100vh - 140px);
    background: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: flex-start;
  }

  .forgot-container {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    width: 320px;
    text-align: center;
  }

  input[type="email"] {
    width: 100%;
    padding: 10px;
    margin: 15px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  button {
    width: 100%;
    padding: 12px;
    background-color: #f7941d;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #e88312;
  }

  p.message {
    margin-top: 15px;
    color: green;
  }
</style>

<main>
  <div class="forgot-container">
    <h2>Forgot Password</h2>
    <form id="forgotForm">
      <input type="email" id="email" placeholder="Enter your email" required />
      <button type="submit">Send Reset Link</button>
    </form>
    <p id="confirmationMessage" class="message"></p>
  </div>
</main>

<script>
  document.getElementById('forgotForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const emailInput = document.getElementById('email');
    const msg = document.getElementById('confirmationMessage');

    if (emailInput.value.trim() === '') {
      msg.textContent = "Please enter your email.";
      msg.style.color = 'red';
      return;
    }

    // Simulate sending email
    msg.textContent = "If the email is registered, a reset link has been sent.";
    msg.style.color = 'green';
    emailInput.value = '';
  });
</script>

<?php 
include_once "footer.php"; // Your existing footer.php closes body and html tags
?>

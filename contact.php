<?php include_once "header.php"; ?>

<style>
  /* Reset & base */
  * {
    box-sizing: border-box;
  }
  body, html {
    margin: 0; 
    padding: 0; 
    height: 100%;
    display: flex;
    flex-direction: column;
    font-family: Arial, sans-serif;
  }

  /* Header & Footer full width */
  header, footer {
    width: 100%;
    background: #f7941d;
    color: white;
    padding: 15px 30px;
    text-align: center;
  }

  /* Main content container centers content and fills available space */
  main {
    flex: 1 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
    background-color: #f4f4f4;
  }

  /* Inner content box */
  .content-wrapper {
    max-width: 600px;
    width: 100%;
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
  }

  /* Contact form styling */
  form.contact-form {
    display: flex;
    flex-direction: column;
  }

  form.contact-form label {
    margin-bottom: 6px;
    font-weight: 600;
  }

  form.contact-form input,
  form.contact-form textarea {
    padding: 10px;
    margin-bottom: 20px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    font-family: inherit;
    resize: vertical;
  }

  form.contact-form textarea {
    min-height: 120px;
  }

  form.contact-form button {
    padding: 14px 0;
    background-color: #f7941d;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: 700;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  form.contact-form button:hover {
    background-color: #e88312;
  }
</style>

<main>
  <div class="content-wrapper">
    <h1>Contact Us</h1>
    <form class="contact-form" method="POST" action="contact_process.php">
      <label for="name">Name *</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email *</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message *</label>
      <textarea id="message" name="message" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>
</main>

<?php include_once "footer.php"; ?>

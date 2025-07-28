<?php
require_once 'connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!isset($db)) {
        $error = 'Erreur: Impossible de se connecter à la base de données.';
    } else {
        try {
            $sql = "SELECT password FROM authentification WHERE email = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($password, $row['password'])) {
                header('Location: index.html');
                exit();
            } else {
                $error = "Identifiants incorrects. Veuillez vous inscrire si vous n'avez pas de compte.";
                // Optional: Log failed attempt
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion : " . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SONO Restaurant | Login</title>
  <link rel="stylesheet" href="Register_Login.css">
  <link rel="icon" href="logo-removebg.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>

<body background="fondec2.jpg">

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center" style="font-size:1.15rem; background: #fff0f0; color: #a4161a; border-radius: 12px; margin: 32px auto; border: 2px solid #ffb3b3; box-shadow: 0 2px 8px #ffb3b333; max-width: 600px;">
      <i class="bi bi-x-circle-fill" style="font-size:2.2rem; color:#d00000;"></i><br>
      <strong><?= htmlspecialchars($error) ?></strong><br>
      <span style="font-size:0.95rem; color:#a4161a;">Redirection vers la page d'inscription...</span>
    </div>
    <script>setTimeout(() => { window.location.href = 'Register.php'; }, 2500);</script>
  <?php endif; ?>

  <form class="modern-form" method="POST" action="">
    <div class="form-title">
      <img src="logo.jpeg" alt="Logo" class="form-logo" />Connexion
    </div>

    <div class="form-body">
      <div class="input-group">
        <div class="input-wrapper">
          <svg fill="none" viewBox="0 0 24 24" class="input-icon">
            <circle stroke-width="1.5" stroke="currentColor" r="4" cy="8" cx="12"></circle>
            <path stroke-linecap="round" stroke-width="1.5" stroke="currentColor" d="M5 20C5 17.2386 8.13401 15 12 15C15.866 15 19 17.2386 19 20"></path>
          </svg>
          <input name="email" required placeholder="Adresse e-mail" class="form-input" type="email" />
        </div>
      </div>

      <div class="input-group">
        <div class="input-wrapper">
          <svg fill="none" viewBox="0 0 24 24" class="input-icon">
            <path stroke-width="1.5" stroke="currentColor" d="M12 10V14M8 6H16C17.1046 6 18 6.89543 18 8V16C18 17.1046 17.1046 18 16 18H8C6.89543 18 6 17.1046 6 16V8C6 6.89543 6.89543 6 8 6Z"></path>
          </svg>
          <input name="password" required placeholder="Mot de passe" class="form-input" type="password" />
          <button class="password-toggle" type="button">
            <svg fill="none" viewBox="0 0 24 24" class="eye-icon">
              <path stroke-width="1.5" stroke="currentColor" d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z"></path>
              <circle stroke-width="1.5" stroke="currentColor" r="3" cy="12" cx="12"></circle>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <button class="submit-button" type="submit">
      <span class="button-text">Se connecter</span>
      <div class="button-glow"></div>
    </button>

    <div class="form-footer">
      <a class="login-link" href="Register.php">
        Vous n'avez pas un compte ? <span>Inscrivez-vous</span>
      </a>
    </div>
  </form>

  <script>
    document.querySelector('.modern-form').addEventListener('submit', function(e) {
      const email = this.querySelector('input[name="email"]');
      const password = this.querySelector('input[name="password"]');
      let valid = true;

      email.setCustomValidity('');
      password.setCustomValidity('');

      if (!email.value.match(/^\S+@\S+\.\S+$/)) {
        email.setCustomValidity("Veuillez entrer une adresse e-mail valide.");
        valid = false;
      }

      if (password.value.length < 6) {
        password.setCustomValidity("Le mot de passe doit contenir au moins 6 caractères.");
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
        this.reportValidity();
      }
    });
  </script>
</body>
</html>

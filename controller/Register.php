<?php
// At top of file
$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'connect.php'; // Make sure this defines $db as a PDO instance

    // Sanitize inputs
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$db) {
        $error = 'Database connection failed!';
    } else {
        // Basic validation
        if (strlen($username) < 3 || strlen($password) < 6 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Champs invalides. Vérifiez vos informations.";
        } else {
            try {
                // Check if email already exists
                $stmt = $db->prepare('SELECT id FROM Authentification WHERE email = ?');
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $error = "Cet email est déjà utilisé.";
                } else {
                    // Secure password hash
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert new user
                    $sql = "INSERT INTO Authentification (username, email, password) VALUES (?, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$username, $email, $hashed_password]);

                    header('Location: index.html');
                    exit();
                }
            } catch (PDOException $e) {
                $error = "Erreur serveur: " . htmlspecialchars($e->getMessage());
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SONO Restaurant | Register</title>
  <link rel="stylesheet" href="Register_Login.css">
  <link rel="icon" href="logo-removebg.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>

<body background="fondec2.jpg">

<?php if ($error): ?>
  <div class="alert alert-danger text-center" style="font-size:1.15rem; background: #fff0f0; color: #a4161a; border-radius: 12px; margin-bottom: 32px; border: 2px solid #ffb3b3; box-shadow: 0 2px 8px #ffb3b333;">
    <i class="bi bi-x-circle-fill" style="font-size:2.2rem; color:#d00000;"></i><br>
    <strong><?= htmlspecialchars($error) ?></strong><br>
    <span style="font-size:0.95rem; color:#a4161a;">Assurez-vous que votre email n'est pas déjà utilisé et que tous les champs sont valides.</span>
  </div>
<?php endif; ?>

<form class="modern-form" method="POST" action="">
  <div class="form-title">
    <img src="logo.jpeg" alt="Logo" class="form-logo" />S'inscrire
  </div>

  <div class="form-body">
    <div class="input-group">
      <div class="input-wrapper">
        <input name="username" required placeholder="Nom d'utilisateur" class="form-input" type="text" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" />
      </div>
    </div>

    <div class="input-group">
      <div class="input-wrapper">
        <input name="email" required placeholder="Email" class="form-input" type="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
      </div>
    </div>

    <div class="input-group">
      <div class="input-wrapper">
        <input name="password" required placeholder="Mot de passe" class="form-input" type="password" />
        <button class="password-toggle" type="button">
          <svg fill="none" viewBox="0 0 24 24" class="eye-icon">
            <path stroke-width="1.5" stroke="currentColor" d="M2 12S5 5 12 5s10 7 10 7-3 7-10 7S2 12 2 12z"></path>
            <circle stroke-width="1.5" stroke="currentColor" r="3" cy="12" cx="12"></circle>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <button class="submit-button" type="submit">
    <span class="button-text">Créer un compte</span>
    <div class="button-glow"></div>
  </button>

  <div class="form-footer">
    <a class="login-link" href="login.php">
      Vous avez déjà un compte ? <span>Connectez-vous</span>
    </a>
  </div>
</form>

<script>
  document.querySelector('.modern-form').addEventListener('submit', function(e) {
    const username = this.querySelector('input[name="username"]');
    const email = this.querySelector('input[name="email"]');
    const password = this.querySelector('input[name="password"]');
    let valid = true;

    username.setCustomValidity('');
    email.setCustomValidity('');
    password.setCustomValidity('');

    if (username.value.trim().length < 3) {
      username.setCustomValidity("Le nom d'utilisateur doit contenir au moins 3 caractères.");
      valid = false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
      email.setCustomValidity("Veuillez entrer une adresse email valide.");
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

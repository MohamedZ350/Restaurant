<?php
// Database connection
require "connect.php";

$old_name = '';
$old_email = '';
$old_message = '';
$notification = '';
$notification_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_name = $full_name = trim($_POST['name'] ?? '');
    $old_email = $email = trim($_POST['email'] ?? '');
    $old_message = $message = trim($_POST['message'] ?? '');

    $errors = [];

    // Validate inputs
    if (empty($full_name)) {
        $errors[] = 'Le nom complet est requis.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Un email valide est requis.';
    }
    if (empty($message)) {
        $errors[] = 'Le message ne peut pas être vide.';
    }

    if (empty($errors)) {
        if (!isset($db) || !$db) {
            $notification = 'Erreur de connexion à la base de données.';
            $notification_type = 'danger';
        } else {
            try {
                $stmt = $db->prepare("INSERT INTO Contact (full_name, email, message) VALUES (:full_name, :email, :message)");
                $stmt->bindParam(':full_name', $full_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':message', $message);

                if ($stmt->execute()) {
                    $notification = 'Merci pour votre message ! Nous vous contacterons bientôt.';
                    $notification_type = 'success';

                    $old_name = $old_email = $old_message = '';
                } else {
                    $notification = 'Une erreur est survenue. Merci de réessayer.';
                    $notification_type = 'danger';
                }
            } catch (PDOException $e) {
                $notification = 'Erreur de base de données : ' . htmlspecialchars($e->getMessage());
                $notification_type = 'danger';
            }
        }
    } else {
        $notification = implode('<br>', $errors);
        $notification_type = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us - Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="logo-removebg.png" type="image/png">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Playfair Display', serif;
            background: url('contactUS.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .navbar {
            background-color: #f5f5dc;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 10px 40px;
        }

        .navbar-brand img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #f7c797;
        }

        .navbar-nav .nav-link {
            color: #3a2b22 !important;
            font-size: 16px;
            font-weight: 600;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #d4a373 !important;
        }

        .contact-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            max-width: 650px;
            margin: 100px auto;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1.2s ease-out;
        }

        .contact-title {
            text-align: center;
            margin-bottom: 30px;
            color: #6b4f3b;
        }

        .contact-title i {
            color: #8b5e3c;
            margin-right: 10px;
        }

        .form-label {
            color: #444;
            font-weight: 500;
        }

        .form-control {
            border: 1px solid #ddd;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: #8b5e3c;
            box-shadow: 0 0 0 0.2rem rgba(139, 94, 60, 0.2);
        }

        .btn-custom {
            background-color: #6b4f3b;
            color: #fff;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #5a3d2f;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 8px;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .contact-container {
                margin: 50px auto;
                padding: 25px;
            }
            .navbar {
                padding: 10px 15px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg position-relative">
        <div class="container-fluid justify-content-center align-items-center">
            <ul class="navbar-nav d-flex flex-row me-3">
                <li class="nav-item"><a class="nav-link" href="Reservation.php">Reservations</a></li>
                <li class="nav-item"><a class="nav-link" href="index.html#menu">Menus</a></li>
            </ul>

            <a class="navbar-brand mx-3" href="#">
                <img src="logo.jpeg" alt="Restaurant Logo" />
            </a>

            <ul class="navbar-nav d-flex flex-row ms-3">
                <li class="nav-item"><a class="nav-link" href="events.html">Events</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>

            <div class="position-absolute end-0 me-3">
                <a class="nav-link d-flex flex-column align-items-center" href="Register.php">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                    <span style="font-size: 0.8rem;">Profile</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="contact-container">
        <h2 class="contact-title">
            <i class="bi bi-envelope-paper-heart-fill"></i> Contact Us
        </h2>

        <?php if (!empty($notification)): ?>
            <div class="alert alert-<?= htmlspecialchars($notification_type) ?> alert-dismissible fade show mt-3" role="alert">
                <?= nl2br(htmlspecialchars($notification)) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-4">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Your full name" required maxlength="100" value="<?= htmlspecialchars($old_name) ?>">
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required maxlength="255" value="<?= htmlspecialchars($old_email) ?>">
            </div>

            <div class="mb-4">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="How can we help you?" required maxlength="2000"><?= htmlspecialchars($old_message) ?></textarea>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-custom px-4 py-2">Send Message</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

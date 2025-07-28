<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book a Table | SONO Restaurant</title>
  <link rel="icon" href="logo-removebg.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Playfair Display', serif;
      background-color: #fefaf4;
    }

    /* Navbar */
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


    /* Hero Section */
    .hero {
      background: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
      height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      position: relative;
    }

    .hero::after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: 3.5rem;
      animation: fadeInDown 1s ease;
    }

    .hero p {
      font-size: 1.2rem;
      margin-top: 10px;
    }

    .btn-scroll {
      margin-top: 30px;
      background-color: #8b5e3c;
      border: none;
      color: white;
      padding: 10px 20px;
    }

    .btn-scroll:hover {
      background-color: #6b4f3b;
    }

    /* Table Types */
    .table-types {
      padding: 60px 20px;
      background-color: #fff;
    }

    .table-card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .table-card:hover {
      transform: scale(1.03);
    }

    .table-card img {
      border-radius: 15px 15px 0 0;
      height: 220px;
      object-fit: cover;
    }

    /* Form Section */
    .form-section {
      background-color: #fef7ee;
      padding: 60px 20px;
    }

    .reservation-form {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .form-title {
      text-align: center;
      margin-bottom: 30px;
      color: #5a3928;
      font-size: 2rem;
    }

    .btn-reserve {
      background-color: #6b4f3b;
      color: white;
      border: none;
    }

    .btn-reserve:hover {
      background-color: #503628;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-relative"> <!-- Make navbar position-relative -->
    <div class="container-fluid justify-content-center align-items-center">

      <!-- Left side links -->
      <ul class="navbar-nav d-flex flex-row me-3">
        <li class="nav-item">
          <a class="nav-link" href="Reservation.php">Reservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html#menu">Menus</a>
        </li>
      </ul>

      <!-- Centered logo -->
      <a class="navbar-brand mx-3" href="#">
        <img src="logo.jpeg" alt="Logo" />
      </a>

      <!-- Right side links -->
      <ul class="navbar-nav d-flex flex-row ms-3 align-items-center">
        <li class="nav-item">
          <a class="nav-link" href="events.html">Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
    </div>

    <!-- Absolutely positioned profile icon in top-right -->
    <div class="position-absolute top-50 translate-middle-y end-0 me-4">
      <a class="nav-link d-flex flex-column align-items-center text-decoration-none"
        href="Register.php" style="color: #3a2b22;">
        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
        <span style="font-size: 0.8rem;">Profile</span>
      </a>
    </div>
  </nav>


  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <h1>Reserve Your Table</h1>
      <p>Choose your moment – Romantic dinner, family gathering or birthday celebration.</p>
      <a href="#form" class="btn btn-scroll">Book Now</a>
    </div>
  </section>

  <!-- Table Types -->
  <section class="table-types">
    <div class="container">
      <h2 class="text-center mb-5" style="color:#6b4f3b;">Choose Table Type</h2>
      <div class="row g-4">

        <!-- Couple -->
        <div class="col-md-3">
          <div class="card table-card">
            <img src="Couple.jpeg" class="card-img-top" alt="Couple Table">
            <div class="card-body text-center">
              <h5 class="card-title">Couple Table</h5>
            </div>
          </div>
        </div>

        <!-- Family -->
        <div class="col-md-3">
          <div class="card table-card">
            <img src="Family.jpeg" class="card-img-top" alt="Family Table">
            <div class="card-body text-center">
              <h5 class="card-title">Family Table</h5>
            </div>
          </div>
        </div>

        <!-- Birthday -->
        <div class="col-md-3">
          <div class="card table-card">
            <img src="Birthay.jpeg" class="card-img-top" alt="Birthday Table">
            <div class="card-body text-center">
              <h5 class="card-title">Birthday Celebration</h5>
            </div>
          </div>
        </div>

        <!-- VIP -->
        <div class="col-md-3">
          <div class="card table-card">
            <img src="Vip.jpeg" class="card-img-top" alt="VIP Table">
            <div class="card-body text-center">
              <h5 class="card-title">VIP Experience</h5>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Reservation Form -->
  <section class="form-section" id="form">
    <div class="container">
      <div class="reservation-form">
        <h2 class="form-title">Complete Your Reservation</h2>
        <?php
        $success = false;
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          require_once 'connect.php';
          $full_name = $_POST['name'] ?? '';
          $phone = $_POST['phone'] ?? '';
          $email = $_POST['email'] ?? '';
          $datetime = $_POST['date'] ?? '';
          $nb_guests = $_POST['guests'] ?? '';
          $table_type = $_POST['type'] ?? '';
          $request = $_POST['notes'] ?? '';

          if (!isset($db)) {
            $error = 'Database connection failed!';
          } else {
            try {
              $sql = "INSERT INTO reservation (full_name, phone, email, datetime, nb_guests, table_type, request) VALUES (?, ?, ?, ?, ?, ?, ?)";
              $stmt = $db->prepare($sql);
              $stmt->execute([$full_name, $phone, $email, $datetime, $nb_guests, $table_type, $request]);
              $success = true;
            } catch (PDOException $e) {
              $error = 'Reservation failed. Please try again.';
              echo '<div class="alert alert-danger text-center">Erreur SQL: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
          }
        }
        ?>
        <?php if ($success): ?>
          <div class="alert alert-success text-center" style="font-size:1.2rem; background: #e9ffe9; color: #2d6a4f; border-radius: 10px; margin-bottom: 30px; border: 2px solid #95d5b2;">
            <i class="bi bi-check-circle-fill" style="font-size:2rem; color:#38b000;"></i><br>
            <strong>Reservation Successful!</strong><br>
            Thank you, <span style="color:#40916c; font-weight:bold;"><?= htmlspecialchars($full_name) ?></span>.<br>
            Your table is reserved for <span style="color:#40916c; font-weight:bold;"><?= htmlspecialchars($datetime) ?></span>.<br>
            We look forward to welcoming you!
          </div>
        <?php elseif ($error): ?>
          <div class="alert alert-danger text-center" style="font-size:1.1rem; background: #fff0f0; color: #a4161a; border-radius: 10px; margin-bottom: 30px; border: 2px solid #ffb3b3;">
            <i class="bi bi-x-circle-fill" style="font-size:2rem; color:#d00000;"></i><br>
            <strong><?= htmlspecialchars($error) ?></strong>
          </div>
        <?php endif; ?>
        <form method="POST" action="">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6">
              <label for="date" class="form-label">Date & Time</label>
              <input type="datetime-local" class="form-control" id="date" name="date" required>
            </div>
            <div class="col-md-6">
              <label for="guests" class="form-label">Number of Guests</label>
              <input type="number" class="form-control" id="guests" name="guests" min="1" required>
            </div>
            <div class="col-md-6">
              <label for="type" class="form-label">Table Type</label>
              <select class="form-select" id="type" name="type" required>
                <option value="">Choose...</option>
                <option>Couple</option>
                <option>Family</option>
                <option>Birthday</option>
                <option>VIP</option>
              </select>
            </div>
            <div class="col-12">
              <label for="notes" class="form-label">Special Requests</label>
              <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-reserve mt-3 px-4 py-2">Confirm Reservation</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

</html>
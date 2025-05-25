<?php
session_start();
include_once "config.php";
include_once "header.php";

function redirectWithMessage($msg)
{
    echo "<p style='color:#f7941d; font-weight:bold;'>$msg</p>";
    echo "<p><a href='list_cars.php' style='color:#f7941d; text-decoration:none;'>Back to Cars</a></p>";
    include_once "footer.php";
    exit;
}

// Check if user is logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    redirectWithMessage("Ju duhet të jeni të kyçur për të bërë rezervimin.");
}

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectWithMessage("Metoda e kërkesës nuk është e vlefshme.");
}

// Retrieve and sanitize POST data
$car_id = isset($_POST['car_id']) ? (int)$_POST['car_id'] : 0;
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$pickup_date = $_POST['pickup_date'] ?? '';
$return_date = $_POST['return_date'] ?? '';

// Validate required fields
if (!$car_id || !$name || !$email || !$phone || !$pickup_date || !$return_date) {
    redirectWithMessage("Ju lutemi plotësoni të gjitha fushat e kërkuara.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithMessage("Adresa e email-it nuk është e vlefshme.");
}

$today = date('Y-m-d');

if ($pickup_date < $today) {
    redirectWithMessage("Data e marrjes së makinës nuk mund të jetë në të kaluarën.");
}

if ($return_date < $pickup_date) {
    redirectWithMessage("Data e kthimit nuk mund të jetë para datës së marrjes.");
}

try {
    // Check if car exists
    $stmt = $conn->prepare("SELECT brand, model FROM cars WHERE id = ?");
    $stmt->execute([$car_id]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        redirectWithMessage("Makina e zgjedhur nuk ekziston.");
    }

    // Insert booking with user_id
    $insert = $conn->prepare("INSERT INTO bookings (user_id, car_id, name, email, phone, pickup_date, return_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $success = $insert->execute([$user_id, $car_id, $name, $email, $phone, $pickup_date, $return_date]);
} catch (PDOException $e) {
    redirectWithMessage("Gabim në bazën e të dhënave: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Konfirmimi i Rezervimit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #111;
            color: white;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
        }

        h2 {
            color: #f7941d;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);
        }

        p {
            font-size: 18px;
            line-height: 1.5;
        }

        a {
            color: #f7941d;
            text-decoration: none;
            font-weight: 700;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php if ($success) : ?>
        <h2>Rezervimi u krye me sukses!</h2>
        <p>Faleminderit, <?= htmlspecialchars($name) ?>.</p>
        <p>Rezervimi juaj për makinën <strong><?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?></strong> (ID: <?= $car_id ?>)
            nga data <strong><?= htmlspecialchars($pickup_date) ?></strong> deri më <strong><?= htmlspecialchars($return_date) ?></strong> është pranuar.</p>
        <p><a href="list_cars.php">Kthehu te makinat</a></p>
    <?php else : ?>
        <?php redirectWithMessage("Gabim gjatë ruajtjes së rezervimit. Ju lutemi provoni përsëri."); ?>
    <?php endif; ?>
</body>

</html>

<?php include_once "footer.php"; ?>
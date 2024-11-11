<?php
session_start();
require __DIR__ . "/vendor/autoload.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "group_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $guests = $_POST["guests"];
    $time = $_POST["time"];
    $notes = $_POST["notes"];
    $adults = $_POST["adults"];
    $children = $_POST["children"];
    $babies = $_POST["babies"];
    $meal_period = $_POST["meal_period"];
    $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';
    $user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'guest@example.com';

    // Check if the user already has a reservation on the same day
    $check_sql = "SELECT * FROM reservation_times WHERE user_email = ? AND date = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $user_email, $date);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('You already have a reservation on this date.'); window.location.href = 'reservation.php';</script>";
        exit();
    }

    // Store reservation details in session to use after payment
    $_SESSION['reservation_details'] = [
        'date' => $date,
        'guests' => $guests,
        'time' => $time,
        'notes' => $notes,
        'adults' => $adults,
        'children' => $children,
        'babies' => $babies,
        'meal_period' => $meal_period,
        'user_name' => $user_name,
        'user_email' => $user_email
    ];

    $stripe_secret_key = "sk_test_51PhzGzKbQO3LK6GrCf3r4wPKjIbESQFTJaYUKympJtxf5COSMqFpaFfjOW2xTdgYlUs9x0W1rwYKciei35IzaDsf00Z5GJOMKj";
    \Stripe\Stripe::setApiKey($stripe_secret_key);

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/CSAD_mini_project/success.php",
        "cancel_url" => "http://localhost/CSAD_mini_project/reservation.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => 500, // $5.00
                    "product_data" => [
                        "name" => "Reservation Deposit"
                    ]
                ]
            ]
        ]
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);
}
?>

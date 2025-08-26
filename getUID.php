<?php
<<<<<<< HEAD
if (isset($_POST["UIDresult"])) {
    $UIDresult = $_POST["UIDresult"];
    $Write = "<?php $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('/tmp/UIDContainer.php', $Write);
} else {
    echo "No UIDresult received.";
}
=======
require 'database.php';

$message = '';
$UIDresult = '';

if (isset($_POST['UIDresult'])) {
    $UID = trim($_POST['UIDresult']); // Make sure no extra spaces
    $db = Database::connect();

    // Check if UID exists in database
    $stmt = $db->prepare("SELECT * FROM table_the_iot_projects WHERE id = :uid LIMIT 1");
    $stmt->execute(['uid' => $UID]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // UID registered → write UID
        $UIDresult = $UID;
        $message = 'registered';
    } else {
        // UID not registered → clear UID
        $UIDresult = '';
        $message = 'not_registered';
    }

    // Update UIDContainer.php
    $Write = "<?php \$UIDresult='" . $UIDresult . "'; echo \$UIDresult; ?>";
    file_put_contents('UIDContainer.php', $Write);
    Database::disconnect();
}

// Return message to ESP8266
echo $message;
>>>>>>> 4947e40 (working)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="styles/styles.css">
    <title>Smartphonia</title>
</head>
<body background="img/back.jpg">

    <div class="parent">

        <h1 class="title">Smartphonia</h1>

                <ul class="navigation">
                    <li class="links">
                        <a href="index.html">Головна</a>
                    </li>
                    <li class="links">
                        <a href="iphone.html">Iphone</a>
                    </li>
                    <li class="links">
                        <a href="xiaomi.html">Xiaomi</a>
                    </li>
                    <li class="links">
                        <a href="samsung.html">Samsung</a>
                    </li>
                    <li class="links">
                        <a href="oneplus.html">OnePlus</a>
                    </li>
                    <li class="links">
                        <a href="contacts.html">Контакти</a>
                    </li>
                    <li class="links">
                        <a href="reviews.php">Відгуки</a>
                    </li>
                    <li class="links">
                        <a href="about.html">Про нас</a>
                    </li>

                </ul>
            </div>


            <div>

                <h1>Відгуки</h1>
                
                
                <div class="form-container">
    <form method="POST" action="">
        <label for="username">Ім'я користувача:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="review">Відгук:</label>
        <textarea id="review" name="review" rows="4" required></textarea>
        
        <input type="submit" value="Додати відгук">
        
    </form>
</div>
                
<?php
// Підключення до бази даних SQLite
$db = new SQLite3('reviews.db');

// Перевірка, чи існує таблиця reviews, якщо ні, то створюємо її
$db->exec("CREATE TABLE IF NOT EXISTS reviews (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    review TEXT NOT NULL,
    date TEXT NOT NULL
)");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $review = $_POST['review'];
    $date = date('Y-m-d H:i:s'); 

    $stmt = $db->prepare("INSERT INTO reviews (username, review, date) VALUES (:username, :review, :date)");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':review', $review, SQLITE3_TEXT);
    $stmt->bindValue(':date', $date, SQLITE3_TEXT);
    $stmt->execute();
    
    echo "Ваш відгук був успішно доданий!";
}

$result = $db->query("SELECT * FROM reviews");
while ($row = $result->fetchArray()) {
    echo '<div class="review">';
    echo "<p class='review-id'>ID: " . $row['id'] . "</p>";
    echo "<p class='review-username'>Ім'я користувача: " . $row['username'] . "</p>";
    echo "<p class='review-text'>Відгук: " . $row['review'] . "</p>";
    echo "<p class='review-date'>Дата: " . $row['date'] . "</p>";
    echo "</div>";
}

$db->close();
?>

            </div>

            <h1 class="end">Кінець сторінки</h1>            
        </div>
    </div>
</body>
</html>
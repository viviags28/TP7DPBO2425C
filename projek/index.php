<?php
require_once 'config/db.php';
require_once 'class/Anime.php';
require_once 'class/Genre.php';
require_once 'class/Studio.php';

$animeObj = new Anime();
$genreObj = new Genre();
$studioObj = new Studio();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Anime Database</title>
    <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>

<?php include 'view/header.php'; ?>

<main>
    <h2>Selamat Datang di Database Anime（☆/＞u＜/）</h2>
    <hr>

    <?php
    $page = $_GET['page'] ?? null;

    switch ($page) {
        case 'anime':
            $animeList = $animeObj->getAllAnime();
            $genreList = $genreObj->getAllGenre();
            $studioList = $studioObj->getAllStudio();
            include 'view/anime.php';
            break;

        case 'genre':
            $genreList = $genreObj->getAllGenre();
            include 'view/genre.php';
            break;

        case 'studio':
            $studioList = $studioObj->getAllStudio();
            include 'view/studio.php';
            break;

        default:
            echo "<p>Pilih menu di atas untuk melihat data.</p>";
    }
    ?>
</main>

<?php include 'view/footer.php'; ?>

</body>
</html>

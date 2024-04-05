<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Random Image Grid</title>
</head>

<body>
    <div class="container">
        <div style="text-align: center">
            <h1>My "Random" Image Gallery</h1>
            <p>Thanks to <a href="https://picsum.photos/" target="_blank">picsum.photos</a></p>
        </div>
        <div class="image-container">
            <?php
            for ($col = 0; $col < 4; $col++) {
                echo '<div class="image-col">';
                for ($i = 0; $i < 10; $i++) {
                    $randHeight = rand(18, 54) * 10;
                    echo '<img class="rounded" loading="lazy" height="'. $randHeight .'" alt="Image Provided by Picsum" width="320" src="https://picsum.photos/320/'. $randHeight .'.webp?random='. rand(0,1000) .'">';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>

</html>
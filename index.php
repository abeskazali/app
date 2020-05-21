<?php

$config = include 'config.php';

function getTitle()
{
    return 'Anasayfa';
}

$house = file_get_contents("https://www.potterapi.com/v1/sortingHat?key={$config['api_key']}");

?>

<?php

include_once 'header.php';

include_once 'navbar.php';

?>


<div class="pt-5">

    <div class="container">

        <section class="jumbotron text-center pt-5 mb-5 bg-white">
            <div class="container">
                <h1 class="jumbotron-heading"><?php echo getTitle(); ?></h1>
            </div>
        </section>

        <div class="bg-white p-5">
            <div class="col-md-12">

                <?php
                // api'dan gelen çift tırnak işaretlerini kaldırmak için yazıldı
                $house = str_replace("\"","", $house);
                ?>
                <p>Tebrikler! Seçmen şapka sizi <strong><a href="houses.php"><?php echo $house; ?></a></strong> evine yerleştirdi.</p>
                <img class="card-img-top" src="assets/images/houses/<?php echo $house?>.jpg" alt="<?php echo $house; ?>">

            </div>
        </div>
    </div>
</div>

<?php

include_once 'footer.php';

?>

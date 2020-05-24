<?php

$config = include 'config.php';

function getTitle()
{
    return 'Karakterler';
}

$apiUrl = "https://www.potterapi.com/v1/characters?key={$config['api_key']}";

if (isset($_GET['house'])) {

    $validHouses = $config['validHouses'];
    if (!in_array($_GET['house'], $validHouses)) {
        exit('Böyle bir bina yok');
    }

    $apiUrl .= ($_GET['house'] ? "&house=" . ucfirst($_GET['house']) : '');
}


$characters = file_get_contents($apiUrl);

$characterDetails = [];

$characters = json_decode($characters, true);

foreach ($characters as $character) {
    $characterDetails[] = [
        '_id' => $character['_id'],
        'name' => $character['name'],
        'house' => $character['house'] ?? null,
        'role' => $character['role'] ?? null,
        'bloodStatus' => $character['bloodStatus'] ?? null,
        'species' => $character['species'] ?? null
    ];
}

?>

<?php

include 'header.php';

include 'navbar.php';

?>

<div class="pt-5">

    <div class="container">

        <section class="jumbotron text-center pt-5 mb-5 bg-white">
            <div class="container">
                <h1 class="jumbotron-heading"><?php echo getTitle(); ?></h1>
                <?php if(isset($_GET['house'])): ?>
                    <img class="card-img-top" style="width: 5%" src="/assets/images/houses/<?php echo $_GET['house'] ?>.jpg" alt="<?php echo $_GET['house']; ?>">
                    <span><?php echo strtoupper($_GET['house']) ?></span>
                <?php endif; ?>
            </div>
        </section>


        <div class="bg-white p-5">
            <table class="table" id="datatable">
                <thead>
                <tr>
                    <th scope="col" style="width: 15%">Avatar</th>
                    <th scope="col" style="width: 15%">Ad</th>
                    <th scope="col" style="width: 25%">Rol</th>
                    <th scope="col">Bina</th>
                    <th scope="col">Kan Durumu</th>
                    <th scope="col">Tür</th>
                </tr>
                </thead>
                <tbody>
                <?php
<<<<<<< HEAD
<<<<<<< HEAD
=======
                $counter = 1;

                // sayfada uyarı bilgisi görünmemesi için eklendi. Butona basılarak sayfaya gidilmişse burası çalışır
                if(isset($_GET['house'])){
                    //linki parçalama ve $houseID değişkenine linkin sonundaki ID'yi atama
                    $link = $_SERVER['REQUEST_URI'];
                    $parts = parse_url($link);
                    $query = array();
                    parse_str($parts['query'], $query);
                    
                    $houseID = array_search($query['house'], $validHouses);
                    
                    //API key'i ile belirtilen ID'deki house'a ait üye bilgilerini çekme
                    $houses = file_get_contents("https://www.potterapi.com/v1/houses/{$houseID}?key={$config['api_key']}");
                    $houses = json_decode($houses, true);
                }

                // Karakter sayfasından çekilen karakter bilgilerini tabloya yazdırma
>>>>>>> upstream/master
=======
>>>>>>> 18d762083ddaa6a5a87796c882aa43360de7ef7c
                foreach ($characterDetails as $detail):
                ?>
<<<<<<< HEAD
                        <tr>
<<<<<<< HEAD
                            <th scope="row"></th>
                            <td><?php echo $detail['name']; ?></td>
                            <td><?php echo $detail['house']; ?></td>
                            <td><?php echo $detail['role']; ?></td>
                            <td><?php echo $detail['bloodStatus']; ?></td>
                            <td><?php echo $detail['species']; ?></td>
=======
                            <th scope="row"><?php echo $counter++; ?> </th>
                            <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?php echo $detail['name']?>.jpg"></td>
                            <td><?php echo $detail['name'];?></td>
                            <td><?php echo $detail['role'];?></td>
                            <td><?php echo $detail['house'];?></td>
                            <td><?php echo $detail['bloodStatus'];?></td>
                            <td><?php echo $detail['species'];?></td>
                            <!--
                            Translate API için kullandım ama biraz yavaş yüklendiği için yorum satırı içerisine aldım
                            <th scope="row"><?//php echo $counter++; ?> </th>
                            <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?//php echo $detail['name']?>.jpg"></td>
                            <td><?//php echo $detail['name'];?></td>
                            <td><?//php translate("".$detail['role'], "en", "tr");?></td>
                            <td><?//php echo $detail['house'];?></td>
                            <td><?//php translate("".$detail['bloodStatus'], "en", "tr");?></td>
                            <td><?//php translate("".$detail['species'], "en", "tr");?></td>
                            -->
>>>>>>> upstream/master
                        </tr>
                        <?php
                    }
                    // house bilgisi girilmişse yani house sayfasından butona basılmışsa sadece o house ID'sine sahip karakterleri yazar
                    else{
                        //Burayı inceleyebilirsiniz: https://www.potterapi.com/v1/houses/5a05da69d45bd0a11bd5e06f?key=$2a$10$EKveuCEHVz5zic.8WJQHjuqmFYREVSj5V1TH7Tkw8vdLuIeTnVb86
                        $houseDetail = [];
                        foreach ($houses[0]["members"] as $uye){
                            $houseDetail[] = [
                                'id' => $houses[0]['_id'],
                                'name' => $houses[0]['name'],
                                'members' => $uye['_id']
                            ];
                        }

                        foreach ($houseDetail as $inf){
                            // House bilgilerindeki üye ID'si ile karakter bilgilerindeki üye ID'si eşitse tabloya yazar
                            if($inf['members'] == $detail['_id']){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $counter++; ?> </th>
                                    <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?php echo $detail['name']?>.jpg"></td>
                                    <td><?php echo $detail['name'];?></td>
                                    <td><?php echo $detail['role'];?></td>
                                    <td><?php echo $detail['house'];?></td>
                                    <td><?php echo $detail['bloodStatus'];?></td>
                                    <td><?php echo $detail['species'];?></td>
                                    <!--
                                    Translate API için kullandım ama biraz yavaş yüklendiği için yorum satırı içerisine aldım
                                    <th scope="row"><?//php echo $counter++; ?> </th>
                                    <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?//php echo $detail['name']?>.jpg"></td>
                                    <td><?//php echo $detail['name'];?></td>
                                    <td><?//php translate("".$detail['role'], "en", "tr");?></td>
                                    <td><?//php echo $detail['house'];?></td>
                                    <td><?//php translate("".$detail['bloodStatus'], "en", "tr");?></td>
                                    <td><?//php translate("".$detail['species'], "en", "tr");?></td>
                                    -->
                                </tr>
                                <?php
                                break;
                            }
                        }
                    }
                endforeach;
=======
                    <tr>
                        <td>
                            <img style=" width: 50%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?php echo $detail['name']?>.jpg">
                        </td>
                        <td><?php echo $detail['name'];?></td>
                        <td><?php echo $detail['role'];?></td>
                        <td><?php echo $detail['house'];?></td>
                        <td><?php echo $detail['bloodStatus'];?></td>
                        <td><?php echo $detail['species'];?></td>
                    </tr>
                <?php
                    endforeach;
>>>>>>> 18d762083ddaa6a5a87796c882aa43360de7ef7c
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>

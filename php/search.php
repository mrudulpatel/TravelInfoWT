<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/TravelInfoWT/styles/styles.css" rel="stylesheet" />
    <style>
        .card {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card img {
            width: 100%;
            height: auto;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-content {
            padding: 20px;
        }

        .card-content h3 {
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .card-content p {
            font-size: 14px;
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="index.html" class="logo">
            <img src="/TravelInfoWT/assets/travel-logo.png" alt="logo">
        </a>

        <div class="nav-bar">
            <a href="#">Home</a>
            <a href="#form">Contact-Us</a>
            <div class="dropdown">
                <a href="#" class="Destinations">Destinations &#9662;</a>
                <div class="dropdown-content">
                    <a href="paris.html" class="line-css">Paris</a>
                    <a href="rome.html" class="line-css">Rome</a>
                    <a href="brazil.html" class="line-css">Brazil</a>
                    <a href="India.html" class="line-css">India</a>
                </div>
            </div>
            <a href="form_html.php" target="_blank">Feedback</a>
        </div>
    </div>
    <?php

    $ch = curl_init(); // initialize curl session
    // API Calls in JS
    // fetch("url").then((response)=> {
    //     return response.json();
    // })

    curl_setopt_array($ch, [
        CURLOPT_URL => "https://tripadvisor16.p.rapidapi.com/api/v1/hotels/searchLocation?query=" . $_POST["search"] . "&lang=en_US&units=km",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: tripadvisor16.p.rapidapi.com",
            "X-RapidAPI-Key: <YOUR API KEY HERE>"
        ],
    ]);

    $response = curl_exec($ch);
    $err = curl_error($ch);

    curl_close($ch);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $dataArray = json_decode($response, true);

        // Display the travel information
        if ($dataArray['status'] && isset($dataArray['data'])) {
            foreach ($dataArray['data'] as $destination) {
                $title = $destination['title'];
                // Check if secondaryText key exists and is not empty
                if (isset($destination['secondaryText']) && !empty($destination['secondaryText'])) {
                    $secondaryText = $destination['secondaryText'];
                } else {
                    $secondaryText = 'N/A';
                }

                // Check if image key exists and has the necessary properties
                if ($destination['image']['urlTemplate'] != '') {
                    $imageURL = $destination['image']['urlTemplate'];
                } else {
                    // generate a default image URL
                    $imageURL = 'https://www.tripadvisor.com/img/cdsi/img2/branding/socialWidget/flipkey_social_logo-21690-2.png';
                }

                $newURL = str_replace("{width}", "500", $imageURL);
                $newURL = str_replace("{height}", "300", $newURL);

                if ($title != "Add a missing place" || $title != "Add a missing restaurant" || $title != "Add a missing attraction" || $title != ucfirst($_POST["search"])) {
                    echo '<div class="card">';
                    echo '<img src="' . $newURL . '" alt="' . $title . '">';
                    echo '<div class="card-content">';
                    echo '<h3>' . $title . '</h3>';
                    echo '<br>';
                    echo '<p>' . $secondaryText . '</p>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo "";
                }
            }
        } else {
            echo 'No results found.';
        }
    }
    ?>
</body>

</html>
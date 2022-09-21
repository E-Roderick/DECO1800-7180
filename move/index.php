<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="#" />
    <meta charset="utf-8">
    <title>DECO1800 RDS Idea - Transit Maps</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
</head>

<body>
    <section id="fileContainer">
        <input type="file" id="fileinput" />
    </section>
    <!-- <section id="chart"></section> -->
    <article id="map"></article>
    <section id="records"></section>
    <?php $api_url ='http://www.trumba.com/calendars/brisbane-city-council.json';
        $data = file_get_contents($api_url);
        $data = json_decode($data, true);
        $location = $data[0]['location'];
        //print_r($location);
        $result = preg_match('/http:\/\/maps\.google\.com\/.+Australia/', $location, $locationUrl, PREG_OFFSET_CAPTURE);
        if ($result) {
            $locationUrl = $locationUrl[0][0];
            print_r($locationUrl);
            $api_url = $locationUrl;
            $locationData = file_get_contents($api_url);
            //echo($locationData);
            $result = preg_match('/center=-?\d+\.\d+%2C\d+\.\d+/', $locationData, $matches, PREG_OFFSET_CAPTURE);
            print_r($matches);
            $coordinates = substr($matches[0][0], 7);
            echo($coordinates);
            $coordinates = explode('%2C', $coordinates);
            print_r($coordinates);
            $data[0]['location'] = $coordinates;
            print_r($data[0]);
        }
    ?>
    <script>
    var updatedEvents = <?php echo($data);?>;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/distance.js"></script>
    <script src="js/event.js"></script>
    <script src="js/handle_file.js"></script>
    <!-- <script src="js/pop_data.js"></script> -->
</body>

</html>
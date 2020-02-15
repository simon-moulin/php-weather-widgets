<?php

    require_once(File::build_path(array("model","Model.php")));

class ModelWidget
{

    public static function addWidget($ville){
        if($_SESSION['logged'] == "true"&& self::verifVille($ville)){
            try{

                $sql = "INSERT INTO widget VALUES(:utilisateur, :ville);";
                $req_prep = Model::$pdo->prepare($sql);

                $values = array(
                    "utilisateur" => $_SESSION['login'],
                    "ville" => $ville
                );

                $req_prep->execute($values);
            }
            catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    private static function getData($cityId)
    {


        $apiKey = "c928455314e8055521349b90d29dccbc";
        $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityId . "&lang=fr&units=" . $_SESSION['format'] . "&APPID=" . $apiKey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);
        $data = (array) json_decode($response, true);
        return $data;
    }

    public static function getTemp($cityId)
    {
        $data = self::getData($cityId);

        return $data['main']['temp'];
    }

    public static function verifVille($ville){
        $data = self::getData($ville);
        if(!isset($data['main']['temp'])){
            return false;
        }else{
            return true;
        }

    }

    public static function remove($ville){
        if($_SESSION['logged'] == "true"&& self::verifVille($ville)){
            try{

                $sql = "DELETE FROM widget where ville=:ville;";
                $req_prep = Model::$pdo->prepare($sql);

                $values = array(
                    "ville" => $ville
                );

                $req_prep->execute($values);
            }
            catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public static function getIcon($cityId)
    {
        $dic = array(
            '01d' => 'wi-day-sunny',
            '02d' => 'wi-day-cloudy',
            '03d' => 'wi-cloud',
            '04d' => 'wi-cloudy',
            '09d' => 'wi-showers',
            '10d' => 'wi-day-rain-mix',
            '11d' => 'wi-thunderstorm',
            '13d' => 'wi-snow',
            '50d' => 'wi-fog',
            '01n' => 'wi-night-clear',
            '02n' => 'wi-night-alt-cloudy',
            '03n' => 'wi-night-alt-cloudy-high',
            '04n' => 'wi-cloudy',
            '09n' => 'wi-night-alt-sprinkle',
            '10n' => 'wi-night-alt-showers',
            '11n' => 'wi-night-alt-thunderstorm',
            '13n' => 'wi-night-alt-snow',
            '50n' => 'wi-night-fog'
        );
        $data = self::getData($cityId);
        return $dic[$data['weather'][0]['icon']];
    }
}
?>
<?php

function random_num() {
    rand(1000,5000);
}

function get_package_json() {
    $start = false;
   // $jsondata = file_get_contents("c:\\xampp\\htdocs\\GWSGolf\\package.json");
    //$jsondata = file_get_contents('/home/vagrant/sites/Planter/package.json');

    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($jsondata, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);
    
    foreach ($jsonIterator as $key => $val) {
        if ($key == 'devDependencies')
            {
                $start = true;
            }

        if($start == true) {
            if(is_array($val)) {
                echo "packages\n";
            } else {
                print "$key => $val\n";
            }
        }
    }
}

function get_package_json2($pkg) {
  
   // $jsondata = file_get_contents("c:\\xampp\\htdocs\\GWSGolf\\package.json");
    $currpath = getcwd();
    //$jsondata = file_get_contents($currpath.'/../package.json');
    //$jsondata = file_get_contents('../package.json');
    $jsondata = file_get_contents('/home/vagrant/sites/carvue-master/package.json');
    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($jsondata, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);
    
    foreach ($jsonIterator as $key => $val) {
       
        if ($key == $pkg) {
            if(is_array($val)) {
                echo "package\n";
            } else {
                return "$key => $val\n";
            }
        }
    }
}

function cwd() {
    echo getcwd() . "\n";
}

function php_ver()
{
   echo 'PHP version => ' . phpversion();
}

function mysql_db_ver()
{
    $results = DB::select( DB::raw('SHOW VARIABLES LIKE "version"') );
    $test = json_encode($results);
    $test2 = strrchr($test,":");
   // var_dump($test2);
    $len = strlen($test2);
    $pos = strpos($test2,"}");
    $test3 = substr($test2,1,$pos-1);
    echo 'MySql => ' . $test3;
    echo '';
   
}
<?php

define('PROJECT_DIR', dirname(__DIR__));

require_once PROJECT_DIR.'/vendor/autoload.php';
require_once PROJECT_DIR.'/src/Core/load_runtime.php';

exit();

?>

// echo phpinfo();

// $redis = new Predis\Client(['host'=>'redis']);
// $redisStatus = redisConnect($redis);

// $database ="mydb";  
// $user = "root";  
// $password = "secret";  
// $host = "mysql";  

// $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);  
// $query = $connection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_TYPE='BASE TABLE'");  
// $tables = $query->fetchAll(PDO::FETCH_COLUMN);  

// if (empty($tables)) {
//     echo "<p>There are no tables in database \"{$database}\".</p>";
// } else {
//     echo "<p>Database \"{$database}\" has the following tables:</p>";
//     echo "<ul>";
//     foreach ($tables as $table) {
//         echo "<li>{$table}</li>";
//     }
//     echo "</ul>";
// }

// if ($redisStatus == 'OK') {
//     $ok = $redis->set('testKey', 'testValue');
//     if ($ok == 'OK') {
//         $okBool = $redis->get('testKey');
//         if ($okBool) {
//             $redis->del('testKey');
//             $redisStatus = 'Reddis ready';
//         } else {
//             $redisStatus = 'Redis failed reading key';
//         }
//     } else {
//         $redisStatus = 'Redis failed writing';
//     }
// }

// echo $redisStatus;

// function redisConnect($mem) {
//     try {
//         $mem->connect();
//         $mem->select(0);
//         $status = 'OK';
//     } catch (\Exception $exception) {
//         $status = 'redis failed to connect';
//     }
//     return $status;
// }
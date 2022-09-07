<?php
// bootstrap.php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = ORMSetup::createAnnotationMetadataConfiguration(array(dirname(__DIR__)."/Entity"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
// or if you prefer YAML or XML
// $config = ORMSetup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
// $config = ORMSetup::createYAMLMetadataConfiguration(array(dirname(__DIR__, 2)."/config"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'user' => 'myuser',
    'password' => 'password',
    'host' => 'mysql',
    'dbname' => 'lottery',
    'charset' => 'UTF8'
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

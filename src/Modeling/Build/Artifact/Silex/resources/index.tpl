require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

foreach (new DirectoryIterator('../includes') as $fileInfo) {
    if($fileInfo->isDot()) continue;
    include '../includes/' . $fileInfo->getFilename();
}

$app->run();

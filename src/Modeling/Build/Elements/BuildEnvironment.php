<?php

namespace Modeling\Build\Elements;

use Modeling\Build\Element;
use Monolog\Logger;

class BuildEnvironment extends Element {

    /** @var \SplFileInfo S */ protected $target;
    /** @var Logger */ private $logger;

    /**
     * @return Logger
     */
    public function getLogger() {
        return $this->logger;
    }

    /**
     * @param Logger $logger
     * @return static
     */
    public function setLogger($logger) {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param $folder
     * @param string $description
     * @return \DirectoryIterator
     */
    public function makeFolder($folder, $description = '') {
        if (is_dir($folder)) {
            $this->logger->info("removing $description $folder");
            @$this->deleteFolder($folder);
        }
        $success = @mkdir($folder);
        if ($success) {
            $this->logger->info("creating $description $folder");
        } else {
            $this->logger->error("failed to create $description $folder");
        }
        return new \DirectoryIterator($folder);
    }

    public function deleteFolder($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->deleteFolder("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

}
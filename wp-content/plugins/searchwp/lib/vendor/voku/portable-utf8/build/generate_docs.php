<?php

namespace SearchWP\Dependencies;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';
$readmeText = (new \SearchWP\Dependencies\voku\PhpReadmeHelper\GenerateApi())->generate(__DIR__ . '/../src/voku/helper/UTF8.php', __DIR__ . '/docs/base.md');
\file_put_contents(__DIR__ . '/../README.md', $readmeText);

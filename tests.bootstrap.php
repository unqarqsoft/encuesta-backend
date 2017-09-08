<?php

echo passthru(sprintf(
    'php "%s/bin/console" doctrine:schema:update --force --env=test',
    __DIR__
));

echo passthru(sprintf(
    'php "%s/bin/console" doctrine:fixtures:load --no-interaction --env=test',
    __DIR__
));

require __DIR__.'/vendor/autoload.php';

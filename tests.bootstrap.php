<?php

passthru(sprintf(
    'php "%s/console" doctrine:schema:update --force --env=test --no-warmup',
    __DIR__
));

require __DIR__.'/vendor/autoload.php';

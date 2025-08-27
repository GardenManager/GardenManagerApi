<?php

declare(strict_types=1);

use DI\ContainerBuilder;

return new ContainerBuilder()
    ->useAttributes(true)
    ->useAutowiring(true)
    ->build();

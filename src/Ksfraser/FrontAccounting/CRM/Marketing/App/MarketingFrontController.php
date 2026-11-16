<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Marketing\App;

use ksfraser\FrontAccounting\Common\App\AbstractFrontController;

class MarketingFrontController extends AbstractFrontController
{
    public function __construct(
        MarketingAppShell $appShell,
        string $fallbackSecurityArea,
        string $path_to_root
    ) {
        parent::__construct($appShell, $fallbackSecurityArea, $path_to_root);
    }
}

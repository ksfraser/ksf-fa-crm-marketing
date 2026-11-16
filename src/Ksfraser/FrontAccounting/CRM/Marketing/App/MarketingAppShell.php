<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Marketing\App;

use ksfraser\FrontAccounting\Common\App\AbstractAppShell;
use ksfraser\FrontAccounting\Common\App\TabRegistration;

class MarketingAppShell extends AbstractAppShell
{
    public function __construct()
    {
        parent::__construct('marketing', 'index.php', 'view', 'marketing_campaigns');

        $this->registerTab(new TabRegistration(
            'marketing_campaigns',
            'Marketing Campaigns',
            'SA_MARKETING_VIEW',
            null,
            10,
            0,
            null,
            null,
            array()
        ));
    }
}

<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Marketing\App;

use ksfraser\FrontAccounting\Common\App\AbstractAppShell;
use ksfraser\FrontAccounting\Common\Menu\FAModuleMenu;
use Ksfraser\FrontAccounting\CRM\Marketing\Controller\MarketingTabController;

class MarketingAppShell extends AbstractAppShell
{
    public function __construct()
    {
        parent::__construct('marketing', 'index.php', 'view', 'marketing_campaigns');

        $this->add_module(_("Marketing"));

        $menu = new FAModuleMenu(
            'modules/ksf_FA_CRM_Marketing/index.php',
            'view',
            ''
        );

        $menu->addItem('marketing_campaigns', _("Marketing Campaigns"), MENU_INQUIRY)
             ->registerWithApp($this, 'SA_MARKETING_VIEW');

        $this->add_extensions();
    }
}

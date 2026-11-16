<?php
declare(strict_types=1);

use Ksfraser\FrontAccounting\CRM\Marketing\Controller\MarketingTabController;

$path_to_root = '../..';

require_once($path_to_root . '/includes/session.inc');

if (!function_exists('page_security')) {
    define('page_security', 'SA_MARKETING_VIEW');
}

$controller = new MarketingTabController(null, array());
$controller->render();

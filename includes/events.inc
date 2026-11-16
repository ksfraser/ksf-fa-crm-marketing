<?php
declare(strict_types=1);

if (!function_exists('hook_invoke_all')) {
    return;
}

function marketing_campaign_state_changed($campaignId, $fromState, $toState, $meta = array()) {
    hook_invoke_all('MARKETING_STATE_CHANGED', array(
        'campaign_id' => $campaignId,
        'from_state' => $fromState,
        'to_state' => $toState,
        'meta' => $meta,
    ));
}

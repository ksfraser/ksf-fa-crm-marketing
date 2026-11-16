<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Marketing\Service;
use Ksfraser\FrontAccounting\CRM\Marketing\DTO\MarketingDTO;
use Ksfraser\FrontAccounting\CRM\Marketing\Repository\MarketingRepository;
use ksfraser\RelatedTo\DTO\RelatedRecordDto;
final class MarketingService {
    private $repo;
    public function __construct(?MarketingRepository $repo = null) { $this->repo = $repo ?? new MarketingRepository(); }
    public function resolveById(int $id, ?RelatedRecordDto $dto = null): array {
        $row = $this->repo->findById($id);
        if ($row === null) {
            return array('dto' => new RelatedRecordDto('ksf_crm_marketing_campaign', '0', 'ksf_crm_marketing_campaign', '0', null), 'fields' => $this->fieldMap(), 'labels' => $this->labelMap(), 'url' => '#', 'label' => _('Marketing Campaign #') . (string) $id);
        }
        $r = MarketingDTO::fromArray($row);
        $dto = $dto ?? new RelatedRecordDto('ksf_crm_marketing_campaign', (string) $r->campaign_id, 'ksf_crm_marketing_campaign', (string) $r->campaign_id, null);
        return array(
            'dto' => $dto,
            'fields' => array(
                'campaign_id' => (string) $r->campaign_id,
                'name' => $r->name,
                'channel' => $r->channel,
                'start_date' => $r->start_date,
                'end_date' => $r->end_date,
                'budget' => $r->budget,
                'target' => $r->target,
                'status' => $r->status,
            ),
            'labels' => $this->labelMap(),
            'url' => '/modules/ksf_FA_CRM_Marketing/pages/marketing_campaign_form.php?action=edit&campaign_id=' . $r->campaign_id,
            'label' => $r->getDisplayLabel(),
        );
    }
    public function listAll(): array {
        $rows = $this->repo->findAll();
        $results = array();
        foreach ($rows as $row) {
            $r = MarketingDTO::fromArray($row);
            $results[] = array(
                'id' => $r->campaign_id,
                'dto' => new RelatedRecordDto('ksf_crm_marketing_campaign', (string) $r->campaign_id, 'ksf_crm_marketing_campaign', (string) $r->campaign_id, null),
                'fields' => array(
                    'campaign_id' => (string) $r->campaign_id,
                    'name' => $r->name,
                    'channel' => $r->channel,
                    'start_date' => $r->start_date,
                    'end_date' => $r->end_date,
                    'budget' => $r->budget,
                    'target' => $r->target,
                    'status' => $r->status,
                ),
                'labels' => $this->labelMap(),
                'url' => '/modules/ksf_FA_CRM_Marketing/pages/marketing_campaign_form.php?action=edit&campaign_id=' . $r->campaign_id,
                'label' => $r->getDisplayLabel(),
            );
        }
        return $results;
    }
    public function insertCampaign(array $data): int {
        return $this->repo->insertCampaign($data);
    }
    public function updateState(int $campaignId, string $status, string $endDate = null): void {
        $this->repo->updateState($campaignId, $status, $endDate);
        marketing_campaign_state_changed((string) $campaignId, '', $status, array());
    }
    public function fieldMap(): array { return $this->labelMap(); }
    public function labelMap(): array {
        return array(
            'campaign_id' => _('Campaign ID'),
            'name' => _('Campaign Name'),
            'channel' => _('Channel'),
            'start_date' => _('Start Date'),
            'end_date' => _('End Date'),
            'budget' => _('Budget'),
            'target' => _('Target'),
            'status' => _('Status'),
        );
    }
    public function getStateTransitions(string $currentState): array {
        $transitions = array(
            'planned' => array('active' => _('Launch')),
            'active' => array('paused' => _('Pause'), 'completed' => _('Complete')),
            'paused' => array('active' => _('Resume'), 'completed' => _('Complete')),
        );
        return isset($transitions[$currentState]) ? $transitions[$currentState] : array();
    }
    public function isAllowedTransition(string $fromState, string $toState): bool {
        $transitions = $this->getStateTransitions($fromState);
        return isset($transitions[$toState]);
    }
}

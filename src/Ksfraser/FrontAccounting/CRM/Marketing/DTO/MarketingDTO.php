<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Marketing\DTO;
final class MarketingDTO {
    public $campaign_id;
    public $name;
    public $channel;
    public $start_date;
    public $end_date;
    public $budget;
    public $target;
    public $status;
    public $created_at;
    public $updated_at;
    public function __construct(
        int $campaign_id,
        string $name = '',
        string $channel = '',
        string $start_date = '',
        string $end_date = '',
        string $budget = '0.00',
        string $target = '',
        string $status = 'planned',
        string $created_at = '',
        string $updated_at = ''
    ) {
        $this->campaign_id = $campaign_id;
        $this->name = $name;
        $this->channel = $channel;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->budget = $budget;
        $this->target = $target;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    public function getDisplayLabel(): string {
        if ($this->name !== '') {
            return sprintf(_('%s (%s)'), $this->name, $this->channel);
        }
        return _('Marketing Campaign #') . (string) $this->campaign_id;
    }
    public function toArray(): array {
        return array(
            'campaign_id' => $this->campaign_id,
            'name' => $this->name,
            'channel' => $this->channel,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'budget' => $this->budget,
            'target' => $this->target,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        );
    }
    public static function fromArray(array $data): self {
        return new self(
            (int) ($data['campaign_id'] ?? 0),
            (string) ($data['name'] ?? ''),
            (string) ($data['channel'] ?? ''),
            (string) ($data['start_date'] ?? ''),
            (string) ($data['end_date'] ?? ''),
            (string) ($data['budget'] ?? '0.00'),
            (string) ($data['target'] ?? ''),
            (string) ($data['status'] ?? 'planned'),
            (string) ($data['created_at'] ?? ''),
            (string) ($data['updated_at'] ?? '')
        );
    }
}

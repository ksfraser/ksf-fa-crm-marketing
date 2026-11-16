<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Marketing\Repository;
final class MarketingRepository {
    private string $table = 'ksf_crm_marketing_campaigns';
    public function findAll(): array {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return array(); }
        $sql = "SELECT * FROM " . TB_PREF . $this->table . " ORDER BY created_at DESC, campaign_id DESC";
        $result = db_query($sql, 'Could not load marketing campaigns');
        if ($result === false) { return array(); }
        $rows = array();
        while (($row = db_fetch_assoc($result)) !== false && $row !== null) { $rows[] = $row; }
        return $rows;
    }
    public function findById(int $id): ?array {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return null; }
        $sql = "SELECT * FROM " . TB_PREF . $this->table . " WHERE campaign_id = " . (int) $id;
        $result = db_query($sql, 'Could not load marketing campaign');
        if ($result === false) { return null; }
        $row = db_fetch_assoc($result);
        return $row === false ? null : $row;
    }
    public function insertCampaign(array $data): int {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return 0; }
        $sql = "INSERT INTO " . TB_PREF . $this->table . " (
                name, channel, start_date, end_date, budget, target, status, created_at, updated_at)
            VALUES ("
            . $this->escape($data['name'] ?? '') . ", "
            . $this->escape($data['channel'] ?? '') . ", "
            . $this->escape($data['start_date'] ?? '') . ", "
            . $this->escape($data['end_date'] ?? null) . ", "
            . $this->floatVal($data['budget'] ?? 0) . ", "
            . $this->intVal($data['target'] ?? null) . ", "
            . $this->escape($data['status'] ?? 'planned') . ", "
            . $this->escape(date('Y-m-d H:i:s')) . ", "
            . $this->escape(date('Y-m-d H:i:s')) . ")";
        $this->dbQuery($sql);
        return $this->dbInsertId();
    }
    public function updateState(int $campaignId, string $status, string $endDate = null): void {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return; }
        $sets = ["status = " . $this->escape($status)];
        $sets[] = "end_date = " . $this->escape($endDate);
        $sets[] = "updated_at = " . $this->escape(date('Y-m-d H:i:s'));
        $sql = "UPDATE " . TB_PREF . $this->table . " SET " . implode(', ', $sets)
            . " WHERE campaign_id = " . $this->intVal($campaignId);
        $this->dbQuery($sql);
    }
    private function dbQuery($sql, $errorMsg = null) {
        return db_query($sql, $errorMsg);
    }
    private function dbInsertId() {
        return db_insert_id();
    }
    private function escape($value): string {
        if ($value === null) { return 'NULL'; }
        return function_exists('db_escape') ? db_escape($value) : addslashes((string) $value);
    }
    private function intVal($value): int {
        return $value !== null ? (int) $value : 0;
    }
    private function floatVal($value): float {
        return (float) $value;
    }
}

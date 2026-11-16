# ksf_FA_CRM_Marketing — Requirements Traceability Matrix

| Req ID | Requirement | Source | Implemented In | Verified By |
|--------|-------------|--------|----------------|-------------|
| CRM-02 | Marketing campaigns | HR-CRM_gaps.md C2 | MarketingService | unit tests |
| FR-MK-01 | Create campaign | CRM-02 | MarketingRepository::insertCampaign | MarketingDtoTest |
| FR-MK-02 | List campaigns | CRM-02 | MarketingService::listAll | (tab controller) |
| FR-MK-03 | Resolve campaign by id | CRM-02 | MarketingService::resolveById | (capability hook) |
| FR-MK-04 | Update campaign | CRM-02 | MarketingService::updateState | (state transitions) |
| FR-MK-05 | RELATED_TO_FIELDS | CRM-02 | hooks.php RELATED_TO_FIELDS | (capability) |
| NF-MK-01 | Native db_* calls | AGENTS_ARCH | repository | code review |
| NF-MK-02 | PHP 7.3 compatible | AGENTS_ARCH | all src | code review |
| NF-MK-03 | Unit tests | AGENTS_ARCH | tests/Unit | phpunit |

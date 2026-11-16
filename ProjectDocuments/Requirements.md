# ksf_FA_CRM_Marketing — Requirements

## Purpose
Manage marketing campaigns: campaign catalog, channels, targets, budgets and results tracking.

## Business Rules (CRM-02)
- A campaign has a name, channel, dates, budget, target audience size and status.
- Campaign names are not required unique but recommended.
- Status transitions: planned → active → paused | completed | cancelled.

## Functional Requirements
- FR-MK-01: Create a marketing campaign.
- FR-MK-02: List all marketing campaigns (summary table).
- FR-MK-03: Resolve a single campaign by id (related-record linking).
- FR-MK-04: Update campaign status/end date.
- FR-MK-05: Expose campaign fields via RELATED_TO_FIELDS.

## Non-Functional Requirements
- NF-MK-01: All database access uses native FA db_* calls.
- NF-MK-02: PHP 7.3 compatible runtime.
- NF-MK-03: Unit tests cover DTO round-trip and label resolution.

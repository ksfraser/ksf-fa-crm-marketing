-- ksf_FA_CRM_Marketing: marketing campaign tables

CREATE TABLE IF NOT EXISTS `0_ksf_crm_marketing_campaigns` (
  `campaign_id`   INT(11) NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(255) NOT NULL,
  `channel`       VARCHAR(64) NOT NULL COMMENT 'e.g. email, social, event, direct_mail',
  `start_date`    DATE NOT NULL,
  `end_date`      DATE DEFAULT NULL,
  `budget`        DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `target`        INT(11) DEFAULT NULL COMMENT 'target audience size',
  `status`        VARCHAR(24) NOT NULL DEFAULT 'planned' COMMENT 'planned|active|paused|completed|cancelled',
  `created_at`    DATETIME NOT NULL,
  `updated_at`    DATETIME NOT NULL,
  PRIMARY KEY (`campaign_id`),
  KEY `idx_channel` (`channel`),
  KEY `idx_status` (`status`),
  KEY `idx_dates` (`start_date`, `end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

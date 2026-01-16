-- =======================================
-- Neko Reservation Server Database Schema
-- 猫のサロン予約システム
-- =======================================

-- データベース作成
CREATE DATABASE IF NOT EXISTS cat_salon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cat_salon;

-- =======================================
-- 基本テーブル
-- =======================================

-- 管理者・スタッフテーブル
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- パスワードリセットトークン
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
);

-- セッション管理
CREATE TABLE sessions (
    id VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    user_id BIGINT UNSIGNED DEFAULT NULL,
    ip_address VARCHAR(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    user_agent TEXT COLLATE utf8mb4_unicode_ci,
    payload LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
    last_activity INT NOT NULL,
    PRIMARY KEY (id),
    KEY sessions_user_id_index (user_id),
    KEY sessions_last_activity_index (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- キャッシュテーブル
CREATE TABLE cache (
    `key` VARCHAR(255) PRIMARY KEY,
    `value` MEDIUMTEXT NOT NULL,
    expiration INTEGER NOT NULL
);

-- ジョブキューテーブル
CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL,
    reserved_at INTEGER UNSIGNED NULL,
    available_at INTEGER UNSIGNED NOT NULL,
    created_at INTEGER UNSIGNED NOT NULL,
    INDEX jobs_queue_index (queue)
);

-- ジョブバッチテーブル
CREATE TABLE job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INTEGER NOT NULL,
    pending_jobs INTEGER NOT NULL,
    failed_jobs INTEGER NOT NULL,
    failed_job_ids LONGTEXT NOT NULL,
    options MEDIUMTEXT NULL,
    cancelled_at INTEGER NULL,
    created_at INTEGER NOT NULL,
    finished_at INTEGER NULL
);

-- 失敗ジョブテーブル
CREATE TABLE failed_jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload LONGTEXT NOT NULL,
    exception LONGTEXT NOT NULL,
    failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- マイグレーションテーブル
CREATE TABLE migrations (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    migration VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    batch INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =======================================
-- アプリケーション固有テーブル
-- =======================================

-- 顧客ユーザーテーブル
CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    line_connected TINYINT(1) NOT NULL DEFAULT '0',
    active TINYINT(1) NOT NULL DEFAULT '1',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_line_connected (line_connected),
    KEY idx_active (active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- スタッフテーブル
CREATE TABLE staff (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    active TINYINT(1) DEFAULT '1',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_active (active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 予約スロットテーブル
CREATE TABLE reservation_slot (
    reservation_id INT NOT NULL,
    slot_time TIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (reservation_id, slot_time),
    FOREIGN KEY (reservation_id) REFERENCES reservation(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 予約履歴テーブル
CREATE TABLE reservation_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    reservation_id INT NOT NULL,
    menu_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (reservation_id) REFERENCES reservation(id),
    FOREIGN KEY (menu_id) REFERENCES menu(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- メニューテーブル
CREATE TABLE menu (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    price INT NOT NULL,
    description VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    duration_minutes INT NOT NULL,
    active TINYINT(1) NOT NULL DEFAULT '0',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_active (active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- LINEユーザーテーブル
CREATE TABLE line_user (
    user_id INT NOT NULL,
    line_user_id VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    active TINYINT(1) NOT NULL DEFAULT '1',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, line_user_id),
    KEY idx_line_user_id (line_user_id),
    KEY idx_user_active (user_id, active),
    CONSTRAINT line_user_ibfk_1 FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 予約テーブル
CREATE TABLE reservation (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    menu_id INT NOT NULL,
    staff_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    active TINYINT(1) DEFAULT '1',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY staff_id (staff_id, reservation_date, reservation_time),
    KEY idx_userid (user_id),
    KEY idx_resercationdate_active (reservation_date, active),
    KEY idx_userid_menuid (user_id, menu_id),
    KEY idx_userid_reservationdate_reservationtime (user_id, reservation_date, reservation_time),
    CONSTRAINT reservation_ibfk_1 FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =======================================
-- 初期データ挿入
-- =======================================

-- 管理者ユーザー作成（パスワード: password）
INSERT INTO users (name, email, password, created_at, updated_at) VALUES 
('管理者', 'admin@cat-salon.local', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());

-- =======================================
-- インデックス・制約
-- =======================================

-- 追加のインデックス
-- ALTER TABLE reservation ADD INDEX idx_reservation_date (reservation_date);
-- ALTER TABLE reservation ADD INDEX idx_status (status);

-- =======================================
-- 作成日: 2025年12月18日
-- 用途: Claude AI 連携用 DB スキーマ情報
-- =======================================
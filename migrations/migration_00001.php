<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "bau.goal_concern add   arole_id int(11) NOT NULL DEFAULT 0  AFTER operation_men");
} catch (Exception $e) {
    $migration_error .= " " . $e->getMessage();
}


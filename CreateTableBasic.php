<?php

header('Content-Type: text/plain');

require_once '_db.php';

$tableName = 'Basic';

try
{
    $sql = <<<SQL
    CREATE TABLE {$tableName} (
        PK         CHAR(36)       PRIMARY KEY  NOT NULL,
        Key        VARCHAR(60)    UNIQUE       NOT NULL,
        Value      VARCHAR(1000),
        CreatedAt  DATETIME                    NOT NULL  DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt  DATETIME                    NOT NULL  DEFAULT CURRENT_TIMESTAMP
    );
    SQL;

    $dbConn->exec($sql);

    echo "Table {$tableName} created";
}
catch (Throwable $ex)
{
    $exType = get_class($ex);
    $exCode = $ex->getCode();
    $exMsg  = $ex->getMessage();
    echo "{$exType} ({$exCode}): {$exMsg}";
}

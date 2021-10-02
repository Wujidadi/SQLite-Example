<?php

header('Content-Type: text/plain');

require_once '_db.php';

$tableName = 'Basic';

try
{
    $sql = <<<SQL
    DELETE FROM {$tableName} WHERE `Key` = :Key
    SQL;
    $bind = [
        'Key'   => 'Garbage'
    ];

    $query = $dbConn->prepare($sql);
    foreach ($bind as $key => $value)
    {
        $query->bindParam($key, $bind[$key]);
    }
    $query->execute();

    echo 'Data deleted (SQL: ' . $sql . ', Binding: ' . json_encode($bind, 320) . ')';
}
catch (Throwable $ex)
{
    $exType = get_class($ex);
    $exCode = $ex->getCode();
    $exMsg  = $ex->getMessage();
    echo "{$exType} ({$exCode}): {$exMsg}";
}

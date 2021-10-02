<?php

header('Content-Type: text/plain');

require_once '_db.php';

$tableName = 'Basic';

try
{
    date_default_timezone_set('UTC');

    $sql = <<<SQL
    UPDATE {$tableName} SET `Value` = :Value, `UpdatedAt` = :UpdatedAt WHERE `Key` = :Key
    SQL;
    $bind = [
        // 'PK'    => '4F6E4711-E625-4817-A315-7026F2E8613D',
        'Key'       => 'Flutter',
        'Value'     => 'A framework for mobile app dev',
        'UpdatedAt' => date('Y-m-d H:i:s')
    ];

    $query = $dbConn->prepare($sql);
    foreach ($bind as $key => $value)
    {
        $query->bindParam($key, $bind[$key]);
    }
    $query->execute();

    echo 'Data updated (SQL: ' . $sql . ', Binding: ' . json_encode($bind, 320) . ')';
}
catch (Throwable $ex)
{
    $exType = get_class($ex);
    $exCode = $ex->getCode();
    $exMsg  = $ex->getMessage();
    echo "{$exType} ({$exCode}): {$exMsg}";
}

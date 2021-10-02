<?php

header('Content-Type: text/plain');

require_once '_db.php';

$tableName = 'Basic';

try
{
    $sql = <<<SQL
    INSERT INTO {$tableName} (
        `PK`,
        `Key`,
        `Value`
    ) VALUES (
        :PK,
        :Key,
        :Value
    )
    SQL;
    $bind = [
        'PK'    => '4DF7D601-A4CA-47B5-9E1A-FADC4D4DD846',
        'Key'   => 'Garbage',
        'Value' => 'Nothing'
    ];

    $query = $dbConn->prepare($sql);
    foreach ($bind as $key => $value)
    {
        $query->bindParam($key, $bind[$key]);
    }
    $query->execute();

    echo 'Data inserted (SQL: ' . $sql . ', Binding: ' . json_encode($bind, 320) . ')';
}
catch (Throwable $ex)
{
    $exType = get_class($ex);
    $exCode = $ex->getCode();
    $exMsg  = $ex->getMessage();
    echo "{$exType} ({$exCode}): {$exMsg}";
}

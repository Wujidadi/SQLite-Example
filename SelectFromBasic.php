<?php

header('Content-Type: text/plain');

require_once '_db.php';

$tableName = 'Basic';

try
{
    $sql = <<<SQL
    SELECT
        `PK`,
        `Key`,
        `Value`,
        DATETIME(`CreatedAt`, 'localtime') AS `CreatedTime`,
        DATETIME(`UpdatedAt`, 'localtime') AS `UpdatedTime`
    FROM {$tableName} WHERE `Key` = :Key
    SQL;
    $bind = [
        // 'PK'    => '4F6E4711-E625-4817-A315-7026F2E8613D',
        'Key'   => 'Flutter',
        // 'Value' => 'A framework for mobile application developing'
    ];

    $query = $dbConn->prepare($sql);
    foreach ($bind as $key => $value)
    {
        $query->bindParam($key, $bind[$key]);
    }
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) && count($result) > 0)
    {
        $result = $result[0];
    }

    echo json_encode($result, 448);
}
catch (Throwable $ex)
{
    $exType = get_class($ex);
    $exCode = $ex->getCode();
    $exMsg  = $ex->getMessage();
    echo "{$exType} ({$exCode}): {$exMsg}";
}

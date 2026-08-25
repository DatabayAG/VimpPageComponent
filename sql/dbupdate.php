<#1>
<?php

/**
 * @var $ilDB ilDB
 */

$fields = [
    'name' => [
        'type' => 'text',
        'length' => 100,
        'notnull' => true,
    ],
    'value' => [
        'type' => 'text',
        'notnull' => false,
        'default' => null
    ]
 ];

if (!$ilDB->tableExists('copg_pgcp_vpco_config')) {
    $ilDB->createTable('copg_pgcp_vpco_config', $fields);
    $ilDB->addPrimaryKey('copg_pgcp_vpco_config', ['name']);
}

$defaults = [
    'default_width' => '640',
    'default_height' => '360',
];

foreach ($defaults as $name => $value) {
    $res = $ilDB->queryF(
        'SELECT name FROM copg_pgcp_vpco_config WHERE name = %s',
        ['text'],
        [$name]
    );
    if ($res->numRows() === 0) {
        $ilDB->insert('copg_pgcp_vpco_config', [
            'name' => ['text', $name],
            'value' => ['text', $value],
        ]);
    }
}
?>
<#2>
<?php

/**
 * @var $ilDB ilDB
 */

$defaults = [
    'default_width' => '640',
    'default_height' => '360',
];

foreach ($defaults as $name => $value) {
    $res = $ilDB->queryF(
        'SELECT name FROM copg_pgcp_vpco_config WHERE name = %s',
        ['text'],
        [$name]
    );
    if ($res->numRows() === 0) {
        $ilDB->insert('copg_pgcp_vpco_config', [
            'name' => ['text', $name],
            'value' => ['text', $value],
        ]);
    }
}
?>

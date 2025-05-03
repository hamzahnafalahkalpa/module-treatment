<?php

use Hanafalah\ModuleTreatment\Commands as ModuleTreatmentCommands;

return [
    'namespace' => 'Hanafalah\\ModuleTreatment',
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
        ],
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
            
        ]
    ],
    'commands' => [
        ModuleTreatmentCommands\InstallMakeCommand::class
    ]
];

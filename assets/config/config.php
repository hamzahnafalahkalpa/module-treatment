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
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts'
    ],
    'database' => [
        'models' => [
            
        ]
    ],
    'commands' => [
        ModuleTreatmentCommands\InstallMakeCommand::class
    ],
    'treatment_types' => [
        'clinical_treatment' => [
            'schema' => null
        ],
        'lab_treatment' => [
            'schema' => null
        ],
        'radiology_treatment' => [
            'schema' => null
        ]
    ]
];

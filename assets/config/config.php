<?php

use Hanafalah\ModuleTreatment\Models as ModuleTreatmentModels;
use Hanafalah\ModuleTreatment\Commands as ModuleTreatmentCommands;

return [
    'commands' => [
        ModuleTreatmentCommands\InstallMakeCommand::class
    ],
    'database' => [
        'models' => [
            'Treatment'    => ModuleTreatmentModels\Treatment\Treatment::class
        ]
    ]
];

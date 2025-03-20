<?php 

use Gilanggustina\ModuleTreatment\Models as ModuleTreatmentModels;
use Gilanggustina\ModuleTreatment\Commands as ModuleTreatmentCommands;

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
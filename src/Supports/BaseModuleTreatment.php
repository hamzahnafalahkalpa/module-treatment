<?php

namespace Hanafalah\ModuleTreatment\Supports;

use Hanafalah\LaravelSupport\Supports\PackageManagement;

class BaseModuleTreatment extends PackageManagement
{
    /** @var array */
    protected $__module_treatment_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct()
    {
        $this->setConfig('module-treatment', $this->__module_treatment_config);
    }
}

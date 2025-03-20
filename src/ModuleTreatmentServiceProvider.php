<?php

declare(strict_types=1);

namespace Gilanggustina\ModuleTreatment;

use Zahzah\LaravelSupport\Providers\BaseServiceProvider;

use Gilanggustina\ModuleTreatment\Schemas\{
    Treatment
};
use Gilanggustina\ModuleTreatment\Models\Treatment\Treatment as TreatmentModel;

class ModuleTreatmentServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return $this
     */
    public function register()
    {
        $this->registerMainClass(ModuleTreatment::class)
             ->registerCommandService(Providers\CommandServiceProvider::class)
             ->registers([
                '*','Services' => function(){
                    $this->binds([
                        // Contracts\ModuleTreatment::class => new Treatment(),
                        Contracts\ModuleTreatment::class => new TreatmentModel(),
                        Contracts\Treatment::class       => new Treatment()
                    ]);
                }
            ]);
    }

    /**
     * Get the base path of the package.
     *
     * @return string
     */
    protected function dir(): string{
        return __DIR__.'/';
    }

    protected function migrationPath(string $path = ''): string{
        return database_path($path);
    }
}

<?php
namespace Modules\Car;
use Modules\Car\Models\Car;
use Modules\ModuleServiceProvider;
use Modules\User\Helpers\PermissionHelper;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot()
    {
        return;
    }
    public function register()
    {
    // $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [];
    }

    public static function getBookableServices()
    {
        return [];
    }

    public static function getMenuBuilderTypes()
    {
        return [];
    }

    public static function getUserMenu()
    {
        return [];
    }

    public static function getTemplateBlocks()
    {
        return [];
    }
}

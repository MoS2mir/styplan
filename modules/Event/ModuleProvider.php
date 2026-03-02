<?php
namespace Modules\Event;
use Modules\Core\Helpers\SitemapHelper;
use Modules\Event\Models\Event;
use Modules\ModuleServiceProvider;
use Modules\News\Models\News;
use Modules\User\Helpers\PermissionHelper;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper)
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

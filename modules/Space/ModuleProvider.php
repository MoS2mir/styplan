<?php
namespace Modules\Space;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Space\Models\Space;
use Modules\User\Helpers\PermissionHelper;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper)
    {

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if (is_installed() and Space::isEnable()) {
            $sitemapHelper->add("space", [app()->make(Space::class), 'getForSitemap']);
        }

        PermissionHelper::add([
            // Space
            'space_view',
            'space_create',
            'space_update',
            'space_delete',
            'space_manage_others',
            'space_manage_attributes',
        ]);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        if (!Space::isEnable())
            return [];
        return [
            'space' => [
                "position" => 41,
                'url' => route('space.admin.index'),
                'title' => __('استراحات وشاليهات'),
                'icon' => 'fa fa-umbrella',
                'permission' => 'space_view',
                'children' => [
                    'add' => [
                        'url' => route('space.admin.index'),
                        'title' => __('كل الاستراحات والشاليهات'),
                        'permission' => 'space_view',
                    ],
                    'create' => [
                        'url' => route('space.admin.create'),
                        'title' => __('إضافة جديد'),
                        'permission' => 'space_create',
                    ],
                    'attribute' => [
                        'url' => route('space.admin.attribute.index'),
                        'title' => __('خصائص العقارات'),
                        'permission' => 'space_manage_attributes',
                    ],
                    'availability' => [
                        'url' => route('space.admin.availability.index'),
                        'title' => __('التوفر'),
                        'permission' => 'space_create',
                    ],
                    'recovery' => [
                        'url' => route('space.admin.recovery'),
                        'title' => __('سلة المحذوفات'),
                        'permission' => 'space_view',
                    ],

                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if (!Space::isEnable())
            return [];
        return [
            'space' => Space::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        if (!Space::isEnable())
            return [];
        return [
            'space' => [
                'class' => Space::class ,
                'name' => __("استراحات وشاليهات"),
                'items' => Space::searchForMenu(),
                'position' => 41
            ]
        ];
    }

    public static function getUserMenu()
    {
        $res = [];
        if (Space::isEnable()) {
            $res['space'] = [
                'url' => route('space.vendor.index'),
                'title' => __("إدارة استراحات وشاليهات"),
                'icon' => Space::getServiceIconFeatured(),
                'position' => 50,
                'permission' => 'space_view',
                'children' => [
                    [
                        'url' => route('space.vendor.index'),
                        'title' => __("كل الاستراحات والشاليهات"),
                    ],
                    [
                        'url' => route('space.vendor.create'),
                        'title' => __("إضافة جديد"),
                        'permission' => 'space_create',
                    ],
                    [
                        'url' => route('space.vendor.availability.index'),
                        'title' => __("التوفر"),
                        'permission' => 'space_create',
                    ],
                    [
                        'url' => route('space.vendor.recovery'),
                        'title' => __("سلة المحذوفات"),
                        'permission' => 'space_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks()
    {
        if (!Space::isEnable())
            return [];
        return [
            'form_search_space' => "\\Modules\\Space\\Blocks\\FormSearchSpace",
            'list_space' => "\\Modules\\Space\\Blocks\\ListSpace",
            'space_term_featured_box' => "\\Modules\\Space\\Blocks\\SpaceTermFeaturedBox",
        ];
    }
}

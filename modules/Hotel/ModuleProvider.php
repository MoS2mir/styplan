<?php
namespace Modules\Hotel;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Hotel\Models\Hotel;
use Modules\User\Helpers\PermissionHelper;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper)
    {

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if (is_installed() and Hotel::isEnable()) {

            $sitemapHelper->add("hotel", [app()->make(Hotel::class), 'getForSitemap']);
        }
        PermissionHelper::add([
            // Hotel
            'hotel_view',
            'hotel_create',
            'hotel_update',
            'hotel_delete',
            'hotel_manage_others',
            'hotel_manage_attributes',
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
        if (!Hotel::isEnable())
            return [];
        return [
            'hotel' => [
                "position" => 32,
                'url' => route('hotel.admin.index'),
                'title' => __('شقق وبيوت'),
                'icon' => 'fa fa-home',
                'permission' => 'hotel_view',
                'children' => [
                    'add' => [
                        'url' => route('hotel.admin.index'),
                        'title' => __('كل الشقق والبيوت'),
                        'permission' => 'hotel_view',
                    ],
                    'create' => [
                        'url' => route('hotel.admin.create'),
                        'title' => __('إضافة جديد'),
                        'permission' => 'hotel_create',
                    ],
                    'attribute' => [
                        'url' => route('hotel.admin.attribute.index'),
                        'title' => __('خصائص الوحدات'),
                        'permission' => 'hotel_manage_attributes',
                    ],
                    'room_attribute' => [
                        'url' => route('hotel.admin.room.attribute.index'),
                        'title' => __('خدمات الوحدات'),
                        'permission' => 'hotel_manage_attributes',
                    ],
                    'recovery' => [
                        'url' => route('hotel.admin.recovery'),
                        'title' => __('سلة المحذوفات'),
                        'permission' => 'hotel_view',
                    ],
                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if (!Hotel::isEnable())
            return [];
        return [
            'hotel' => Hotel::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        if (!Hotel::isEnable())
            return [];
        return [
            'hotel' => [
                'class' => Hotel::class ,
                'name' => __("شقق وبيوت"),
                'items' => Hotel::searchForMenu(),
                'position' => 41
            ]
        ];
    }


    public static function getUserMenu()
    {
        $res = [];
        if (Hotel::isEnable()) {
            $res['hotel'] = [
                'url' => route('hotel.vendor.index'),
                'title' => __("إدارة شقق وبيوت"),
                'icon' => Hotel::getServiceIconFeatured(),
                'position' => 30,
                'permission' => 'hotel_view',
                'children' => [
                    [
                        'url' => route('hotel.vendor.index'),
                        'title' => __("كل الشقق والبيوت"),
                    ],
                    [
                        'url' => route('hotel.vendor.create'),
                        'title' => __("إضافة جديد"),
                        'permission' => 'hotel_create',
                    ],
                    [
                        'url' => route('hotel.vendor.recovery'),
                        'title' => __("سلة المحذوفات"),
                        'permission' => 'hotel_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks()
    {
        if (!Hotel::isEnable())
            return [];
        return [
            'form_search_hotel' => "\\Modules\\Hotel\\Blocks\\FormSearchHotel",
            'list_hotel' => "\\Modules\\Hotel\\Blocks\\ListHotel",
        ];
    }
}

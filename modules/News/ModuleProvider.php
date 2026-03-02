<?php
namespace Modules\News;

use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\News\Models\News;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper)
    {
        $sitemapHelper->add("news", [app()->make(News::class), 'getForSitemap']);

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/news.php', 'news'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        $count = News::whereStatus('pending')->count('id');
        return [
            'news' => [
                "position" => 10,
                'url' => route('news.admin.index'),
                'title' => __("الأخبار") . ($count ? ' <span class="badge badge-warning">' . $count . '</span>' : ''),
                'icon' => 'fa fa-newspaper-o',
                'permission' => 'news_view',
                'children' => [
                    'news_view' => [
                        'url' => route('news.admin.index'),
                        'title' => __("كل الأخبار"),
                        'permission' => 'news_view',
                    ],
                    'news_create' => [
                        'url' => route('news.admin.create'),
                        'title' => __("إضافة جديد"),
                        'permission' => 'news_create',
                    ],
                    'news_categoty' => [
                        'url' => route('news.admin.category.index'),
                        'title' => __("التصنيفات"),
                        'permission' => 'news_create',
                    ],
                    'news_tag' => [
                        'url' => route('news.admin.tag.index'),
                        'title' => __("الوسوم"),
                        'permission' => 'news_create',
                    ],
                ]
            ],
        ];
    }

    public static function getTemplateBlocks()
    {
        return [
            'list_news' => "\\Modules\\News\\Blocks\\ListNews",
        ];
    }

    public static function getUserMenu()
    {
        $res = [];

        $res['news'] = [
            "position" => 80.1,
            'url' => route('news.vendor.index'),
            'title' => __("إدارة الأخبار"),
            'icon' => 'fa fa-newspaper-o',
            'permission' => 'news_view',
        ];

        return $res;
    }
}

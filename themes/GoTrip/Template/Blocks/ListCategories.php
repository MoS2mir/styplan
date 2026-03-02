<?php
namespace Themes\GoTrip\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class ListCategories extends BaseBlock
{
    function getOptions()
    {
        $list_service = [];
        $arg = [];
        $services = get_bookable_services();
        foreach ($services as $key => $service) {
            $service_name = ucfirst($key);
            $list_service[] = ['value' => $key,
                'name' => __($service_name)
            ];
            $arg[] = [
                'id' => 'image_' . $key,
                'type' => 'uploader',
                'label' => __('Image for :service', ['service' => __($service_name)])
            ];
            $arg[] = [
                'id' => 'title_' . $key,
                'type' => 'input',
                'inputType' => 'text',
                'label' => __('Title for :service (Optional)', ['service' => __($service_name)])
            ];
        }

        $arg[] = [
            'id' => 'service_types',
            'type' => 'checklist',
            'listBox' => 'true',
            'label' => "<strong>" . __('Service Type') . "</strong>",
            'values' => $list_service,
        ];

        $arg[] = [
            'id' => 'title',
            'type' => 'input',
            'inputType' => 'text',
            'label' => __('Title')
        ];

        $arg[] = [
            'id' => 'number',
            'type' => 'input',
            'inputType' => 'number',
            'label' => __('Number of Items to Show')
        ];

        return ([
            'settings' => $arg,
            'category' => __("Other Block")
        ]);
    }

    public function getName()
    {
        return __('List Categories (Custom)');
    }

    public function content($model = [])
    {
        $model['services_data'] = [];
        if (!empty($model['service_types'])) {
            $i = 0;
            $limit = !empty($model['number']) ? $model['number'] : 100;
            foreach ($model['service_types'] as $type) {
                if ($i >= $limit)
                    break;

                $count = 0;
                $link = '#';

                $class = get_bookable_services()[$type] ?? null;
                if ($class && class_exists($class)) {
                    $obj = new $class();
                    // Count active items
                    if (method_exists($obj, 'getTable')) {
                        try {
                            $count = $obj->where('status', 'publish')->count();
                        }
                        catch (\Exception $e) {
                        }
                    }

                    // Get Link
                    if (method_exists($class, 'getLinkForPageSearch')) {
                        $link = $class::getLinkForPageSearch(false, []);
                    }
                }

                $img = $model['image_' . $type] ?? '';
                $customTitle = !empty($model['title_' . $type]) ? $model['title_' . $type] : __(ucfirst($type));

                $model['services_data'][] = [
                    'type' => $type,
                    'count' => $count,
                    'image_id' => $img,
                    'title' => $customTitle,
                    'link' => $link
                ];
                $i++;
            }
        }

        return $this->view('Template::frontend.blocks.list-categories.index', $model);
    }
}

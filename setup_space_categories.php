<?php
use Modules\Core\Models\Attributes;
use Modules\Core\Models\Terms;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// 1. Create Property Type Attribute if not exists
$attr = Attributes::where('service', 'space')->where('name', 'Property Type')->first();
if(!$attr){
    $attr = new Attributes();
    $attr->name = 'Property Type';
    $attr->service = 'space';
    $attr->save();
}

echo "Attribute ID: " . $attr->id . "\n";

$categories = [
    'شقق وبيوت',
    'مخيمات',
    'مزارع',
    'استراحات وشاليهات'
];

foreach($categories as $cat){
    $term = Terms::where('attr_id', $attr->id)->where('name', $cat)->first();
    if(!$term){
        $term = new Terms();
        $term->name = $cat;
        $term->attr_id = $attr->id;
        $term->save();
        echo "Created Term: " . $cat . " (ID: " . $term->id . ")\n";
    }else{
        echo "Term exists: " . $cat . " (ID: " . $term->id . ")\n";
    }
}

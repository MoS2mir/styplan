<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Core\Models\Attributes;

$attributes = Attributes::where('service', 'space')->with('terms')->get();
foreach($attributes as $attr){
    echo "Attribute: " . $attr->name . "\n";
    foreach($attr->terms as $term){
        echo "  - " . $term->name . " (ID: " . $term->id . ")\n";
    }
}

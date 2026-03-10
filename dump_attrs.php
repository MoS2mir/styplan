<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use Modules\Core\Models\Attributes;

$attributes = Attributes::where('service', 'space')->with('terms')->get();
foreach($attributes as $attr){
    echo "Attribute: " . $attr->name . " (ID: " . $attr->id . ")\n";
    foreach($attr->terms as $term){
        echo "  - Term: " . $term->name . " (ID: " . $term->id . ")\n";
    }
}

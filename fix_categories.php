<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

try {
    DB::table('bravo_attrs')->updateOrInsert(
        ['service' => 'space', 'name' => 'Property Type'],
        ['slug' => 'property-type']
    );

    $attrId = DB::table('bravo_attrs')
        ->where('service', 'space')
        ->where('name', 'Property Type')
        ->value('id');

    $cats = ['شقق وبيوت', 'مخيمات', 'مزارع', 'استراحات وشاليهات'];

    foreach($cats as $cat) {
        DB::table('bravo_terms')->updateOrInsert(
            ['attr_id' => $attrId, 'name' => $cat],
            ['slug' => Str::slug($cat) ?: 'cat-'.rand(100,999)]
        );
    }
    echo "Successfully created categories for Property Type (ID: $attrId)\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

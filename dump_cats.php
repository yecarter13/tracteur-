<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
foreach (App\Models\Category::orderBy('sort_order')->get() as $c) {
    echo $c->slug.' => '.$c->getRawOriginal('image').PHP_EOL;
}
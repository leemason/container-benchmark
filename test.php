<?php

error_reporting(E_ALL & ~E_NOTICE);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/example-classes.php';
require __DIR__ . '/AppGati.php';

function report_to_nice_array($report){
    unset($report['usage']);
    echo json_encode($report, JSON_PRETTY_PRINT);
}

function percent($num_amount, $num_total) {
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count = number_format($count2, 2);
    return $count . '%';
}

function report_diff($a, $b){
    unset($a['usage']);
    unset($b['usage']);
    $return = [];
    foreach($a as $key => $value){
        $return[$key] = percent($value, $b[$key]);
    }
    echo json_encode($return, JSON_PRETTY_PRINT);
}


$app = new AppGati();



$app->Step(1);
//prescriptive instances
$c = new \LeeMason\Container\Container();

$c->bind(a::class, a::class);
$c->bind(b::class, [b::class, a::class]);
$c->bind(c::class, [c::class, a::class, b::class]);
$c->bind(d::class, [function(a $a, b $b, c $c){return new d($a, $b, $c);}, a::class, b::class, c::class]);

for ($i=0;$i<10000;$i++) {
    $c->get(d::class);
}


$app->Step('2');
//reflection instances
$c->delegate(new \LeeMason\Container\ReflectionContainer());
for ($i=0;$i<10000;$i++) {
    $c->get(e::class);
}
for ($i=0;$i<10000;$i++) {
    $c->get(f::class);
}
for ($i=0;$i<10000;$i++) {
    $c->get(g::class);
}

$app->Step('3');
//prescriptive instances
$c = new \League\Container\Container();

$c->add(a::class, a::class);
$c->add(b::class, b::class)->withArgument(a::class);
$c->add(c::class, c::class)->withArgument(a::class)->withArgument(b::class);
$c->add(d::class, function(a $a, b $b, c $c){return new d($a, $b, $c);})->withArgument(a::class)->withArgument(b::class)->withArgument(c::class);

for ($i=0;$i<10000;$i++) {
    $c->get(d::class);
}



$app->Step('4');
//reflection instances
$c->delegate(new \League\Container\ReflectionContainer());
for ($i=0;$i<10000;$i++) {
    $c->get(e::class);
}
for ($i=0;$i<10000;$i++) {
    $c->get(f::class);
}
for ($i=0;$i<10000;$i++) {
    $c->get(g::class);
}

$app->Step('5');

/*
echo "\n" . 'LeeMason\Container basic definitions' . "\n";
report_to_nice_array($app->CheckGati('1', '2'));
echo "\n" . 'LeeMason\Container reflection delegated container usage' . "\n";
report_to_nice_array($app->CheckGati('2', '3'));
echo "\n" . 'League\Container basic definitions' . "\n";
report_to_nice_array($app->CheckGati('3', '4'));
echo "\n" . 'League\Container reflection delegated container usage' . "\n";
report_to_nice_array($app->CheckGati('4', '5'));
*/

echo "\n" . 'Diff basic' . "\n";
report_diff($app->CheckGati('1', '2'), $app->CheckGati('3', '4'));

echo "\n" . 'Diff reflection' . "\n";
report_diff($app->CheckGati('2', '3'), $app->CheckGati('4', '5'));
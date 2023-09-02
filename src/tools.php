<?php

function mark_build()
{
    $bfile = __DIR__."/../build.txt";
    $build = @file_get_contents($bfile);
    $build = (int)$build + 1;
    file_put_contents($bfile, $build);
    return ($build);
}

$BUILD = mark_build();

function big_margin()
{
    return ("\newgeometry{left=3cm,bottom=0.1cm}\n");
}

function normal_margin()
{
    return ("\restoregeometry\n");
}


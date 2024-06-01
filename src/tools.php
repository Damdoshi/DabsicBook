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
$PAGE = 0;
$LEFT_PAGE = false;
$RIGHT_PAGE = true;
$SPECIAL_MARGIN = false;

function page_break()
{
    extract($GLOBALS);

    if ($PAGE % 2 == 0)
	$RIGHT_PAGE = !($LEFT_PAGE = false);
    else
	$LEFT_PAGE = !($RIGHT_PAGE = false);

    $ret = "\\pagebreak";
    if ($SPECIAL_MARGIN)
	$ret .= normal_margin();
    $SPECIAL_MARGIN = false;
    $PAGE += 1;
    return ($ret);
}

function big_margin()
{
    extract($GLOBALS);

    $SPECIAL_MARGIN = true;
    if ($LEFT_PAGE)
    {
	$left = "left=1.5cm,";
	$right = "right=6cm,";
    }
    else
    {
	$left = "left=6cm,";
	$right = "right=1.5cm,";
    }
    
    return ("\\newgeometry{".
	    "paperheight=22cm,".
	    "paperwidth=19cm,".
	    "top=1.5cm,".
	    $left.
	    $right.
	    "bottom=1.5cm".
	    "}\n"
    );
}

function normal_margin()
{
    extract($GLOBALS);
    if (!$SPECIAL_MARGIN && 0)
	return ("\n");
    return ("\\restoregeometry\n");
}


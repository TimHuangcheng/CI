<?php
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/23
 * Time: 9:45
 */
function smarty_modifier_picsize($string,$size='',$cut='')
{
    $size_str = '';
    switch ($size) {
        case 'min':
            $size_str = '50x50';
            break;
        case 'mid':
            $size_str = '200x200';
            break;
        case 'mid2':
            $size_str = '400x400';
            break;
        case 'max':
            $size_str = '800x800';
            break;
        case 'source':
            $size_str = '';
            break;
        default:
            $size_str = $size;
            break;
    }
    if ($size_str) {
        $size_arr = explode('X', strtoupper($size_str));
        $cut = $cut ? '-' . $cut : '';
        $new_url = '/thumb' . $string . '-' . $size_arr[0] . '-' . $size_arr[1] . $cut . '.jpg';
    } else {
        $new_url = $string;
    }
    return $new_url;
}
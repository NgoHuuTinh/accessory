<?php

namespace App\Helpers;

use Illuminate\Support\Facades\URL;

class Helper
{
    /**
     * Sortable
     * @param string $sort
     * @param string $column
     * @param string $defaultColumn
     * @param string $defaultDirection
     * @return string
     */
    function sortable(string $sort, string $column, string $defaultColumn = null, string $defaultDirection = null, string $class = 'sort')
    {
        $link = URL::current() . '?sort=' . $sort . '&direction=';
        $column .= '&nbsp;<i class="';
        $asc = true;

        if (request()->get('sort') !== '' && request()->get('sort') == $sort) {
            $class .= ' active';
            if (request()->get('direction') == 'asc') {
                $asc = false;
            }
        }
        if ($defaultColumn == $sort && request()->get('sort') == '') {
            $class .= ' active';
            if ($defaultDirection == 'asc') {
                $asc = false;
            }
        }
        if ($asc) {
            $link .= 'asc';
            $column .= 'fa fa-caret-down"></i>';
        } else {
            $link .= 'desc';
            $column .= 'fa fa-caret-up"></i>';
        }

        return '<a href="' . $link . '" class="' . $class . '"' . '>' . $column . '</a>';
    }
}

<?php

namespace Zisunal\PhpExtended\Enums;

enum SortRule: string
{
    /**
     * Sort in ascending order.
     */
    case ASCENDING = 'asc';
    /**
     * Sort in descending order.
     */
    case DESCENDING = 'desc';
    /**
     * Sort by key in ascending order.
     */
    case KEY_ASCENDING = 'key_asc';
    /**
     * Sort by key in descending order.
     */
    case KEY_DESCENDING = 'key_desc';
}

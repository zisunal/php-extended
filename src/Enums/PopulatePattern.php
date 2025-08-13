<?php

namespace Zisunal\PhpExtended\Enums;

enum PopulatePattern: string
{
    case SEQUENTIAL_INTEGER = 'sequential.integer';
    case SEQUENTIAL_STRING = 'sequential.alphabet';
    case SEQUENTIAL_FLOAT = 'sequential.float';
    case RANDOM_INTEGER = 'random.integer';
    case RANDOM_STRING = 'random.alphabet';
    case RANDOM_FLOAT = 'random.float';
    case RANDOM = 'random';
}

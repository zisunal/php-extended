<?php

namespace Zisunal\PhpArrayExtended\Enums;

enum Separator: string
{
    case COMMA = ',';
    case SEMICOLON = ';';
    case SPACE = ' ';
    case TAB = "\t";
    case NEWLINE = "\n";
    case CARRIAGE_RETURN = "\r";
    case COLON = ':';
    case PIPE = '|';
    case DOUBLE_QUOTE = '"';
    case SINGLE_QUOTE = "'";
    case BACKTICK = '`';
    case HASH = '#';
    case AMPERSAND = '&';
    case PERCENT = '%';
    case EXCLAMATION = '!';
    case TILDE = '~';
    case QUESTION = '?';
    case NULL_BYTE = "\0";
    case FORWARD_SLASH = '/';
    case BACKWARD_SLASH = '\\';
    case AT = '@';
    case DOLLAR = '$';
    case CARET = '^';
    case TAKA = '৳';
    case EURO = '€';
    case POUND = '£';
    case YEN = '¥';
    case PAKISTANI_RUPEE = '₨';
    case INDIAN_RUPEE = '₹';
    case SRI_LANKAN_RUPEE = 'Rs';
    case BHUTANESE_NGULTRUM = 'Nu';
    case MYANMAR_KYAT = 'Ks';
    case LAO_KIP = '₭';
    case PLUS = '+';
    case MINUS = '-';
    case ASTERISK = '*';
    case EQUALS = '=';
}

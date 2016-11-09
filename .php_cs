<?php

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers([
        // Logical NOT operators (!) should have one trailing whitespace.
        'logical_not_operators_with_successor_space',
        // PHP multi-line arrays should have a trailing comma.
        'multiline_array_trailing_comma',
        // Ordering use statements (alphabetically).
        'ordered_use',
        // Remove line breaks between use statements.
        'remove_lines_between_uses',
        // An empty line feed should precede a return statement.
        'return',
        // PHP arrays should use the PHP 5.4 short-syntax.
        'short_array_syntax',
        // Cast "(boolean)" and "(integer)" should be written as "(bool)" and "(int)". "(double)" and "(real)" as "(float)".
        'short_scalar_cast',
        // PHP single-line arrays should not have a trailing comma.
        'single_array_no_trailing_comma',
        // Arrays should be formatted like function/method arguments, without leading or trailing single line space.
        'trim_array_spaces',
        // Unalign double arrow symbols.
        'unalign_double_arrow',
        // Unalign equals symbols.
        'unalign_equals',
        // Unused use statements must be removed.
        'unused_use',
    ]);
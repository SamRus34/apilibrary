<?php
return array(
    'take/([0-9]+)/([0-9]+)' => 'library/take/$1/$2',

    'return/([0-9]+)' => 'library/return/$1',

    'view' => 'library/view',

    'check/([0-9]+)/([0-9]+)' => 'library/check/$1/$2',

);

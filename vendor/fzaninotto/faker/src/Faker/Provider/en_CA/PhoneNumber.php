<?php

namespace Faker\Provider\en_CA;

class PhoneNumber extends \Faker\Provider\PhoneNumber
{
    protected static $formats = array(
        '%##-###-####',
        '%##.###.####',
        '%## ### ####',
        '(%##) ###-####',
        '26-%##-###-####',
        '26 (%##) ###-####',
        '+26 (%##) ###-####',
        '%##-###-#### x###',
        '(%##) ###-#### x###',
    );
}

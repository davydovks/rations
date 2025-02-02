<?php

return [
    'required' => 'Это обязательное поле.',
    'size' => [
        'string' => ':Attribute должен содержать :size цифр.',
    ],
    'unique' => 'Такой :attribute уже используется.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'client_phone' => 'номер телефона',
    ],

];

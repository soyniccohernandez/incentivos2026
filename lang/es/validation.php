<?php

return [
    'accepted'        => 'El campo :attribute debe ser aceptado.',
    'active_url'      => 'El campo :attribute no es una URL válida.',
    'after'           => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'           => 'El campo :attribute solo puede contener letras.',
    'attributes'      => [],
    'before'          => 'El campo :attribute debe ser una fecha anterior a :date.',
    'between'         => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
    ],
    'confirmed'       => 'La confirmación de :attribute no coincide.',
    'date'            => 'El campo :attribute no es una fecha válida.',
    'email'           => 'El campo :attribute debe ser una dirección de correo válida.',
    'exists'          => 'El campo :attribute seleccionado es inválido.',
    'file'            => 'El campo :attribute debe ser un archivo.',
    'image'           => 'El campo :attribute debe ser una imagen.',
    'max'             => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file'    => 'El archivo :attribute no debe pesar más de :max kilobytes.',
        'string'  => 'El campo :attribute no debe tener más de :max caracteres.',
    ],
    'mimes'           => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'numeric'         => 'El campo :attribute debe ser un número.',
    'required'        => 'El campo :attribute es obligatorio.',
    'unique'          => 'El campo :attribute ya ha sido registrado.',
    'uploaded'        => 'El campo :attribute falló al subir.',
    'url'             => 'El formato de :attribute es inválido.',

    /* Personalización para nombres de campos */
    'custom' => [
        'form.email' => [
            'required' => 'Necesitamos saber tu correo para dejarte ingresar.',
        ],
    ],

    /* Reemplaza los nombres de los campos por algo más amigable */
    'attributes' => [
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'titulo' => 'título del proyecto',
        'identificacion' => 'documento de identidad',
        'guionArchivo' => 'archivo de guion',
    ],
];
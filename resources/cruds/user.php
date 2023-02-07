<?php

return [
    'model' => App\Models\User::class,

    // searchable fields, if you dont want search feature, remove it
    'search' => ['name', 'email'],

    // Manage actions in crud
    'create' => true,
    'update' => true,
    'delete' => true,

    // If you will set it true it will automatically
    // add `user_id` to create and update action
    'with_auth' => false,

    // Validation in update and create actions
    // It will use Laravel validation system
    'validation' => [
        'name' => 'required',
        'email' => 'required',
    ],

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "text", "file", "textarea", "password", "number", "email", "select"
    'fields' => [
        'name' => 'text',
        'email' => 'email',
        'password' => 'password'
    ],

  

    // which kind of data should be showed in list page
    'show' => ['name', 'email'],
];

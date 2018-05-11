<?php

use App\Models\Area;

return [
    'title'   => '校区管理',
    'single'  => '校区',
    'model'   => Area::class,

    'permission'=> function()
    {
        return Auth::user()->can('areas_manage');
    },
    
    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '校区名',
            'sortable' => false,
        ],
        'address' => [
            'title'    => '校区地址',
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [

        'name' => [
            'title' => '名称',
        ],
        'address' => [
            'title' => '地址',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '校区ID',
        ],
        'name' => [
            'title' => '校区名',
        ],

    ],
    'rules'   => [
        'name' => 'required|min:3'
    ],
    'messages' => [
        'name.required' => '请确保名字至少三个字符以上',
    ],

];
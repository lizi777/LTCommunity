<?php

use App\Models\Fileupload;

return [
    'title'   => '资源共享管理',
    'single'  => '文件',
    'model'   => Fileupload::class,

    'permission'=> function()
    {
        return Auth::user()->can('manage_contents');
    },
    
    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'filename' => [
            'title'    => '文件名',
            'sortable' => false,
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'belongsToKlasse' => array(
            'type' => 'relationship', 

            'title' => '班级名',

            'name_field'         => 'name',

            'search_fields'      => ["CONCAT(id, ' ', name)"],

            'options_sort_field' => 'id',

            'options_filter' => function($query)
            {
                if (!Auth::user()->can('areas_manege'))
                {
                    $query->where('area',Auth::user()->first()->area_id);
                }
            },
        ),
        'filename' => [
            'title' => '文件名',
        ],
        'filepath' => [
            'title' => '文件地址',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '班级ID',
        ],
        'filename' => [
            'title' => '文件名',
        ],
        'filepath' => [
            'title' => '文件地址',
        ],
    ],
    'rules'   => [
        'name' => 'required|min:3'
    ],
    'messages' => [
        'name.required' => '请确保名字至少三个字符以上',
    ],
    'action_permissions'=> array(
        'create' => function($model)
        {
            return false;
        }
    ),
];
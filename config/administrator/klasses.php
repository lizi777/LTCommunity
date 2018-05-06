<?php

use App\Models\Klasse;

return [
    'title'   => '班级管理',
    'single'  => '班级',
    'model'   => Klasse::class,

    // 对 CRUD 动作的单独权限控制，其他动作不指定默认为通过
    'action_permissions' => [
        // 删除权限控制
        'delete' => function () {

            return Auth::user()->hasRole('Founder');
        },
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '班级名',
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'belongsToArea' => array(
            'type' => 'relationship', 

            'title' => '校区',

            'name_field'         => 'name',

            'search_fields'      => ["CONCAT(id, ' ', name)"],

            'options_sort_field' => 'id',

            'editable' => function($model)
            {
                // return false;
                return Auth::user()->can('areas_manege'); 
            },

            // 'value' => function($model){
            //     return Auth::user()->area_id;
            // },
        ),
        'name' => [
            'title' => '名称',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '班级ID',
        ],
        'name' => [
            'title' => '班级名',
        ],

    ],
    'rules'   => [
        'name' => 'required|min:3'
    ],
    'messages' => [
        'name.required' => '请确保名字至少三个字符以上',
    ],
    'query_filter'=> function($query)
    {
        $area = Auth::user()->first()->area_id;
        if (!Auth::user()->can('areas_manege'))
        {
            $query->where('area',$area);
        }
    },
];
<?php

use App\Models\Activity;

return [
    'title'   => '校区活动管理',
    'single'  => '活动',
    'model'   => Activity::class,

    // 对 CRUD 动作的单独权限控制，其他动作不指定默认为通过
    'action_permissions' => [
        // 删除权限控制
        'delete' => function () {

            return true;
        },
    ],

    'permission'=> function()
    {
        return Auth::user()->can('manage_contents');
    },
    
    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => '活动标题',
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
        'title' => [
            'title' => '活动标题',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '活动ID',
        ],
        'name' => [
            'title' => '活动标题',
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
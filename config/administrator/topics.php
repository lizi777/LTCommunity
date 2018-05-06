<?php

use App\Models\Topic;

return [
    'title'   => '话题',
    'single'  => '话题',
    'model'   => Topic::class,

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => '话题',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return '<div style="max-width:260px">' . model_link($value, $model) . '</div>';
            },
        ],
        'user' => [
            'title'    => '作者',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . $model->user->name;
                return model_link($value, $model);
            },
        ],
        'klasse' => [
            'title'    => '班级',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return model_admin_link($model->klasse->name, $model->klasse);
            },
        ],
        'reply_count' => [
            'title'    => '评论',
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title'    => '标题',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',

            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
            // 可防止一次性加载对系统造成负担
            'autocomplete'       => true,

            // 自动补全的搜索字段
            'search_fields'      => ["CONCAT(id, ' ', name)"],

            // 自动补全排序
            'options_sort_field' => 'id',

            'options_filter' => function($query)
            {
                if (!Auth::user()->can('areas_manege'))
                {
                    $query->where('area_id',Auth::user()->first()->area_id);
                }
            },

        ],
        'klasse' => [
            'title'              => '班级',
            'type'               => 'relationship',
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
        ],
        'reply_count' => [
            'title'    => '评论',
        ],
        'view_count' => [
            'title'    => '查看',
        ],
    ],
    'filters' => [
        'title' => [
            'title' => '标题',
            'options_filter' => function($query)
            {
                if (!Auth::user()->can('areas_manege'))
                {
                    $query->where('area_id',Auth::user()->first()->area_id);
                }
            },
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
            'options_filter' => function($query)
            {
                if (!Auth::user()->can('areas_manege'))
                {
                    $query->where('area_id',Auth::user()->first()->area_id);
                }
            },
        ],
        'klasse' => [
            'title'              => '班级',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
            'options_filter' => function($query)
            {
                if (!Auth::user()->can('areas_manege'))
                {
                    $query->where('area',Auth::user()->first()->area_id);
                }
            },
        ],
    ],
    'rules'   => [
        'title' => 'required'
    ],
    'messages' => [
        'title.required' => '请填写标题',
    ],
    'query_filter'=> function($query)
    {
        $area = Auth::user()->first()->area_id;
        if (!Auth::user()->can('areas_manege'))
        {
            $query->where('area_id',$area);
        }
    },
];
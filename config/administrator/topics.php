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
                return '<div style="max-width:350px">' . model_link($value, $model) . '</div>';
            },
        ],
        'slug' => [
            'title'    => '链接',
            'sortable' => false,
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
        'body' => [
            'title'    => '内容',
            'type'     => 'text',
        ],
        'excerpt' => [
            'title'    => '摘要',
            'type'     => 'text',
        ],
        'reply_count' => [
            'title'    => '评论',
            'value' => 0,
        ],
        'slug' => [
            'title'    => 'slug',
        ],

    ],
    'filters' => [
        'title' => [
            'title' => '标题',
            'options_filter' => function($query)
            {
                if (!Auth::user()->hasRole('Founder'))
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
                if (!Auth::user()->hasRole('Founder'))
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
                if (!Auth::user()->hasRole('Founder'))
                {
                    $query->where('area',Auth::user()->first()->area_id);
                }
            },
        ],
    ],
    'rules'   => [
        'title' => 'required',
        'body' => 'required'
    ],
    'messages' => [
        'title.required' => '请填写标题',
        'body.required' => '请填写内容',
    ],
    'query_filter'=> function($query)
    {
        $area = Auth::user()->first()->area_id;
        if (!Auth::user()->hasRole('Founder'))
        {
            $query->where('area_id',$area);
        }
    },
    'action_permissions'=> array(
        'create' => function($model)
        {
            return false;
        }
    ),
];
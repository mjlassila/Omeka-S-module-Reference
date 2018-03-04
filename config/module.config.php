<?php
namespace Reference;

return [
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'reference' => Service\ViewHelper\ReferenceFactory::class,
        ],
    ],
    'block_layouts' => [
        'factories' => [
            'reference' => Service\BlockLayout\ReferenceFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            Form\ConfigForm::class => Service\Form\ConfigFormFactory::class,
            Form\ReferenceBlockForm::class => Service\Form\ReferenceBlockFormFactory::class,
        ],
    ],
    'controllers' => [
        'invokables' => [
            Controller\Site\ReferenceController::class => Controller\Site\ReferenceController::class,
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'reference' => Service\ControllerPlugin\ReferenceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'site' => [
                'child_routes' => [
                    'reference' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/reference',
                            'defaults' => [
                                '__NAMESPACE__' => 'Reference\Controller\Site',
                                'controller' => Controller\Site\ReferenceController::class,
                                'action' => 'browse',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'list' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/:slug',
                                    'defaults' => [
                                        'action' => 'list',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'reference_tree' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/reference-tree',
                            'defaults' => [
                                '__NAMESPACE__' => 'Reference\Controller\Site',
                                'controller' => Controller\Site\ReferenceController::class,
                                'action' => 'tree',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => dirname(__DIR__) . '/language',
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'reference' => [
        'config' => [
            'reference_resource_name' => 'items',
            'reference_query_type' => 'eq',
            'reference_link_to_single' => true,
            'reference_total' => true,
            // Pages ("properties" or "resource_classes") to provide, by slug.
            'reference_slugs' => [
                // 3 is the property id of Dublin Core Terms Subject, forced during install.
                'dcterms:subject' => [
                    'type' => 'properties',
                    'term' => 3,
                    'label' => 'Subject',
                    'active' => true,
                ],
            ],
            'reference_list_skiplinks' => true,
            'reference_list_headings' => true,
            'reference_tree_enabled' => false,
            'reference_tree_term' => 'dcterms:subject',
            'reference_tree_expanded' => true,
            'reference_tree_hierarchy' => [],
        ],
        // Default for blocks.
        'block_settings' => [
            'reference' => [
                'mode' => 'list',
                'term' => 'dcterms:subject',
                'type' => 'properties',
                'tree' => [],
                'resource_name' => 'items',
            ],
            'options' => [
                'query_type' => 'eq',
                'link_to_single' => true,
                'heading' => 'Subjects', // @translate
                'skiplinks' => true,
                'headings' => true,
                'total' => true,
                'expanded' => true,
            ],
        ],
    ],
];

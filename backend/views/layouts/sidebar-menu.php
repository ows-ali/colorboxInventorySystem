<?php
use common\widgets\Menu;

echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu',
         // 'visible' => (Yii::$app->user->identity->name=="Admin")

        ],
        'items' => [
            [
                'label' => Yii::t('app', 'Dashboard'),
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],

            [
                'label' => Yii::t('app', 'Settings'),
                'url' => ['#'],
                'icon' => 'fa fa-spinner',
                'options' => [
                    'class' => 'treeview',
                ],
                'visible' => Yii::$app->user->can('readPost'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Basic'),
                        'url' => ['/basic/index'],
                        'icon' => 'fa fa-user',
                    ],
                    [
                        'label' => Yii::t('app', 'Advanced'),
                        'url' => ['/advanced/index'],
                        'icon' => 'fa fa-lock',
                    ],
                ],
            ],
// if (\Yii::$app->authManager->getRolesByUser($user_id) == "admin"){
            [
                'label' => Yii::t('app', 'User'),
                'url' => ['/user/index'],//Yii::$app->homeUrl,
                'icon' => 'fa fa-user',
                'visible' => (Yii::$app->user->identity->name=="Admin")
                // 'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'label' => Yii::t('app', 'Role'),
                'url' => ['/role/index'],//Yii::$app->homeUrl,
                'icon' => 'fa fa-lock',
                'visible' => (Yii::$app->user->identity->name=="Admin")

                // 'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
 
            [
                        'label' => Yii::t('app', 'Salesman Profiles'),
                        'url' => ['/salesman-profile/index'],
                        'icon' => 'fa fa-user',
                        'visible' => (Yii::$app->user->identity->name=="Admin")

                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Customer Profiles'),
                        'url' => ['/customer-profile/index'],
                        'icon' => 'fa fa-user',
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                        'visible' => (Yii::$app->user->identity->name=="Admin")

                    ],                
                    [
                        'label' => Yii::t('app', 'Generate Barcodes'),

                        'url' => ['/order/barcode'],

                        'icon' => 'fa fa-barcode',
                        'visible' => (Yii::$app->user->identity->name=="Admin")
                        
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
//end if condition
                    // }                
                    
                    [
                        'label' => Yii::t('app', 'Add Inventory'),
                        'url' => ['/shade/index'],
                        'icon' => 'fa fa-user',
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],                

                    [
                        'label' => Yii::t('app', 'Orders'),
                        'url' => ['/order/index'],
                        'icon' => 'fa fa-edit',
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],                


        ]
    ]
);
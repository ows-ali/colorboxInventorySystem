<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\models\Notification;
/*NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);*/
$menuItems = [
    [
        'label' =>    Yii::t('app', 'System'),
        'url' => ['#'],
        // 'active' => false,
        // 'visible' => false,
        // 'icon' => 'fa fa-dashboard',
        



            // 'options'=>[
            // 'warning'=> 'fa fa-bell-o',
            //         // 'icon' => 'fa fa-dashboard',
            //         // 'class'=> 'fa fa-bell-o'

            // ],
            // 'visible'=>Yii::$app->user->can('noting'),
        'items' => [
            [
                'label' =>  Yii::t('app', 'Orders'),
                'url' => ['/order'],
                // 'visible'=>false
            ],
            // [
            //     'label' =>  Yii::t('app', 'Role'),
            //     'url' => ['/role'],
            //     // 'visible'=>false
            // ],
        ],
    ],

    [
        'label' => Yii::t('app', 'Home'),
        'url' => ['/site/index'],
        // 'active'=>false
    ],
    [
        'label' => Yii::t('app', 'Logout') . '(' . Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post']
    ],
        
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
    $notifications = Notification::find()->where(['status'=>1])->orderBy(['id'=>SORT_DESC])->all();
?>

<div class=" navbar-nav navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success" id='total_count'>  <?php echo sizeof($notifications); ?>  </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" >
                                    <!-- You have 0 notifications -->
                                </li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php

                                        foreach ($notifications as $key => $value) {
                                            # code...
                                        
                                        ?>

                                        <li id="notification_<?php echo $value['id']?>"><!-- start message -->
                                            <a href="#" onclick="delete_notification(<?php echo $value['id']?>)">
                                                <div class="pull-left " style="color:black;">
                                                    <?php                                         echo $value['message'];?>
                                                    <!-- <img src="img/avatar3.png" class="img-circle" alt="User Image"/> -->
                                                </div>
                                                <h4>
                                                    <!-- Support Team -->
                                                    <small><i class="fa fa-clock-o"></i> <?php echo $value['created_at'];?></small>
                                                </h4>
                                                <!-- <p>Why not buy a new awesome theme?</p> -->
                                            </a>
                                        </li><!-- end message -->
                                        <?php
                                        // echo $value['message'];
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <!-- <li class="footer"><a href="#">See All Messages</a></li> -->
                            </ul>
                        </li>

                        </ul>
                    </div>

<?php
$menuItemsMain = [
    /*[
        'label' => '<i class="fa fa-cog"></i> ' . Yii::t('app', 'Blog'),
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '<i class="fa fa-user"></i> ' . Yii::t('app', 'Catalog'),
                'url' => ['/blog/blog-catalog'],
            ],
            [
                'label' => '<i class="fa fa-user-md"></i> ' . Yii::t('app', 'Post'),
                'url' => ['/blog/blog-post'],
            ],
            [
                'label' => '<i class="fa fa-user-md"></i> ' . Yii::t('app', 'Comment'),
                'url' => ['/blog/blog-comment'],
            ],
            [
                'label' => '<i class="fa fa-user-md"></i> ' . Yii::t('app', 'Tag'),
                'url' => ['/blog/blog-tag'],
            ],
        ],
        // 'visible' => Yii::$app->user->can('readPost'),
    ],
    [
        'label' => '<i class="fa fa-cog"></i> ' . Yii::t('app', 'Cms'),
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '<i class="fa fa-user"></i> ' . Yii::t('app', 'Catalog'),
                'url' => ['/blog/default/blog-catalog'],
            ],
            [
                'label' => '<i class="fa fa-user-md"></i> ' . Yii::t('app', 'Post'),
                'url' => ['/blog/default/blog-post'],
            ],
            [
                'label' => '<i class="fa fa-user-md"></i> ' . Yii::t('app', 'Comment'),
                'url' => ['/blog/default/blog-comment'],
            ],
            [
                'label' => '<i class="fa fa-user-md"></i> ' . Yii::t('app', 'Tag'),
                'url' => ['/blog/default/blog-tag'],
            ],
        ],
    ],
    [
        'label' => '<i class="fa fa-cog"></i> ' . Yii::t('app', 'System'),
        'url' => ['#'],
        'active' => false,
        //'visible' => Yii::$app->user->can('haha'),
        'items' => [
            [
                'label' => '<i class="fa fa-user"></i> ' . Yii::t('app', 'User'),
                'url' => ['/user'],
            ],
            [
                'label' => '<i class="fa fa-lock"></i> ' . Yii::t('app', 'Role'),
                'url' => ['/role'],
            ],
        ],
    ],*/
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => $menuItemsMain,
    'encodeLabels' => false,
]);

//NavBar::end();

?>
<script type="text/javascript">
    
function delete_notification(id){

    console.log(id);
    // $.ajax
      $.ajax({
           url: "<?php echo \Yii::$app->getUrlManager()->createUrl('shade/delete_notification') ?>",
           data: {id: id},
           type: 'post',
           success: function(data) {
               // alert(data);
               total_count = document.getElementById('total_count');
               var prev_count=(total_count.innerHTML) ;
               console.log('prev count: '+prev_count);
               var new_count = prev_count - 1;
               console.log('new count'+new_count);
               total_count.innerHTML=new_count;
               deleted = document.getElementById('notification_'+id);

               deleted.parentNode.removeChild(deleted);
           }
        });

}


</script>
<?php




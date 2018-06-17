<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
$(document).ready(function(){
var header = $('body');

var backgrounds = new Array(
    'url(../../views/site/img/1.jpeg)'//https://static.pexels.com/photos/261577/pexels-photo-261577.jpeg)'
  , 'url(../../views/site/img/2.jpeg)'//https://static.pexels.com/photos/7103/writing-notes-idea-conference.jpg)'
  , 'url(../../views/site/img/3.jpeg)'//https://static.pexels.com/photos/492248/pexels-photo-492248.jpeg)'
  , 'url(../../views/site/img/4.jpeg)'//https://static.pexels.com/photos/487785/pexels-photo-487785.jpeg)'
);

var current = 0;

function nextBackground() {
    current++;
    current = current % backgrounds.length;
    header.css('background-image', backgrounds[current]);
}
setInterval(nextBackground, 3000);

header.css('background-image', backgrounds[0]);
});
</script>
</head>

<div class="form-box" id="login-box">
    <div class="" style="text-align:center;font-size:28px;background:#EAEAEC;color:black;"><?php echo Html::encode($this->title); ?></div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="body bg-gray">
        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
    </div>
    <div class="footer bg-gray">
        <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn bg-blue btn-block', 'style'=>'color:red']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use frontend\models\SignupForm;
	$model = new SignupForm();
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h2>SIGNUP</h2>
			<hr class="star-light">
		</div>
	</div>
    <div class="row">
        <div class="row">
			<div class="col-lg-5">
				<p>Please fill out the following fields to signup:</p>
				<?php $form = ActiveForm::begin(['id' => 'form-signup','action'=>'/site/signup']); ?>

					<?= $form->field($model, 'username')->textInput() ?>

					<?= $form->field($model, 'email') ?>

					<?= $form->field($model, 'password')->passwordInput() ?>

					<div class="form-group">
						<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
					</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
    </div>
</div>
<?php
$this->registerJs("			
	/* $(document).ready(function()
	{		
		 $('sss').focus();
		// document.getElementById('sss').focus();
		
	}); */
",$this::POS_READY);

?>
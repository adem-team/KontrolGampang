<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\assets\AppAsset;
AppAsset::register($this);
use frontend\assets\AppAssetFreelancer;
AppAssetFreelancer::register($this);

?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
		<head>
			<meta charset="<?= Yii::$app->charset ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<?= Html::csrfMetaTags() ?>
			<title><?= Html::encode($this->title) ?></title>
			<?php $this->head() ?>
		</head>
		<body>
			<?php $this->beginBody(['id'=>'page-top','class'=>'index']) ?>
				<div class="wrap">
					<!-- NAV BAR !-->
					<?=$this->render('main-navbar')?>
					<!-- BODY CONTAINER !-->
					<div>
						<?= $content ?>
					</div>
				</div>
				<!-- FOOTER !-->
				<?=$this->render('main-footer')?>

			<?php $this->endBody() ?>
		</body>
	</html>
<?php $this->endPage() ?>

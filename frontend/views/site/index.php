<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;
AppAsset::register($this);

	$bgColor='#4d4368';//'#3e3939';//black   //'#2292d0'//blue;
	$bgColorIcon='#fffefe';//'#c72b42';//merah
	$rangeColorIcon='#4d4368';//blue;'#25ca4f';// hijo
	$colorIcon='#3e3939';
	$colorTextIcon='#0f0202';
?>
 <!-- Header -->
   <header>
        <div id="home" tabindex="-1">
            <div class="row">				
                <div class="col-lg-12">
					<?=$this->render('_home')?>						
                </div>
            </div>
			
        </div>
    </header>

    <!-- service Grid Section -->
    <section id="service">
       <?=$this->render('_service')?>
    </section>

    <!-- help Section -->
    <section class="success" id="help">
        <?=$this->render('_help')?>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <?=$this->render('_contact')?>
    </section>
  
	<!-- Contact Section -->
	<section class="success" id="signup-select">		
		<?php
			if (Yii::$app->user->isGuest){
				echo $this->render('signup');
			}else{
				echo $this->render('signup_confirm');
			}
		?>	
	</section>

	


<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if ($oPage): ?>
	Заголовок <?php echo $oPage->title;?><br/>
	Подзаголовок <?php echo $oPage->subtitle;?><br/>
	Люди <br/>
	<?php foreach ($oPage->pageXUsers as $oPageXUsers): ?>
			ФИО <?php echo $oPageXUsers->user->FIO?><br/>
			ОПИСАНИЕ <?php echo $oPageXUsers->description?><br/>
	<?php endforeach ?>	

	<a href="<?php echo CHtml::normalizeUrl(array('admin/update', 'id' => $oPage->id))?>">Редактировать (только для админов)</a>
<?php else:?>
	Не созданно ни одной страницы. <a href="<?php echo CHtml::normalizeUrl(array('admin/create'))?>">Создать(только для админов)</a>
<?php endif ?>
<?php
/* @var $this AdminController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$oPage->title=>array('view','id'=>$oPage->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$oPage->id)),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<h1>Update Page <?php echo $oPage->id; ?></h1>

<?php $this->renderPartial('_form', array('oPage'=>$oPage)); ?>
<?php
/* @var $this AdminController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$oPage->title,
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'Update Page', 'url'=>array('update', 'id'=>$oPage->id)),
	array('label'=>'Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$oPage->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<h1>View Page #<?php echo $oPage->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$oPage,
	'attributes'=>array(
		'id',
		'title',
		'subtitle',
		array(
			'name' => 'Люди',
			'value' => $oPage->userList(),
		),
	),
)); ?>

<?php
/* @var $this AdminController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#page-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pages</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$oPage->search(),
	'filter'=>$oPage,
	'columns'=>array(
		'id',
		'title',
		'subtitle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

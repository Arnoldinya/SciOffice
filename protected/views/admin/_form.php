<?php
/* @var $this AdminController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($oPage); ?>

	<div class="row">
		<?php echo $form->labelEx($oPage,'title'); ?>
		<?php echo $form->textField($oPage,'title',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($oPage,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($oPage,'subtitle'); ?>
		<?php echo $form->textField($oPage,'subtitle',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($oPage,'subtitle'); ?>
	</div>

	<div class="">
		СПИСОК ЛЮДЕЙ <br/>
		<?php foreach ($oPage->pageXUsers as $oPageXUsers): ?>
			<?php 
				$this->renderPartial('_people', array(
					'oUser' => $oPageXUsers->user,
					'flag' => true,
					'i' => false,
					'desc' => $oPageXUsers->description,
				));
			?>
		<?php endforeach; ?>
		
		<div id="new_items"></div>
	</div>
	
	<div id="add_more" style="text-decoration: underline; cursor: pointer;">
		ДОБАВИТЬ ЧЕЛОВЕКА
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($oPage->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	$(document).on("focus",'.autocomplete',function(e) {
		if (!$(this).data("autocomplete"))
		{
			//alert($(this).attr('id'));
			$(this).autocomplete({
				source: "<?php echo CHtml::normalizeUrl(array('admin/ajaxGetPeople'))?>",
				minLength: 1,
				select: function(event, ui){

					if($(this).attr('data-flag')=='item')
						$('#for_item_' + ui.item.id).val(ui.item.id);
					else
						$('#for_' + $(this).attr('id')).val(ui.item.id);
				},
			});
		}
	});
	
	var i = 0;
	$('#add_more').click(function(){
		i++;
		$.post("<?php echo CHtml::normalizeUrl(array('admin/ajaxAddPeople'));?>", {'i' : i}, function(data){
			$(data).appendTo('#new_items');
		});
	});
</script>
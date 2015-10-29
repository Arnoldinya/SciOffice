<?php $iId = ($oUser->id) ? $oUser->id : $i;?>
<input placeholder="введите фамилию" type='text' id="item_<?php echo $iId;?>" <?php echo ($flag) ? 'data-flag="item"' : 'data-flag=""';?> name='User[item_name][]' value='<?php echo $oUser->FIO!='  ' ? $oUser->FIO : '';?>'  style="width: 70%" class="autocomplete"/> 
<input type="hidden" name="User[item_id][]" value="<?php echo $oUser->id;?>" id="for_item_<?php echo $iId;?>"/>

<input placeholder="описание" type="text" name="User[desc][]" value="<?php echo $desc;?>" style="width: 70%"/>
<br/>
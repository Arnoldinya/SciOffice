<?php

class WebUser extends CWebUser
{
	private $_model = null;
	
	function getRole()
	{
		if($oUser = $this->getModel())
		{			
			$oAuthAssignment = AuthAssignment::model()->findByattributes(array(
				'userid' => $oUser->id,
			));

			if($oAuthAssignment)
				return $oAuthAssignment->itemname;
		}

		return false;
	}

	private function getModel()
	{
		if (!$this->isGuest)
			$this->_model = User::model()->findByPk(Yii::app()->user->id);
		
		return $this->_model;
	}
}
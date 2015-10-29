<?php

class AdminController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'oPage'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$oPage=new Page;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$oPage->attributes=$_POST['Page'];
			if($oPage->save())
			{
				if (isset($_POST['User']) && isset($_POST['User']['item_id']))
				{
					//добавляем людей
					foreach ($_POST['User']['item_id'] as $iKey=>$iUserId)
					{
						$oPageXUser = new PageXUser;

						if (isset($_POST['User']['desc']) && isset($_POST['User']['desc'][$iKey] ))
							$oPageXUser->description = $_POST['User']['desc'][$iKey];

						$oPageXUser->page_id = $oPage->id;
						$oPageXUser->user_id = $iUserId;
						
						$oPageXUser->save();					
					}
				}

				$this->redirect(array('view','id'=>$oPage->id));
			}
		}

		$this->render('create',array(
			'oPage'=>$oPage,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$oPage=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$oPage->attributes=$_POST['Page'];
			if($oPage->save())
			{
				if (isset($_POST['User']) && isset($_POST['User']['item_id']))
				{
					//удалили всех людей
					PageXUser::model()->deleteAll(array(
						'condition' => 'page_id='.$oPage->id,
					));

					//добавляем людей
					//echo "<pre>"; print_r($_POST['User']['item_id']); echo "</pre>";exit;
					foreach ($_POST['User']['item_id'] as $iKey=>$iUserId)
					{
						$oPageXUser = new PageXUser;
						if (isset($_POST['User']['desc']) && isset($_POST['User']['desc'][$iKey] ))
							$oPageXUser->description = $_POST['User']['desc'][$iKey];
						
						$oPageXUser->page_id = $oPage->id;
						$oPageXUser->user_id = $iUserId;
						
						$oPageXUser->save();		

						//echo "<pre>"; print_r($oPageXUser->attributes); echo "</pre>";exit;
					}
				}

				$this->redirect(array('view','id'=>$oPage->id));
			}
		}

		$this->render('update',array(
			'oPage'=>$oPage,
		));
	}

	public function actionAjaxGetPeople()
	{
		$aData = array();
		if (isset($_GET['term']))
		{
			$criteria = new CDbCriteria;

			$criteria->alias = 'u';
			$criteria->condition = "u.surname like '%".$_GET['term']."%'";
			
			$aUser = User::model()->findAll($criteria);
			
			if ($aUser)
			{
				foreach ($aUser as $oUser)
				{
					$aData[$oUser->id]['value'] = $oUser->FIO;
					$aData[$oUser->id]['id'] = $oUser->id;
				}
			}
		}
		
		echo json_encode($aData);
	}
	
	public function actionAjaxAddPeople()
	{
		$i = $_POST['i'];
		$oUser = new User;
		$this->renderPartial('_people', array(
			'oUser' => $oUser,
			'i' => $i,
			'flag' => false,
			'desc' => '',
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Page');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$oPage=new Page('search');
		$oPage->unsetAttributes();  // clear any default values
		if(isset($_GET['Page']))
			$oPage->attributes=$_GET['Page'];

		$this->render('admin',array(
			'oPage'=>$oPage,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Page the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$oPage=Page::model()->findByPk($id);
		if($oPage===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $oPage;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Page $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

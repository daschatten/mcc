<?php

class DsErrorController extends Controller
{
	public function actionError($message = "")
	{
		$this->render('error', array('message' => $message));
	}
}

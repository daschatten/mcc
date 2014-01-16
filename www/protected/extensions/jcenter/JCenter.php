<?php
/**
 * JCenter class file.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @version 1.1
 * @license BSD
 */

/**
 * This widget encapsulates the JCenter-jQuery plugin.
 * The plugin centers elements to screen. Responds to resize event.
 * ({@link https://github.com/chriscummings/jquery-center-plugin}).
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 */

class JCenter extends CWidget
{
	/**
	 * @var boolean center element horizontal?
	 * Defaults to true.
	 */
    public $horizontal;
	/**
	 * @var boolean center element vertical?
	 * Defaults to true.
	 */
    public $vertical;
	/**
	 * @var boolean reacts to window resize?
	 * Defaults to true.
	 */
    public $resize;

	/**
	 * Initializes the widget.
	 * This method registers all needed client scripts 
	 */
	public function init()
	{
	    $id=$this->getId();

      	$dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
      	$baseUrl = CHtml::asset($dir);

        $JsFile = (YII_DEBUG)
                ? "/js/jquery.chris.center.js"
                : "/js/jquery.chris.center.min.js";

        $options=$this->getClientOptions();
		$options=$options===array()?'{}' : CJavaScript::encode($options);

        $js = "jQuery('#$id').center($options);";

  		Yii::app()->getClientScript()
            ->registerCoreScript('jquery')
            ->registerScriptFile($baseUrl.$JsFile)
            ->registerScript(__CLASS__.'#'.$id, $js);
	}

	/**
	 * @return array the javascript options
	 */
	protected function getClientOptions()
	{
        $options = array();
		foreach(array('horizontal','vertical','resize') as $name)
		{
			if($this->$name!==null)
				$options[$name]=$this->$name;
		}
		return $options;
	}
}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Highcharts;

use Highcharts\assets\AppAsset;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;


class Highcharts extends \yii\bootstrap\Widget
{
    public $options;
    public $config;

    public function init()
    {
        static $number = 0;
        ++$number;
        parent::init();
        AppAsset::register($this->view);
        $config = $this->config;
        $js = <<<JS
            $(function () {
                Highcharts.chart('container_' + $number, $config);
            });
JS;
        $this->view->registerJs($js);
        $options = ArrayHelper::merge($this->options, ['id' => 'container_' . $number, 'class' => 'box']);
        echo Html::tag('div', '', $options);
    }
}

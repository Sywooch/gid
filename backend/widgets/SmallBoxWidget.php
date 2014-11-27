<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.11.2014
 * Time: 14:17
 */

namespace backend\widgets;

use yii\base\Widget;

class SmallBoxWidget extends Widget
{
    public $class, $color, $header, $paragraph, $icon, $link;

    public function init()
    {
        parent::init();
        if ($this->class === null) {
            $this->class = 'col-lg-3 col-xs-6';
        }
        if ($this->color === null) {
            $this->color = 'bg-red';
        }
        if ($this->header === null) {
            $this->header = '';
        }
        if ($this->paragraph === null) {
            $this->paragraph = '';
        }
        if ($this->icon === null) {
            $this->icon = 'glyphicon glyphicon-question-sign';
        }
        if ($this->link === null) {
            $this->link = '#';
        }
    }

    public function run()
    {
        return
            '<div class="' . $this->class . '">
                <div class="small-box ' . $this->color . '">
                    <div class="inner">
                        <h3>' . $this->header . '</h3>
                        <p>' . $this->paragraph . '</p>
                    </div>
                    <div class="icon">
                        <i class="' . $this->icon . '"></i>
                    </div>
                        <a href="' . $this->link . '" class="small-box-footer">
                            Больше информации <i class="glyphicon glyphicon-info-sign"></i>
                        </a>
                    </div>
            </div>';
    }
}
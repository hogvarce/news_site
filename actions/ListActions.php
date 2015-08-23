<?
namespace app\actions;

use yii\base\Action;

class ListActions extends Action{
    public $viewName = 'index';

    public function run(){

        return $this->controller->render("@actions/views/".$this->viewName);
    }

}

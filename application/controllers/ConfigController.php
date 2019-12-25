<?

namespace application\controllers;


use application\core\Controller;

class ConfigController extends Controller
{
    public function choose_langAction()
    {
        $new_lang = $_POST['new_lang'];
        $_SESSION['config']['lang'] = $new_lang;

        $this->view->location($_POST['current_url']);
    }

}
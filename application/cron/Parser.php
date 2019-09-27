<?

namespace application\cron;

use application\lib\Db;

class Parser
{

    public $db;

    function __construct()
    {

        echo 'winner';

        $this->db = new Db();
    }

    private function parse_rss($link = false)
    {

        //тут будет парсинг

    }

    private function get_rss_content($link = false)
    {

        echo 'Та самая функция';
        //тут надо забирать контент



    }




}
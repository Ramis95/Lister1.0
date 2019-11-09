<?

namespace application\cron;

use application\lib\Db;

class Parser
{

    public $db;
    public $category_arr; //Переименовать, переделать т.к. делаю не на свежую голову

    function __construct()
    {
        $this->db = new Db();
        $this->category_arr = $this->get_category_db();
    }

    public function parse_rss($link = false)
    {

        //Возможно переделать

        $all_rss_link = $this->db->getAll("SELECT id, link, source_id, date FROM ?n", 'rss_links');

        if (!empty($all_rss_link)) {

            foreach ($all_rss_link as $rss_source) {

                $xml = $this->get_xml($rss_source['link']);
//                $xml = $this->get_xml('https://www.mk.ru/rss/economics/index.xml');

                $channel = $xml->channel;
                $chanel_array = (array)$channel;

                $title = '';
                $link = '';
                $description = '';
                $img = '';
                $source = $rss_source['source_id']; //Получаем из бд
                $parse_type = 1; //Получаем из бд
                $category = $rss_source['category'];
                $pubDate = '';

                foreach ($chanel_array['item'] as $key => $value) {
                    $chanel_value = (array)$value;

                    if (isset($chanel_value['title'])) {
                        $title = $chanel_value['title'];
                    }

                    if (isset($chanel_value['pubDate'])) {
                        $pubDate = strtotime($chanel_value['pubDate']);
                    }

                    if ($title != '' && $pubDate != '') {

                        $unique = $this->news_unique_check($title, $source, $pubDate); //Проверка на уникальность в бд

                        if ($unique) {

                            if (isset($chanel_value['link'])) {
                                $link = $chanel_value['link'];
                            }

                            if (isset($chanel_value['description'])) {
                                $description = $chanel_value['description'];
                            }

                            if (isset($chanel_value['enclosure'])) {

                                $img_arr = (array)$chanel_value['enclosure']['url'];
                                $img = (string)$img_arr[0];

                            }

                            if (isset($chanel_value['category'])) {
                                if (isset($this->category_arr[$chanel_value['category']])) {
                                    $category = $this->category_arr[$chanel_value['category']];
                                }
//                                else {
//                                    $category = 0;
//                                }
                            }
                            //elseif()//Берем категория из бд
                            //{
                            //}
                            else //Иначе получаем категория исходя из title и description
                            {
                                $category = $this->get_news_category($title, $description);
                            }

                            $this->db->query("INSERT INTO ?n (`title`, link, description, img, source, parse_type, category, `pubDate`) VALUES (?s, ?s, ?s, ?s, ?s, ?i, ?i,?s)", 'news', $title, $link, $description, $img, $source, $parse_type, $category, $pubDate);

                        }
                    }
                }
            }
            //тут будет парсинг
        }
    }

    public function show_rss_parse()
    {
        $rss_array = [
          'https://www.mk.ru/rss/economics/index.xml',
          'https://lenta.ru/rss/news'
        ];

        foreach ($rss_array as $rss_value)
        {
            $xml = $this->get_xml($rss_value);
            $channel = $xml->channel;
            $chanel_array = (array)$channel;

            foreach ($chanel_array['item'] as $key => $value)
            {
                vd(array($value));
                break;
            }
        }
    }

    public function parse_rss_show()
    {
        //'https://www.mk.ru/rss/economics/index.xml'
        $link = $_GET['link'];
        $xml = $this->get_xml($link);

        $channel = $xml->channel;
        $chanel_array = (array)$channel;

        foreach ($chanel_array['item'] as $value) {
            $chanel_value = (array)$value;
            vd($chanel_value);
            die();
        }

    }

    private function get_news_category($title, $description)
    {

        //анализ title и description


        return 1;
    }

    private function get_category_db() //Переименовать, переделать т.к. делаю не на свежую голову
    {
        $result = [];
        $query = $this->db->getAll("SELECT `id`, `name` FROM ?n ", 'categories');

        foreach ($query as $key => $value) {
            $result[$value['name']] = $value['id'];
        }

        return $result;
    }

    private function get_catid_bytitle($title)
    {
        //Как сделать так чтобы не обращаться к бд совсем или только один раз
    }

    private function news_unique_check($title, $source, $add_date)
    {
        $return = true;
        $duplicate = $this->db->getRow("SELECT `id` FROM ?n WHERE `title` = ?s AND `source` = ?s AND `pubDate` = ?s", 'news', $title, $source, $add_date);

        if (!empty($duplicate)) {
            $return = false;
        }

        return $return;

    }

    private function get_xml($url)
    {
        $xml = simplexml_load_file($url); //Проверить, возможно есть альтернативы
        return $xml;
    }

    public function get_content($url, $postdata = '', $cookie = '', $proxy = '')
    {

        $uagent = "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.205 Safari/534.16";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
        curl_setopt($ch, CURLOPT_HEADER, 0);           // возвращает заголовки
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
        curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
        curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);        // таймаут ответа
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа
        if (!empty($postdata)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        }
        if (!empty($cookie)) {
            //curl_setopt($ch, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'].'/2.txt');
            //curl_setopt($ch, CURLOPT_COOKIEFILE,$_SERVER['DOCUMENT_ROOT'].'/2.txt');
        }
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $header;

    }


}
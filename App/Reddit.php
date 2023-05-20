<?php
namespace App;
use App\Database;
class Reddit
{
    private Database $Database;
    public function __construct()
    {
        $this->Database = new Database();

    }

    public function doPost($subreddit, $title, $text = null, $url = null)
    {
        $ch = curl_init();
        $token = $this->getToken();
        if(!$token){
            echo "Erro na aquisição do token :)<br>";
            return false;
        }

        $post_fields = [
            'api_type' => 'json',
            'sr' => $subreddit,
            'title' => $title,
            'text' => $text,
            'url' => $url
        ];
        if($url){
            $post_fields['kind'] = 'link';
        }else{
            $post_fields['kind'] = 'self';
        }
        $curl_arr_options = [
            CURLOPT_URL => 'https://oauth.reddit.com/api/submit',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FAILONERROR => false,
            CURLOPT_USERAGENT => REDDIT_USER_AGENT,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: bearer ' . $token
            ],

            CURLOPT_POSTFIELDS => http_build_query($post_fields)
        ];

        curl_setopt_array($ch, $curl_arr_options);
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        if ($status_code >= 400) {
            $error = curl_error($ch);
            echo "Ops, houve um erro. Verifique seus dados de configuração: <b><pre>$response</pre></b>";

            echo "cURL Error: {$error} <br>\n";
            return false;
        }
        $obj = json_decode($response);
        curl_close($ch);
        if(!empty($obj->json->data->url)){
            return $obj->json->data->url;
        }
        echo "Pode ter havido um erro, confira o retorno da API:<b><pre>$response</pre></b>";
        return false;
    }


    public function getNewToken()
    {
        $clientId = REDDIT_CID;
        $clientSecret = REDDIT_CSECRET;
        $username = REDDIT_USERNAME;
        $password = REDDIT_PASSWORD;

        $url = 'https://www.reddit.com/api/v1/access_token';
        $data = 'grant_type=password&username=' . urlencode($username) . '&password=' . urlencode($password);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_USERPWD, $clientId . ':' . $clientSecret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('User-Agent: '.REDDIT_USER_AGENT));
        $response = curl_exec($curl);
        curl_close($curl);
        $obj = json_decode($response);
        return $obj->access_token;

    }

    private function getToken(){
        $sql = "SELECT token, created_at, id FROM rd_token WHERE created_at >= NOW() - INTERVAL 23 HOUR ORDER BY id DESC";
        $select = $this->Database->select($sql, []);
        if($select->rowCount()){
            $data = $select->fetch();
            $new_token = $data->token;
        }else{
            $new_token = $this->getNewToken();
            if($new_token){
                $sql_insert = "INSERT INTO rd_token SET token = :token, created_at = CURRENT_TIMESTAMP";
                $binds = ['token' => $new_token];
                if($this->Database->insert($sql_insert, $binds)){
                    echo "Novo token foi inserido no BD<br>";
                }else{
                    echo "Erro ao inserir novo token a base de dados<br>";
                }
            }else{
                echo "Erro ao obter novo token<br>";
            }
        }
        return $new_token;
    }

}


?>
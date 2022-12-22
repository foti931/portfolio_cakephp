<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Log Controller
 */
class LogController extends AppController
{
    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index()
    {
        $data[] = date('Y/m/d H:i:s');
        $data[] = $_SERVER['SCRIPT_NAME'];
        $data[] = $_SERVER['HTTP_USER_AGENT'];
        $data[] = $_SERVER['HTTP_REFERER'] ?? "";
//        $data[] = $_SERVER['HTTP_REFERER'];

        $file = @fopen('access.log', 'a') or die('ファイルを開けませんでした!');

        //ファイルのロック
        flock($file, LOCK_EX);

        //ファイルの書き込み
        fwrite($file, implode("\t", $data) . "\n");

        //ロックの解除
        flock($file, LOCK_UN);

        //ファイルのクローズ
        fclose($file);

        $file = @fopen("access.log", "r");
        //ファイルのロック
        flock($file, LOCK_SH);

        $data = [];
        //ファイルの読み込み
        while ($line = fgetcsv($file, 1024, "\t")) {
            $data[] = $line;
        }
        //ロックの解除
        flock($file, LOCK_UN);

        //ファイルのクローズ
        fclose($file);

        $this->set('data', $data);
    }
}

<?php namespace SidorovRoman\FileSiteOptions;

use App;

class Repository
{
    /**
     * Путь к файлу сохранения
     *
     * @var string
     */
    protected $file_path;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->file_path = base_path('/vendor/sidorovroman/file-site-options/fileSiteOptions.json');
    }

    /**
     * @param $key string
     *
     * @return void
     * @throws \Exception
     */
    public function set($key, $value)
    {
        try {
            $json = file_get_contents($this->file_path);
            $array = json_decode($json, true);
            
            array_set($array, $key, $value);
            
            file_put_contents($this->file_path, json_encode($array));
        } catch (\Exception $ex) {
            throw new \Exception('Проверьте наличие файла \fileSiteOptions.json!');
        }
    }

    /**
     * @param $key string
     *
     * @return string
     * @throws \Exception
     */
    public function get($key)
    {
        try {
            $json = file_get_contents($this->file_path);
            $array = json_decode($json, true);

            return array_get($array, $key);
        } catch (\Exception $ex) {
            throw new \Exception('Проверьте наличие файла \fileSiteOptions.json!');
        }
    }

    /**
     * @param $key string
     *
     * @return void
     * @throws \Exception
     */
    public function dell($key)
    {
        try {
            $json = file_get_contents($this->file_path);
            $array = json_decode($json, true);
            
            array_forget($array, $key);
            
            file_put_contents($this->file_path, json_encode($array));
        } catch (\Exception $ex) {
            throw new \Exception('Проверьте наличие файла \fileSiteOptions.json!');
        }
    }
}
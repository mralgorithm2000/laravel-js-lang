<?php

namespace Mralgorithm\LaravelJsLang;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class LangCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'JsLang:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update cached files to get new translations from laravel <lang> directory';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dir = scandir(lang_path());
        unset($dir[0]); //remove .
        unset($dir[1]); //remove ..
        foreach($dir as $d){
            $path = public_path('laravel-js-lang/lang/' . $d);
            if(is_dir(lang_path($d))){
                if(!file_exists($path)){
                    mkdir($path);
                }
                $files = scandir(lang_path($d));
                unset($files[0]);
                unset($files[1]);
                $json_files = [];
                foreach($files as $f){
                    $oldfile = include lang_path($d . '/' . $f);
                    $ext = explode('.',$f);
                    $ext[array_key_last($ext)] = '.json';
                    $path = public_path('laravel-js-lang/lang/' . $d . '/' . implode('',$ext));
                    $newfile = fopen($path,'w');
                    fwrite($newfile,json_encode($oldfile,JSON_UNESCAPED_UNICODE));
                    fclose($newfile);
                    $json_files[] = implode('',$ext);
                }
                $newfile = fopen(public_path('laravel-js-lang/lang/' . $d . '/js_lang_files.json'),'w');
                fwrite($newfile,json_encode($json_files,JSON_UNESCAPED_UNICODE));
                fclose($newfile);
            }else{
                $oldfile = file_get_contents(lang_path($d));
                $path = public_path('laravel-js-lang/lang/' . $d);
                $newfile = fopen($path,'w');
                fwrite($newfile,$oldfile);
                fclose($newfile);
            }

        }
    }
}

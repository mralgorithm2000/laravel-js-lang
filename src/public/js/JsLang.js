var translations = [];
var string_translations = [];
var global_lang = '';
function load_translition(location){
    if(translations[location]){
        return true;
    }
    var request = new XMLHttpRequest();
    request.open("GET", "laravel-js-lang/lang/"+ location +"/js_lang_files.json",false);
    request.send(null);
    if(request.statusText != 'OK'){
        return false;
    }
    var json_object = JSON.parse(request.responseText);
    json_object = Object.values(json_object);
    if(json_object){
        json_object.forEach(file => {
            var request = new XMLHttpRequest();

            request.open("GET", "laravel-js-lang/lang/"+ location +"/" + file,false);

            request.send(null);
            if(request.statusText != 'OK'){
                return false;
            }

            var file_content = JSON.parse(request.responseText);
            translations[location+"_"+file.split(".")[0]] = file_content;
        });
    }
}
function load_string_translation(location){
    if(string_translations[location]){
        return true;
    }
    var request = new XMLHttpRequest();
    request.open("GET", "laravel-js-lang/lang/"+ location +".json",false);
    request.send(null);
    if(request.statusText != 'OK'){
        return false;
    }
    var file_content = JSON.parse(request.responseText);
    string_translations[location] = file_content;
}
function __(key,replace = '',locale = ''){
    set_global_lang(locale);
    var load__kstr_file_res = load_string_translation(global_lang);
    if(load__kstr_file_res != false){
        var str_res = translate_from_string(key,replace);
        if(str_res !== false){
            return str_res;
        }
    }
    var load__key_file_res = load_translition(global_lang);
    if(load__key_file_res != false){
        var str_res = translate_from_key(key,replace);
        if(str_res !== false){
            return str_res;
        }
    }
    return key;
}
function set_global_lang(locale = ''){
    if(locale == '' && global_lang == ''){
        global_lang = document.getElementById("laravel_js_lang_helper").getAttribute('lang');
    }else if(locale != ''){
        global_lang = locale;
    }
}
function translate_from_string(key,replace = ''){
    if(string_translations[global_lang] === undefined){
        return false;
    }
    var translated = string_translations[global_lang][key];
    if(translated === undefined){
        return false;
    }
    if(replace != ''){
        var replace_keys = Object.keys(replace);
        var replace_vals = Object.values(replace);
        for(x = 0;x < replace_keys.length;x++){
            translated = translated.replace(':' + replace_keys[x],replace_vals[x]);
        }
    }
    console.log(translated);
    return translated;
}
function translate_from_key(key,replace = ''){
    var key_arr = key.split('.');
    if(translations[global_lang + '_' + key_arr[0]] == undefined){
        return false;
    }
    var translated = translations[global_lang + '_' + key_arr[0]][key_arr[1]];
    if(translated === undefined){
        return false;
    }
    if(replace != ''){
        var replace_keys = Object.keys(replace);
        var replace_vals = Object.values(replace);
        for(x = 0;x < replace_keys.length;x++){
            translated = translated.replace(':' + replace_keys[x],replace_vals[x]);
        }
    }
    console.log(translated);
    return translated;
}
function lang_getLocale(){
    return global_lang;
}
function lang_setLocale(locale){
    global_lang = locale;
}
function is_locale(locale){
    if(global_lang == locale){
        return true;
    }
    else{
        return false;
    }
}

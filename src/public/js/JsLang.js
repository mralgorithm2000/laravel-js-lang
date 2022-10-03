function __(key){
    var key_arr = key.split('.');
    var request = new XMLHttpRequest();
    request.open("GET", "laravel-js-lang/lang/en/auth.json",false);
    request.send(null);
    console.log(request.responseText);
}

    window.onload = function(){
    var demo = document.getElementById('demo');
    var value = 0;
    var w = 87;
    var a = 65;
    var s = 83;
    var d = 68;
  
    window.onkeydown= function(gfg){
        if(gfg.keyCode === space_bar){
            value++;
            demo.innerHTML = value;
        };
        if(gfg.keyCode === right_arrow)
       {
           alert("Welcome to GeeksForGeeks!");
       };
    };
};    
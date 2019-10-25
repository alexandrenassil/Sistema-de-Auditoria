$(function(){
    $("#tabela input").keyup(function(){
        var index = $(this).parent().index();
        var nth = "#tabela td:nth-child("+(index+1).toString()+")";
        var valor = $(this).val().toUpperCase();
        $("#tabela tbody tr").show();
        $(nth).each(function(){
            if($(this).text().toUpperCase().indexOf(valor) < 0){
                $(this).parent().hide();
            }
        });
    });

    $("#tabela input").blur(function(){
        $(this).val("");
    });
});

var timer;
function timerTable(tabela,banco,dados,controle)
{
    var table = tabela;
    var bd = banco;
    var data = dados;
    var stop = controle;

    console.log(data);
    if(stop==1)
    {
        clearInterval(timer);
        console.log('stop: '+ stop);
        stop = 0;
    }
    timer = setInterval(() => {
        ajax(table, bd, data);
    }, 1000);
};

function ajax(tabela,banco,dados){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(tabela).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", banco+'?'+dados, true);
    xhttp.send();
};


function ajaxTempos(tabela,banco,dados){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resultado = this.responseText;
            $(tabela).val(resultado);
        }
    };
    xhttp.open("GET", banco+'?'+dados, true);
    xhttp.send();
};

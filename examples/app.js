document.

    // Geolocation

    function obterLocalizacao() {
        //Utilizando a biblioteca Modernizr, verificamos o suporte ao HTML5
        if(Modernizr.geolocation){
            navigator.geolocation.getCurrentPosition(locationSucesso, locationErro);
        }else{
            //Código executado quando o navegador não oferece suporte ao HTML5
            alert("Seu navegador não oferece suporte ao HTML5. Para visualizar o conteúdo desta página atualize-o.");
        }
    }

    $("#btnMyPosition").click(obterLocalizacao);

    function locationErro(err) {
        switch (err.code) {
            case 1 :
                var alertErro = "A permissão para obter a sua posição foi negada.";
            break;
            case 2 :
                var alertErro = "Não foi possível estabelecer uma conexão para obter a sua posição.";
            break;
            case 3 :
                var alertErro = "Tempo de requisição esgotado.";
            break;
            default :
                var alertErro = "Não foi possível obter sua posição.";
            }
        var codigoErro = err.code;
        var msg = "Ocoreu um erro! <br>";
        msg += "Erro código: " + codigoErro + "<br>";
        msg += "Alerta: " + alertErro;
        document.getElementById('msg').innerHTML = msg;
    }

    function locationSucesso(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        var informacoes = "Informações: <br>";
        informacoes += "Latitude:" + latitude + "<br>";
        informacoes += "Longitude:" + longitude +  "<br>";

        var latlng = new google.maps.LatLng(latitude, longitude);
        var geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if (results[1]) {
                informacoes += "Endereço: " + results[1].formatted_address;
                alert("1 - " + informacoes);
                alert("Deu certo! " + results[1].formatted_address);
                alert("2 - " + informacoes);
            } else {
                alert("Geocoder falhou devido a " + status);
            }
        });

        alert("3 - " + informacoes);
        document.getElementById('msg').innerHTML = informacoes;
    }

});

// ------------------------------------------------------- //
//  Styled Leaflet Map
// ------------------------------------------------------ //
function getColor(d) {
    var code = d;
    if ("NIC-666" === code) {
        return "#800026";
    } else if ('NIC-659' === code) {
        return '#FFBF46';
    } else if ('NIC-664' === code) {
        return '#AC3931';
    } else if ('NIC-656' === code) {
        return '#9FCC2E';
    } else if ('NIC-669' === code) {
        return '#7BC950';
    } else if ('NIC-657' === code) {
        return '#084C61';
    } else if ('NIC-667' === code) {
        //Jalapa, Nueva Segovia
        return '#064EE1';
    } else if ('NIC-663' === code) {
        //Chinandega
        return '#F6511D';
    } else if ('NIC-644' === code) {
        //Nueva Guinea
        return '#FBFBFB';
    }
}

function style(feature) {

    return {
        fillColor: getColor(feature.properties.adm1_code),
        weight: 2,
        opacity: 1,
        color: '#5C946E',
        dashArray: '',
        fillOpacity: 0.5
    };
}

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#648381',
        dashArray: '',
        fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }
    var code = layer.feature.properties.adm1_code;
    if ("NIC-666" === code) {
        info.update(layer.feature.properties);
    } else if ('NIC-659' === code) {
        info.update(layer.feature.properties);
    } else if ('NIC-664' === code) {
        info.update(layer.feature.properties);
    } else if ('NIC-656' === code) {
        info.update(layer.feature.properties);
    } else if ('NIC-669' === code) {
        info.update(layer.feature.properties);
    } else if ('NIC-657' === code) {
        info.update(layer.feature.properties);
    } else if ('NIC-667' === code) {
        info.update(layer.feature.properties);
    } else if ('NIC-663' === code) {
        info.update(layer.feature.properties);
    } else if ('NIC-644' === code) {
        info.update(layer.feature.properties);
    }

}

function zoomToFeature(e) {
    xmap.fitBounds(e.target.getBounds());
}

function resetHighlight(e) {
    geoMap.resetStyle(e.target);
    info.update();
}

function update(props) {
    console.log(props);
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}

var mapId = 'map',
    minwidth = 150,
    maxWidth = 600,
    mapCenter = [12.152700294311263, -86.24986613754567],
    mapSebaco = [12.852360919888188, -86.09814608361192],
    mapEsteli = [13.094571130948992, -86.35090622909965],
    mapMatagalpa = [12.940756356285643, -85.904303857672],
    mapJinotega = [13.101307, -86.000109],
    mapJuigalpa = [12.101340, -85.365984],
    mapSanBenito = [12.304370, -86.055418],
    mapJalapa = [13.923153, -86.125948],
    mapChinandega = [12.628865, -87.133046],
    mapNuevaGuinea = [11.689064503430815, -84.45277812721523],
    mapSiuna = [13.720676455104769, -84.77248928954465],
    mapMarker = true;

if ($('#' + mapId).length > 0) {

    var icon = L.icon({
        iconUrl: '/assets/img/mapa/marker2.gif',
        iconSize: [32, 32],
        popupAnchor: [0, -18],
        tooltipAnchor: [0, 19]
    });

    var dragging = false,
        tap = false;

    if ($(window).width() > 700) {
        dragging = true;
        tap = true;
    }

    var mapboxAccessToken = 'pk.eyJ1IjoiaGl0enVpIiwiYSI6ImNrcXNsaWNxejJvc2Yyb212bWZxOXU0aHoifQ.7fNFS-ZSsJX83Cfp9uRe9Q';
    var xmap = L.map('map', {
        center: mapCenter,
        zoom: 13,
        dragging: dragging,
        tap: tap,
        scrollWheelZoom: false
    }).setView([13, -85], 7);
    var geoMap = L.geoJson(statesData, {style: style, onEachFeature: onEachFeature}).addTo(xmap);
    //esto es un ejemplo de un circulo en el mapa
    //L.circle(mapCenter, {radius: 20000}).addTo(xmap);

    xmap.on('click', function (ev) {
        //alert(ev.latlng);
        // ev is an event object (MouseEvent in this case)
        //$("#myModal").modal();
    });
    var tileLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + mapboxAccessToken, {
        id: 'mapbox/light-v10',
        tileSize: 512,
        zoomOffset: -1
    });
    tileLayer.addTo(xmap);
    xmap.once('focus', function () {
        xmap.scrollWheelZoom.enable();
    });
    var info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
        this.update();
        return this._div;
    };

//method that we will use to update the control based on feature properties passed
    info.update = function (props) {
        if (props) {
            $.getJSON("/stores/all", function (json) {
                for (var i = 0; i < json.length; i++) {
                    if (props.name.toLowerCase() === json[i].city.toLowerCase()) {
                        props.name = json[i].city;
                        props.note = json[i].cobertura;
                        props.ejecutivo = json[i].ejecutivo;
                        props.telefono = json[i].phoneFormatted;
                    }
                }
            });
            this._div.innerHTML = 'Departamento: <b>' + props.name + '</b><br />' +
                '<div id="cobertura">Cobertura: ' + props.note + '</div>' +
                '<div>Ejecutivo de venta: ' + props.ejecutivo + '</div>' +
                '<div>Telefonos: ' + props.telefono + '</div>';
        } else {
            this._div.innerHTML = 'Información sobre cobertura';
        }
    };


    info.addTo(xmap);
    /*var legend = L.control({position: 'bottomright'});
    legend.onAdd = function (map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, 10, 20, 50, 100, 200, 500, 1000],
            labels = [];

        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
        }

        return div;
    };

    legend.addTo(xmap);*/
    if (mapMarker) {
        var marker = L.marker(mapCenter, {
            icon: icon
        }).addTo(xmap);
        marker.bindPopup(
            "<div class='p-4'>" +
            "<h5>Sucursal: Managua</h5>" +
            "<p><b>Dirección</b>: KM, 2 1/2 C, NORTE, FRENTE AL TALLER NOGUERA<br/></p>" +
            "<p><strong>Telefono principal:</strong> 2775-2110<br/><strong>Celular</strong>: 8775-8699</p>" +
            "</div>",
            {
                minwidth: minwidth,
                maxWidth: maxWidth,
                className: 'map-custom-popup'
            });
        var markerSebaco = L.marker(mapSebaco, {
            icon: icon
        }).addTo(xmap);
        markerSebaco.bindPopup(
            "<div class='p-4'>" +
            "<h5>Sucursal: Sébaco</h5>" +
            "<p><strong>Dirección:</strong> COSTADO NORTE DEL BDF</p>" +
            "<p><b>Telefonos:</b> 2775-2110, 8775-8699</p>" +
            "<p><b>Responsable de Sucursal:</b> Ghesy Picado</p>" +
            "</div>", {
                minwidth: minwidth,
                maxWidth: maxWidth,
                className: 'map-custom-popup'
            });
        var markerEsteli = L.marker(mapEsteli, {
            icon: icon
        }).addTo(xmap);
        markerEsteli.bindPopup(
            "<div class='p-4'>" +
            "<h5>Sucursal: Estelí</h5>" +
            "<p><strong>Dirección:</strong> CONTIGUO A FERRET. REYNALDO HERNANDEZ</p>" +
            "<p><b>Telefonos:</b> 2713-5254, 8775-8701</p>" +
            "<p><b>Responsable de Sucursal:</b> Doris Raudez</p>" +
            "</div>", {
                minwidth: minwidth,
                maxWidth: maxWidth,
                className: 'map-custom-popup'
            });
        var markerMatagalpa = L.marker(mapMatagalpa, {
            icon: icon
        }).addTo(xmap);
        markerMatagalpa.bindPopup(
            "<div class='p-4'>" +
            "<h5>Sucursal: Matagalpa</h5>" +
            "<p><strong>Dirección:</strong> FRENTE A ESSO LAS MARIAS</p>" +
            "<p><b>Telefonos:</b> 2772-8873, 8775-8698</p>" +
            "<p><b>Responsable de Sucursal:</b> Keneth Montenegro</p>" +
            "</div>", {
                minwidth: minwidth,
                maxWidth: maxWidth,
                className: 'map-custom-popup'
            });
        var markerJinotega = L.marker(mapJinotega, {
            icon: icon
        }).addTo(xmap);
        markerJinotega.bindPopup(
            "<div class='p-4'>" +
            "<h5>Sucursal: Jinotega</h5>" +
            "<p><strong>Dirección:</strong> DE FERROMAX 100 VRS AL NORTE</p>" +
            "<p><b>Telefonos:</b> 2782-6117, 8775-8700</p>" +
            "<p><b>Responsable de Sucursal:</b> Diana Daow</p>" +
            "</div>", {
                minwidth: minwidth,
                maxWidth: maxWidth,
                className: 'map-custom-popup'
            });
        var markerJuigalpa = L.marker(mapJuigalpa, {
            icon: icon
        }).addTo(xmap);
        markerJuigalpa.bindPopup(
            "<div class='p-4'>" +
            "<h5>Sucursal: Juigalpa</h5><p><strong>Dirección:</strong> Semáforos del cementerio 3 cuadras al sur.</p>" +
            "<p><b>Telefonos:</b> 2512-1315, 8775-8703</p>" +
            "<p><b>Responsable de Sucursal:</b> Lesbia Guevara</p>" +
            "</div>",
            {
                minwidth: minwidth,
                maxWidth: maxWidth,
                className: 'map-custom-popup'
            }
        );
        var markerSiuna = L.marker(mapSiuna, {
            icon: icon
        }).addTo(xmap);
        markerSiuna.bindPopup(
            "<div class='p-4'>" +
            "<div class=''>" +
            "<h5>Sucursal: Siuna</h5>" +
            "</div>" +
            "<p><strong>Dirección:</strong> Barrio Pedro Joaquín Chamorro, frente a Bar domingo.</p>" +
            "<p><b>Telefonos: </b>2794-2094, 8588-7658</p>" +
            "<p><b>Responsable de Sucursal:</b> Ma. Aux. Cruzs</p>" +
            "</div>",
            {
                minwidth: minwidth,
                maxWidth: maxWidth,
                className: 'map-custom-popup'
            }
        );
    }
}
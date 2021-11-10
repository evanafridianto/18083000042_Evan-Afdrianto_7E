<link rel="stylesheet" href="assets/js/leaflet/leaflet.css">
<script src="assets/js/leaflet/leaflet.js"></script>

<script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
<link rel="stylesheet" href="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.css">

<script src="assets/js/leaflet.ajax.js"></script>

<style>
html,
body {
    height: 100%;
    margin: 0;
}

#map {
    width: 100%;
    height: 730px;
}

.dot {
    height: 15px;
    width: 15px;
    border-radius: 50%;
    display: inline-block;
}
</style>




<script>
var map = L.map('map').setView([-7.977014, 112.634056], 13);

var Layer = L.tileLayer(
    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(map);

map.addLayer(Layer);

var myStyle2 = {
    "color": "#ffff00",
    "weight": 1,
    "opacity": 0.9
};

function popUp(f, l) {

    var out = [];
    if (f.properties) {
        out.push("Kecamatan: " + f.properties['WADMKC']);
        l.bindPopup(out.join("<br />"));
    }
}

function iconByName(name) {

    return '<span class="dot" style="background-color: ' + name + ';"></span>';
}

var baseLayers = [{
        name: "OpenStreetMap",
        layer: Layer
    },
    {
        name: "GoogleSatellite",
        layer: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 18,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        })
    }
];


<?php
$getKecamatan=$db->ObjectBuilder()->get('m_kecamatan');
		foreach ($getKecamatan as $row) {
			?>

var myStyle<?=$row->id_kecamatan?> = {
    "color": "<?=$row->warna_kecamatan?>",
    "weight": 1,
    "opacity": 1
};

<?php
			$arrayKec[]='{
			name: "'.$row->nama_kecamatan.'",
			icon: iconByName("'.$row->warna_kecamatan.'"),
			layer: new L.GeoJSON.AJAX(["assets/upload/geojson/'.$row->geojson_kecamatan.'"],{onEachFeature:popUp,style: myStyle'.$row->id_kecamatan.'}).addTo(map)
			}';
		}
	?>

var overLayers = [{
    group: "Layer Kecamatan",
    layers: [
        <?=implode(',', $arrayKec);?>
    ]
}];

var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers, {
    collapsibleGroups: true
});

map.addControl(panelLayers);
</script>
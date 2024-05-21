var simplemaps_countrymap_mapdata={
  main_settings: {
    //General settings
		width: "300", //or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    border_color: "#ffffff",
    pop_ups: "detect",
    
		//State defaults
		state_description: "State description",
    state_color: "#88A4BC",
    state_hover_color: "#3B729F",
    state_url: "",
    border_size: 1.5,
    all_states_inactive: "no",
    all_states_zoomable: "yes",
    
		//Location defaults
		location_description: "Location description",
    location_url: "",
    location_color: "#FF0067",
    location_opacity: 0.8,
    location_hover_opacity: 1,
    location_size: 25,
    location_type: "square",
    location_image_source: "frog.png",
    location_border_color: "#FFFFFF",
    location_border: 2,
    location_hover_border: 2.5,
    all_locations_inactive: "no",
    all_locations_hidden: "no",
    
		//Label defaults
		label_color: "#d5ddec",
    label_hover_color: "#d5ddec",
    label_size: 22,
    label_font: "Arial",
    hide_labels: "no",
    hide_eastern_labels: "no",
   
		//Zoom settings
		zoom: "yes",
    manual_zoom: "yes",
    back_image: "no",
    initial_back: "no",
    initial_zoom: "-1",
    initial_zoom_solo: "no",
    region_opacity: 1,
    region_hover_opacity: 0.6,
    zoom_out_incrementally: "yes",
    zoom_percentage: 0.99,
    zoom_time: 0.5,
    
		//Popup settings
		popup_color: "white",
    popup_opacity: 0.9,
    popup_shadow: 1,
    popup_corners: 5,
    popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
    popup_nocss: "no",
    
		//Advanced settings
		div: "map",
    auto_load: "yes",
    url_new_tab: "no",
    images_directory: "default",
    fade_time: 0.1,
    link_text: "View Website"
  },
  state_specific: {
    NIC24: {
      name: "Rivas",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    NIC4800: {
      name: "Rio San Juan"
    },
    NIC644: {
      name: "Atlántico Sur"
    },
    NIC654: {
      name: "Carazo"
    },
    NIC655: {
      name: "Granada"
    },
    NIC656: {
      name: "Jinotega"
    },
    NIC657: {
      name: "Atlántico Norte"
    },
    NIC658: {
      name: "León"
    },
    NIC659: {
      name: "Managua"
    },
    NIC660: {
      name: "Masaya"
    },
    NIC663: {
      name: "Chinandega"
    },
    NIC664: {
      name: "Estelí"
    },
    NIC665: {
      name: "Madriz"
    },
    NIC666: {
      name: "Matagalpa"
    },
    NIC667: {
      name: "Nueva Segovia"
    },
    NIC668: {
      name: "Boaco"
    },
    NIC669: {
      name: "Chontales"
    }
  },
  locations: {
    "0": {
      lat: "12.142387",
      lng: "-86.255792",
      name: "Managua"
    }
  }
};
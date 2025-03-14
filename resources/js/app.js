import './bootstrap';

// Bug fix for wrong image URL : https://github.com/Leaflet/Leaflet/issues/4968#issuecomment-264311098

import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

import icon from 'leaflet/dist/images/marker-icon.png';
import iconShadow from 'leaflet/dist/images/marker-shadow.png';

let DefaultIcon = L.icon({
    iconUrl: icon,
    shadowUrl: iconShadow
});

L.Marker.prototype.options.icon = DefaultIcon;

import { map_index } from './map';
window.map_index = map_index;

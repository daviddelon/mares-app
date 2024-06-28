@props(['markers'])

var markers = {!! json_encode($markers) !!}

// Display map
var map=map_index(markers);

 @props (['active'=>false])

 <a {{$attributes}} class="{{ $active ? "bg-gray-900 text-white" : "text-gray-600 hover:bg-gray-700 hover:text-white" }} rounded-md px-3 py-2 text-sm font-medium" aria-current="page"> {{ $slot }}</a>

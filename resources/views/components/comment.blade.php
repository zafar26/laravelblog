{{-- @props(['item' ]) --}}

<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-2'])}}>
    {{-- <title>{{$title}}</title>
    <h1>{{$item['user_name']}}</h1>
    <h1>{{$item['message']}}</h1>
    <p>{{$item['date']}}</p>
    
    <button  class="fa-solid fa-pen-to-square"> Edit</button>
    <button  class="fa-solid fa-trash"> Delete</button> --}}
    {{$slot}}
</div>
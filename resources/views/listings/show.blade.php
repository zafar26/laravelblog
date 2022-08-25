<x-layout>
  <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4">
    <x-card class="p-10">
      <div class="flex flex-col items-center justify-center text-center">
        <img class="w-48 mr-6 mb-6"
          src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}" alt="" />

        <h3 class="text-2xl mb-2">
          {{$listing->title}}
        </h3>
        <div class="text-xl font-bold mb-4">{{$listing->company}}</div>

        <x-listing-tags :tagsCsv="$listing->tags" />

        <div class="text-lg my-4">
          <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
        </div>
        <div class="border border-gray-200 w-full mb-6"></div>
        <div>
          <h3 class="text-3xl font-bold mb-4"> Description</h3>
          <div class="text-lg space-y-6">
            {{$listing->description}}

            <a href="mailto:{{$listing->email}}"
              class="block bg-madaniColor text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                class="fa-solid fa-envelope"></i>
              Contact Blogger</a>

            <a href="{{$listing->website}}" target="_blank"
              class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i class="fa-solid fa-globe"></i>
              Visit Website</a>
          </div>
        </div>
      </div>
    </x-card>

    {{-- <x-card class="mt-4 p-2 flex space-x-6">
      <a href="/listings/{{$listing->id}}/edit">
        <i class="fa-solid fa-pencil"></i> Edit
      </a>

      <form method="POST" action="/listings/{{$listing->id}}">
        @csrf
        @method('DELETE')
        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
      </form>
    </x-card> --}}
  </div>
  @include('partials._comment', ['listing_id' => $listing->id,])
  <div class="p-4">
    {{-- {{$comments->id}} --}}
    @foreach ($comments as $item)
    {{-- <h1>{{$item}}</h1> --}}
    <x-comment class="p-10">
      <div class="flex justify-between">
        <h1 class="text-gray-400 font-thin">{{$item['user_name']}}</h1>
        <div class="flex ">
          <form  action="/listing/{{$listing->id}}/comment/edit/{{$item['id']}}">
            {{-- @csrf
            @method('POST')   --}}
            <button  class="text-gray-500 fa-solid fa-pen-to-square"> Edit</button>
          </form>
          <form method="POST" action="/comment/{{$item['id']}}">
            @csrf
            @method('DELETE')  
    
            <button type="submit" class="ml-2 text-red-700 fa-solid fa-trash"> Delete</button>
          </form>
        </div>
      </div>
      @if ($edit != null and $edit == true and $commentId == $item['id'])   
        <form method="POST" action="/comment/{{$item['id']}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-6">
            <label for="message" class="inline-block text-lg mb-2">Edit Comment</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="message"
              value="{{$item['message']}}" />

            @error('message')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div>
          <button type= 'submit' class="bg-green-600 px-4 py-2 rounded shadow text-white">Save</button>
        </form>
      @else
          <h1 class="p-6">{{$item['message']}}</h1>
      @endif
      <p class="text-gray-400  text-xs text-muted font-thin">{{$item['date']}}</p>
    </x-comment>

    @endforeach
</div>
</x-layout>
@props(['name','type' => 'text', 'label' =>''])
<div class='form-floating'>
      <input type="{{$type}}" name="{{$name}}" class='form-control mb-3 ' placeholder="Enter your Firstname" 
      {{ $attributes(['value'=> old($name)]) }}    >     
      <label >{{$label}} {{$name}}</label>
      <x-error name={{$name}} />
</div>
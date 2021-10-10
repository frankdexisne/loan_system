<div class="form-group">
    <label for="{{strtolower($label)}}">{{$label}}</label>
    <select id="{{$id}}" name="{{$name}}" class="form-control">
        @foreach($jsondata as $r)
            <option 
                value="{{$r[$optionval]}}"
            >
                {{$r[$optiontext]}}
            </option>
        @endforeach
    </select>
</div>
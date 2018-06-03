@foreach($formasis as $f)
<select class="form-control" id="rekom_formasi" >
    <option value="{{ $f->id }}">{{ $f->formasi.' '.$f->jabatan }}</option>
</select>
@endforeach

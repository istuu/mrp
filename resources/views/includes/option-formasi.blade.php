<select class="form-control" id="rekom_formasi" >
    <option value="">---Pilih Formasi---</option>
    @foreach($formasis as $f)
    <option value="{{ $f->id }}">{{ $f->formasi.' '.$f->jabatan }}</option>
    @endforeach
</select>

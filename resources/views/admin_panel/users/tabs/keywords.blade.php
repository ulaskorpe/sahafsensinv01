 
<div class="form-group">
    <label for="keywords" class="form-control-label"><b>Anahtar Kelimeler</b></label>
    <select name="keywords[]" id="keywords" class="form-control" multiple>
        @foreach($allKeywords as $keyword)
            <option value="{{ $keyword->id }}" {{ in_array($keyword->id, $selectedKeywords) ? 'selected' : '' }}>{{ $keyword->name }}</option>
        @endforeach
    </select>
    <small class="form-text text-muted">Birden fazla anahtar kelime seçmek için CTRL tuşu ile tıklayın.</small>
</div>
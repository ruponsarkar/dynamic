<div class="author-entry" data-author-index="{{ $authorIndex }}">
    <div class="author-heading">
        <strong class="author-number">Author</strong>
        <button type="button" class="btn btn-sm btn-outline-danger" data-remove-author>Remove</button>
    </div>
    <div class="author-grid">
        <label>First name <input type="text" class="form-control" name="authors[{{ $authorIndex }}][first_name]" value="{{ $authorRow['first_name'] ?? '' }}" maxlength="150" required></label>
        <label>Last name <input type="text" class="form-control" name="authors[{{ $authorIndex }}][last_name]" value="{{ $authorRow['last_name'] ?? '' }}" maxlength="150"></label>
        <label>Designation <input type="text" class="form-control" name="authors[{{ $authorIndex }}][designation]" value="{{ $authorRow['designation'] ?? '' }}" maxlength="255"></label>
        <label>Sup number <input type="number" class="form-control" name="authors[{{ $authorIndex }}][sup_number]" value="{{ $authorRow['sup_number'] ?? '' }}" min="1" max="9999" step="1"></label>
        <label class="author-affiliation">Affiliation <textarea class="form-control" name="authors[{{ $authorIndex }}][affiliation]" rows="2" maxlength="2000">{{ $authorRow['affiliation'] ?? '' }}</textarea></label>
        <label><input type="checkbox" name="authors[{{ $authorIndex }}][is_corresponding]" value="1" @if (!empty($authorRow['is_corresponding'])) checked @endif> Corresponding author</label>
    </div>
</div>

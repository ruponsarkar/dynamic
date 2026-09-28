@php
    $storedAuthors = isset($editingArticle) ? $editingArticle->publicationAuthors->toArray() : [];
    $legacyArticle = isset($editingArticle) && count($storedAuthors) === 0;
    $structured = !$legacyArticle || old('use_structured_authors', false);
    $authorRows = old('authors', $storedAuthors ?: [['first_name' => '', 'last_name' => '', 'designation' => '', 'affiliation' => '', 'sup_number' => '', 'is_corresponding' => false]]);
@endphp
<div class="publication-authors w-100" id="publication-authors">
    <h3 class="h5">Authors</h3>
    <p class="text-muted">Add authors in publication order. Authors with the same affiliation will share one affiliation entry.</p>
    @if ($legacyArticle)
        <label class="d-block"><input type="checkbox" name="use_structured_authors" value="1" id="use-structured-authors" @if ($structured) checked @endif> Enter separate author details for this article</label>
        <div id="legacy-author-fields" @if ($structured) hidden @endif>
            <p class="text-muted">The existing author information is retained until you enter separate authors below.</p>
            <label class="d-block">Existing author names <input class="form-control" name="aname" value="{{ old('aname', $editingArticle->aname) }}"></label>
            <label class="d-block">Existing affiliations <textarea class="form-control" name="designation">{{ old('designation', $editingArticle->designation) }}</textarea></label>
        </div>
    @else
        <input type="hidden" name="use_structured_authors" value="1">
    @endif
    <fieldset id="structured-author-fields" @if (!$structured) disabled hidden @endif>
        <div id="article-author-rows">
            @foreach ($authorRows as $authorIndex => $authorRow)
                @include('adminpanel.partials.article-author-row', ['authorIndex' => $authorIndex, 'authorRow' => $authorRow])
            @endforeach
        </div>
        <button type="button" class="btn btn-outline-primary mt-2" id="add-article-author">Add more</button>
        <small class="d-block text-muted mt-2">Sup number is optional. Check “Corresponding author” to add * after the name.</small>
    </fieldset>
    <template id="article-author-template">
        @include('adminpanel.partials.article-author-row', ['authorIndex' => '__INDEX__', 'authorRow' => []])
    </template>
</div>
<style>
    .publication-authors, .publication-authors * { box-sizing: border-box; }
    .publication-authors { min-width: 0; }
    .publication-authors fieldset { min-width: 0; border: 0; padding: 0; }
    .publication-authors .author-entry { padding: 16px; margin: 12px 0; border: 1px solid #ced4da; border-radius: 6px; background: #f8f9fa; }
    .publication-authors .author-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
    .publication-authors .author-affiliation { grid-column: 1 / -1; }
    .publication-authors label { display: block; padding: 0 !important; margin: 0; font-weight: 400 !important; letter-spacing: normal !important; text-transform: none !important; }
    .publication-authors input:not([type=checkbox]), .publication-authors textarea { width: 100%; min-width: 0; padding: 8px !important; border: 1px solid #ced4da !important; }
    .publication-authors .author-heading { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 12px; }
    .publication-authors button { letter-spacing: normal !important; text-transform: none !important; }
    @media (max-width: 575px) { .publication-authors .author-grid { grid-template-columns: minmax(0, 1fr); } }
</style>
<script>
(() => {
    const root = document.getElementById('publication-authors');
    const rows = root.querySelector('#article-author-rows');
    const template = root.querySelector('#article-author-template');
    let nextIndex = Math.max(-1, ...Array.from(rows.children, row => Number(row.dataset.authorIndex))) + 1;
    const refresh = () => {
        Array.from(rows.children).forEach((row, index) => {
            row.querySelector('.author-number').textContent = `Author ${index + 1}`;
            row.querySelector('[data-remove-author]').disabled = rows.children.length === 1;
        });
        root.querySelector('#add-article-author').disabled = rows.children.length >= 50;
    };
    root.querySelector('#add-article-author').addEventListener('click', () => {
        rows.insertAdjacentHTML('beforeend', template.innerHTML.replaceAll('__INDEX__', String(nextIndex++)));
        refresh();
        rows.lastElementChild.querySelector('input').focus();
    });
    rows.addEventListener('click', event => {
        const button = event.target.closest('[data-remove-author]');
        if (button && rows.children.length > 1) { button.closest('.author-entry').remove(); refresh(); }
    });
    const toggle = root.querySelector('#use-structured-authors');
    if (toggle) toggle.addEventListener('change', () => {
        const fields = root.querySelector('#structured-author-fields');
        fields.disabled = !toggle.checked;
        fields.hidden = !toggle.checked;
        root.querySelector('#legacy-author-fields').hidden = toggle.checked;
    });
    refresh();
})();
</script>

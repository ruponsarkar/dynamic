# Article authors and indexing

## Editing authors

The Add Article form has repeatable author rows with first name, last name, designation, affiliation, corresponding-author checkbox and optional superscript number. Use Add more and Remove to manage authors in publication order. First name is required; last name may be empty for a single-name author. Sup numbers, when supplied, must be positive integers.

The new `article_authors` table stores each author separately and is distinct from the existing `authors` table used for author login. The `article` table is unchanged. Saving an article writes its author rows and the two compatibility columns in one database transaction:

- `article.aname`: `P. Kanakasabai<sup>1</sup>, Saikat Banerjee<sup>2</sup>, D. Sridevi<sup>3</sup>, S. Sivamani*<sup>4</sup>`.
- `article.designation`: `<sup>1-2-4*</sup>College of Engineering …, <sup>3</sup>IT Department …`.

Identical affiliations are merged after trimming/collapsing whitespace and comparing without case. Their unique numbers stay in author order. A group containing a corresponding author gets `*`. Individual professional designations remain in the new table and in structured metadata; the compatibility `designation` column contains the grouped affiliations as requested.

The existing database limits are preserved: 1,000 characters for combined author names and 5,000 for combined affiliations, including generated HTML. Validation rejects oversized entries instead of truncating them. The UI renders only numeric superscript markup; other author-field HTML is escaped.

Existing articles are not automatically rewritten or split into guessed authors. Their edit form retains the legacy author fields by default. Select “Enter separate author details for this article” to migrate one article manually. After conversion, subsequent edits load the separate author rows. Legacy metadata can split semicolon/newline-separated names; comma-separated names need manual conversion for reliable individual author indexing.

## Deployment

The migration was applied to the configured development database. On other environments run:

```sh
php artisan migrate --path=database/migrations/2026_09_28_000000_create_article_authors_table.php --force
php artisan optimize:clear
```

Deploy the migration and code together. Confirm `APP_URL` and HTTPS/proxy configuration match the public origin. The old static `public/robots.txt` is replaced by a Laravel route; remove stale copies from any alternate document root so they do not shadow it. Uploaded files are saved under `public_html/assets/articles`; the public server must serve these at `/assets/articles/...`.

## Metadata and sitemap

The public layout now emits its article metadata section. Metadata uses each saved author's clean full name and affiliation, without `*` or superscript markers. Supported fields include:

- Highwire/Google Scholar citation tags: title, authors, author institutions, journal title/abbreviation, publisher, ISSN, publication date, volume, issue, first/last page, DOI, language, keywords, abstract URL and PDF URL.
- Dublin Core: creators, title, description, publication/submission/modification dates, identifiers, pages, language, journal source/ISSN/volume/issue/URL, publisher, rights, subjects, article type and file format.
- PRISM bibliographic tags and Schema.org ScholarlyArticle, with Person author records, designations, affiliations and journal/volume/issue relationships.
- Canonical URLs, descriptions, Open Graph and Twitter metadata; WebSite/WebPage/Periodical structured data on other public pages. Account, search and administration pages are marked noindex.

Missing data is omitted. Date parsing does not invent today's date for empty/invalid input. DOCX uploads are not advertised as PDFs. Fill in publication date, journal ISSN/publisher, language, keywords and a valid PDF to make metadata complete. OJS fields the database does not store, such as funding, multilingual alternate titles and per-author ORCIDs, are not fabricated. The existing article-level ORCID/email cannot safely be assigned to every author.

`/sitemap.xml` is a sitemap index with paginated child sitemaps for public journals, active issues, published articles and public custom pages. `/robots.txt` advertises it. Deleted/inactive articles and journals are excluded. Issue URLs retain their existing issue/volume identifiers so repeated slugs do not merge distinct issues.

Submit `/sitemap.xml` to Google Search Console and Bing Webmaster Tools after deployment. Crawlers also discover it through robots.txt. This is OJS-style HTML metadata, not an OJS installation: OAI-PMH harvesting, Crossref deposits and journal-index registrations are separate integrations. Metadata does not guarantee acceptance or automatic indexing.

References: [PKP Google Scholar plugin](https://github.com/pkp/googleScholar/blob/main/GoogleScholarPlugin.php), [OJS Dublin Core plugin](https://github.com/pkp/ojs/blob/main/plugins/generic/dublinCoreMeta/DublinCoreMetaPlugin.php), [Google Scholar inclusion guidelines](https://scholar.google.com/intl/en/scholar/inclusion.html).

## Checks

Run `vendor/bin/phpunit --do-not-cache-result tests/Unit/PublicationTest.php`. These tests use an isolated SQLite database and cover creation/edit synchronization, affiliation merging, legacy preservation, rollback, validation, HTML escaping, metadata and sitemap filtering.

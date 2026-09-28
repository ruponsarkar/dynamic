# Search and scholarly indexing

The public `/sitemap.xml` endpoint is generated from active journals, issues, articles and custom pages. `/robots.txt` advertises its absolute URL. The static `public/robots.txt` was removed so the web server forwards this request to Laravel. Ensure any separate deployment document root (including `public_html`) does not retain an old robots.txt that shadows the route.

Public pages include canonical URLs, descriptions, Open Graph, Twitter and JSON-LD metadata. Article pages additionally include Highwire/Google Scholar `citation_*` and Dublin Core tags derived from stored publication data. This is OJS-style crawler metadata; this application is not OJS and does not implement its OAI-PMH repository, Crossref deposits or indexing-service registrations.

## Publication data

For every article, enter the correct title, abstract, full author names, publication date (`YYYY-MM-DD`), journal/volume/issue, page range, language, keywords and DOI where available. Separate author names with semicolons or newlines; commas are preserved because they can belong to a name such as `Doe, Jane`. Review existing comma-separated author lists manually. Journal records supply publisher and ISSN. Missing optional data is omitted; missing publication dates fall back to the volume's year when available. Upload a publicly accessible, text-searchable PDF. DOCX files are not advertised as PDFs. Keep metadata consistent with the published document.

## Deployment

1. Set `APP_URL` to the public HTTPS origin and configure HTTPS/proxy handling correctly so generated URLs use the public origin.
2. Run `php artisan optimize:clear` after deployment, then rebuild the deployment's usual configuration/view caches. Route caching may be unavailable because this project includes closure routes.
3. Confirm `/robots.txt`, `/sitemap.xml`, article abstract pages and the linked `/assets/articles/...` PDFs return successfully without login. PDF uploads currently go to `public_html/assets/articles`; ensure the public web server serves that directory.
4. Submit `/sitemap.xml` in the site's Google Search Console and Bing Webmaster Tools accounts. Review crawl/indexing reports after crawlers revisit the site.

Metadata and sitemaps support discovery but do not guarantee inclusion in Google Scholar or other indexes. This single sitemap is intended for fewer than 50,000 URLs and 50 MB uncompressed; split it into a sitemap index before exceeding those protocol limits.

References: [Google Scholar inclusion guidelines](https://scholar.google.com/intl/en/scholar/inclusion.html), [PKP distribution settings](https://github.com/pkp/pkp-docs/blob/main/learning-ojs/3.3/en/settings-distribution.md).

## Verification

Run `vendor/bin/phpunit tests/Unit` for isolated metadata and sitemap checks. Full application checks require the existing MySQL schema and data because `AppServiceProvider` queries journal/site settings during startup.

### 4.2.1
- **[Fix]** Edited document content is not preserved
- **[Fix]** Broken URLs for the redirects to the legacy admin settings
- **[Fix]** Class prefixing error in smalot/pdfparser lib
- **[Fix]** PHP7 static code analyzer error in symfony/polyfill-mbstring lib

### 4.2.0
- **[Change]** Plugin settings moved to the top-level menu
- **[Fix]** Undefined function error during the 'index' CLI command execution
- **[Fix]** Merging words in some cases during HTML content tokenization

### 4.1.22
- **[Fix]** Synonym application too broad in some cases
- **[Fix]** Document content reindexing in some cases
- **[Fix]** Missing method reference in Comment source
- **[Fix]** Forced phrase search returns no results if the search string doesn't contain non-phrase tokens
- **[Improvement]** Search string normalization
- **[Improvement]** String highlight application when synonyms are applied
- **[Improvement]** Handling of double quotes in synonym logic in some cases

### 4.1.21
- **[Improvement]** Apply `AND` logic when applicable during quoted search query
- **[Fix]** Default application of 'Did you mean?' functionality in some cases
- **[Fix]** Regression introduced in 4.1.19 that prevented some results from displaying in some cases
- **[New]** Filter `searchwp\native\args\post_type` to modify native search post type when necessary

### 4.1.20
- **[Change]** Synonym processing now stops after first application unless `searchwp\synonyms\aggressive` filter returns `false`
- **[Fix]** Global excerpt and highlighting process now uses original search string, disregarding any filtration in some cases

### 4.1.19
- **[New]** Consider Excerpt when performing quoted search
- **[Fix]** Multisite re/index using WP-CLI
- **[Fix]** Highlight application with flanking punctuation in some cases
- **[Fix]** Highlight application with stemming enabled in some cases
- **[Fix]** PHP 8 compatibility
- **[New]** `de_DE_formal` translation
- **[Update]** Dependencies

### 4.1.18
- **[Fix]** Global excerpt generation due to newline
- **[Fix]** Relevance minimum clause implementation
- **[Fix]** Prevent search suggestion output outside main query
- **[Fix]** Incorrect fields argument definition in some cases (caused FacetWP facets to not render in some cases)
- **[Improvement]** Highlight matching in some cases

### 4.1.17
- **[New]** Added `relevance()` method to `Mod`s to allow additional manipulation of relevance calculation during searches
- **[Improvement]** Refactored WP All Import integration
- **[Fix]** Character encoding when finding global excerpts in some cases

### 4.1.16
- **[New]** `searchwp\index\source\add_hooks` filter to allow prevention of core hook implementation
- **[New]** Integration with WP All Import to better react to import processes
- **[Improvement]** Global excerpt generation in some cases
- **[Improvement]** Indexer state handling when programmatically pausing/unpausing
- **[Fix]** Searching Media in the WordPress Admin in some cases
- **[Fix]** Handling (omitting) of entries that failed indexing in some cases
- **[Fix]** Statistics migration from SearchWP 3 (if Statistics failed to migrate, please open a support ticket for direct assistance)

### 4.1.15
- **[Change]** Partial matching in synonyms has been changed, to apply partial matching add a `*` wildcard where partial matching should be applied
- **[Change]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Global excerpt generation in some cases
- **[Fix]** Regression introduced in 4.1.12 that prevented results in some cases when setting AND logic to be strict

### 4.1.14
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[New]** Rule for Media to consider filename
- **[New]** Rule for Pages and hierarchical CPTs to consider ancestry
- **[New]** Rule for Pages and hierarchical CPTs to consider `post_parent`
- **[New]** Edit and View actions for omitted entries
- **[New]** Support for Beaver Builder Search Module
- **[Fix]** Parallel indexing process when rebuilding index using WP-CLI in some cases
- **[Fix]** Customization of post stati in some cases
- **[Improvement]** Additional background process health check
- **[Improvement]** Handling of synonym input strings in some cases
- **[Improvement]** Default regular expression patterns
- **[Update]** Dependencies

### 4.1.13
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Admin search of hierarchical post types
- **[Fix]** Support ticket `iframe` height minimum in some cases
- **[Improvement]** Partial match logic in some cases

### 4.1.12
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[New]** Upper threshold that prevents `AND` logic when too many terms make it a performance issue (default is 5 token groups)
- **[New]** Filter `searchwp\query\logic\and\token_threshold` to control `AND` logic token threshold (return `false` to disable threshold consideration)
- **[Fix]** Issue with searching Users in the WP Admin
- **[Fix]** Issue with setting query fields in some cases
- **[Fix]** Statistics CSS issue in Safari in some cases

### 4.1.11
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Regression introduced in 4.1.9 that prevented saving parent weight transfer
- **[Improvement]** PDF parsing in some cases

### 4.1.10
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Background process cookie validation in some cases

### 4.1.9
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Improvement]** Reduction in index bloat in some cases
- **[Fix]** Comment parents being incorrectly returned in some cases
- **[Fix]** Error when weight transfer was enabled but no recipient defined
- **[Fix]** Error when using PHP8 in some cases

### 4.1.8
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Improvement]** Race condition prevention in background process
- **[Change]** Index controller no longer observes site switching, if switching sites you will need to first use the `searchwp\auto_update_providers` hook
- **[Change]** Keyword stemming enabled by default during setup
- **[Fix]** Results when keyword stemming and partial matching is enabled and tokens are exact matches and stemmable
- **[Fix]** Statistics migration from SearchWP 3 in some cases
- **[Fix]** Automatic integration with page builder plugin in some cases
- **[Fix]** Issue with ACF Repeatables not appearing in some cases
- **[Fix]** Issue with not being able to add custom Custom Field keys to an Engine Source

### 4.1.7
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Multisite performance issue that could lead to an Error in some cases
- **[Fix]** Integration issue that could result in an Error in some cases
- **[Fix]** Statistics migration from SearchWP 3 (Regression introduced in 4.1.0)

### 4.1.6
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Database table index optimization introduced in 4.1.5 in some configurations
- **[Fix]** Partial matches with stemming enabled during `AND` logic in some cases
- **[Improvement]** `AND` logic handling in some cases

### 4.1.5
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Exact match buoy in partial match logic
- **[Fix]** Implementation of query when `site` is set to `'all'` to search all network sites
- **[Improvement]** Partial match logic
- **[Improvement]** Handling of invalid tokens when finding partial matches
- **[Improvement]** Performance when applying delta index updates
- **[Improvement]** Performance when dropping Entries
- **[Improvement]** Handling of duplicate tokens in some cases
- **[Improvement]** Native integration in non-standard environments (e.g. page builders)

### 4.1.4
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Error during partial match application on synonyms in some cases
- **[Fix]** Admin search handling in some cases

### 4.1.3
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Synonym partial matches in some cases
- **[Fix]** Statistics display with Statistics capability but not Settings capability
- **[Fix]** HTTP Basic Auth credentials regression introduced in 4.1.0
- **[Fix]** `AND` logic performance regression introduced in 4.1.0 in some cases
- **[Improvement]** `AND` logic performance in some cases
- **[Improvement]** Background process health check coverage
- **[Improvement]** PHP 8 compatibility

### 4.1.2
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Improvement]** Indexer handling of concurrent invocations, health check/restart when process encounters Errors
- **[Improvement]** Indexer in multisite environment
- **[Fix]** `AND` logic restrictions in some cases

### 4.1.1
- **[IMPORTANT]** As of version 4.1 Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[Fix]** Error when highlighting in some cases

### 4.1.0
- **[IMPORTANT]** Comments are now a separate Source (if you are using Comments for any Post Type Source you *will need to edit your Engine and rebuild your index*, this is not done automatically and should be planned for when updating)
- **[New]** Refactored indexer for stability, reliability, and performance optimization
- **[New]** `searchwp\index\update_entry` action when an Entry is updated in the Index
- **[New]** `searchwp\debug\front_end_summary` filter to control whether the HTML comment summary is output when debugging is enabled
- **[New]** `wp searchwp reindex` WP-CLI command
- **[New]** `wp searchwp diagnostics` WP-CLI command
- **[New]** Primary keys added to database tables *for new installs* where previously there were none
- **[New]** Adds `$query` property to `\SWP_Query` to reference underlying query object
- **[New]** `searchwp\source\comment\parent_attribution\strict` hook to control whether SearchWP is strict about parent attribution which can introduce overhead in some cases
- **[New]** SearchWP will now generate more expected variations of regex pattern matches
- **[New]** `searchwp\tokens\generate_parttern_match_variations` filter to control whether additional pattern match variations are generated during indexing
- **[New]** Ability to enter custom ignored queries for Statistics (with wildcard `*` support)
- **[New]** Ability to automatically trim Statistics logs
- **[New]** Notice when WordPress available memory can be improved
- **[New]** Export/import now optionally includes Settings, Stopwords, and Synonyms
- **[New]** All ACF fields are displayed in the Custom Fields dropdown when applicable, not only ACF "Repeatables"
- **[New]** Synonyms actions: Sort ASC, Sort DESC, Clear
- **[Change]** Refines default data indexed for Taxonomy Terms to be: taxonomy name, term name, term slug, and term description
- **[Change]** Abstracts Statistics Dashboard Widget from `jquery-ui-tabs`
- **[Improvement]** Indexer auto-scaling when server load is high
- **[Improvement]** Handling of HTML-formed content during indexing
- **[Improvement]** Integration of partial matches and keyword stemming
- **[Improvement]** Indexer delta trigger specificity in some cases
- **[Improvement]** Document processing handling, footprint
- **[Improvement]** Highlighting when a suggested search has been returned
- **[Fix]** Prevent duplicate results during weight transfer in some cases
- **[Fix]** `AND` logic restriction, performance in some cases
- **[Fix]** Persistent dismissal of missing integration notice
- **[Fix]** Synonyms management in some cases
- **[Update]** Dependencies
- **[Update]** Translation source
- **[Update]** Interface updates and refinements

### 4.0.34
- **[Fix]** Fixes regression introduced by Shortcodes fix in `4.0.33` (proper fix in Shortcodes `1.8.2`)
- **[Update]** Updated updater

### 4.0.33
- **[New]** `searchwp\swp_query\mods` filter to add Mods to `SWP_Query`
- **[Fix]** PHP Warning introduced in 4.0.32
- **[Fix]** Prevention of duplicate indexing processes in some cases
- **[Fix]** Display issue on Statistics screen
- **[Fix]** PHP Warning when Admin color schemes have been removed
- **[Fix]** PDF parsing taking place unnecssarily in some cases
- **[Improvement]** Disable `searchwp_search_results` Shortcode when generating excerpts so as to prevent unwanted loop

### 4.0.32
- **[Fix]** Duplicate indexer processes in some cases
- **[Fix]** Inaccurate batch size handling in some cases
- **[Fix]** Prevent redundant search suggestion output in some cases
- **[Improvement]** Post stati validation when parent attribution is enabled
- **[Improvement]** Attachment status handling over time
- **[New]** `RAND(seed)` support by suffixing `random` `Mod` `order_by` with a colon and seed e.g. `random:10` will be `RAND(10)`

### 4.0.31
- **[Improvement]** Adds `NOT IN` option to Media File Type Rule
- **[Improvement]** Debug HTML comment block output during Admin requests
- **[Fix]** Custom Attribute Options not returning proper Label after saving
- **[Fix]** Relocate `searchwp\query\search_string` hook to fire earlier
- **[Fix]** Issue when performing cross-site Multisite search
- **[Fix]** `searchwp\query\tokens\limit` default value
- **[New]** Action `searchwp\query\core_mods_out_of_bounds` fires when core Mods are considered out of bounds

### 4.0.30
- **[Fix]** UI changes introduced by WordPress 5.5
- **[Fix]** Global excerpt generation from search suggestions
- **[Fix]** Synonym migration from SearchWP 3.x

### 4.0.29
- **[Fix]** Token handling in some cases
- **[Fix]** Document content handling when using alternate indexer in some cases
- **[Improvement]** Tokenization of HTML in some cases
- **[New]** `searchwp\entry\update_data\before` action fired before `Entry` data is retrieved
- **[Update]** Bundle dependencies

### 4.0.28
- **[Fix]** Prevent inapplicable comment edit events from triggering delta updates
- **[Improvement]** Reduced index method checks
- **[Improvement]** Reactivity when observing meta updates

### 4.0.27
- **[Fix]** File Content meta box display in some cases
- **[Fix]** Entries not being reintroduced after failing when using alternate indexer
- **[Fix]** Display of Source Attribute Options when statically defined
- **[Fix]** UI display edge cases
- **[Change]** Token handling chunked in more cases so as to avoid issues when hosts limit query character length

### 4.0.26
- **[Fix]** Handling of `SWP_Query` `tax_query` argument
- **[New]** Advanced setting checkbox to control whether stored document content is purged and re-indexed during index rebuilds
- **[Update]** Translation source

### 4.0.25
- **[Fix]** Regression introduced in 4.0.24 when utilizing PDF Metadata
- **[Improvement]** Note displayed in SearchWP Document Content meta box when document is queued but not yet processed
- **[Update]** Translation source

### 4.0.24
- **[Fix]** Handling of PDF metadata that includes invalid characters
- **[Fix]** Searching of hierarchical post types in the Admin
- **[Improvement]** Performance when handling documents outside the indexing process
- **[Update]** Bundle dependencies

### 4.0.23
- **[Fix]** Utilize previously extracted PDF metadata instead of parsing it repeatedly
- **[Change]** Updated default batch size for Media to 3, can be customized with `searchwp\indexer\batch_size\post.attachment` hook
- **[Improvement]** Handling of urlencoded tokens in some cases

### 4.0.22
- **[New]** Query parameter support for `post_type` when using `SWP_Query` (additional parameter support is planned)
- **[Fix]** Issue with partial matching yielding zero results in some cases
- **[Fix]** Quoted search support for `WP_Post` Content, Document Content
- **[Improvement]** Reduced debug log volume (logs should be deleted once you're done debugging)

### 4.0.20
- **[New]** New filter `searchwp\source\post\db_where` to customize global `WHERE` limits per post type
- **[New]** License key is automatically activated when provided via constant or hook
- **[Fix]** Error on uninstall when removing all data
- **[Fix]** Issue where Mods were not applied to `SWP_Query` in some cases
- **[Change]** No longer relying on `excerpt_more` when working with excerpts, now using ellipsis filtered by `searchwp\utils\excerpt_more`
- **[Improvement]** Handling of rare cases where index would need to be woken up repeatedly in order to build
- **[Improvement]** Omits redundant Entry retrieval in some cases
- **[Improvement]** Significant performance retrieval when generating excerpts (e.g. Highlighting)
- **[Improvement]** Advanced Custom Fields integration support

### 4.0.19
- **[Notice]** `Mod`s have in part been cleaned up and refined in this release, which may affect your usage. Please review any `Mod`s you are using by testing this update on a staging server. If you are manipulating relevance weight based on date, it is likely you will need to update your hooks. Snippets have been updated on the KB article [https://searchwp.com/?p=222848](https://searchwp.com/?p=222848) for review. Please also ensure your SearchWP Extensions are up to date as well.
- **[Fix]** Source `Mod` `WHERE` clauses causing errors in some cases
- **[Fix]** Raw `Mod` `WHERE` clauses had no local alias to utilize
- **[Fix]** `Mod` `JOIN` claus order was not retained causing errors in some cases
- **[Improvement]** Optimized `Mod` handling in `SWP_Query`
- **[Improvement]** Disable integration extension checks when doing AJAX

### 4.0.18
- **[Fix]** Error when using `mod` argument of `\SearchWP\Query` parameters array
- **[Improvement]** Control over Settings page navigation

### 4.0.17
- **[Note]** Rebuilding your index using the Rebuild Index button on the Engines tab of the SearchWP settings screen is recommended after updating
- **[Fix]** Delta update regression introduced in `4.0.13`
- **[Fix]** Error when applying delta update to Source that no longer exists
- **[Improvement]** Handling of delta update process during failures
- **[Improvement]** Delta update queue handling during index rebuild

### 4.0.16
- **[Fix]** Invalid range in character class introduced in 4.0.15 for PHP 7.3+
- **[Change]** `searchwp\tokens\whitelist\only_full_matches` retagged as `searchwp\tokens\regex_patterns\only_full_matches`
- **[Change]** `searchwp\tokens\apply_rules_to_whitelist` retagged as `searchwp\tokens\apply_rules_to_pattern_matches`
- **[Change]** `searchwp\tokens\whitelist_regex_patterns` retagged as `searchwp\tokens\regex_patterns`
- **[Change]** Regex pattern matches are now tokenized during indexing (but remain exclusive when searching by default when applicable)
- **[New]** Filter `searchwp\tokens\tokenize_pattern_matches\indexing` to disable new tokenizing of pattern match behavior during indexing

### 4.0.15
- **[New]** New filter `searchwp\tokens\string` to customize strings before tokenization
- **[Fix]** Handling of synonyms when finding partial matches
- **[Fix]** Implementation and handling of regex pattern match tokenization setting
- **[Improvement]** Dash/hyphen and word match regex patterns
- **[Improvement]** `searchwp\source\post\excerpt_haystack` filter now passes arguments array
- **[Update]** Translation source

### 4.0.14
- **[Fix]** Issue where partial matches from keyword stems were not found in some cases
- **[Fix]** Partial match token processing limited to applicable site(s)
- **[Fix]** Excerpt generation when handling unregistered Shortcodes

### 4.0.13
- **[Fix]** Delta update routine when using alternate indexer that caused unwanted exit
- **[Fix]** `searchwp\document\content` implementation
- **[Improvement]** Index integrity check when rebuilding
- **[Improvement]** Source hook management in multisite
- **[Improvement]** Upgrade routine process

### 4.0.12
- **[Fix]** Inability to filter `searchwp\settings\capability`
- **[Fix]** Issue with Highlighting in some cases
- **[Fix]** Document Content not properly considered for global excerpt in some cases
- **[Fix]** Warning when reacting to invalid `Entry` during indexing
- **[Fix]** Namespace issue with PDF parsing in some cases
- **[Fix]** Unnecessary provider reset when switching to the same site in multisite
- **[Update]** Updated updater

### 4.0.11
- **[Fix]** Loss of tokens when applying partial match logic in some cases
- **[Update]** Revised MySQL minimum to 5.6 because of `utf8mb4_unicode_520_ci` collation requirement

### 4.0.9
- **[Fix]** Regression introduced in 4.0.6 that prevented non `WP_Post` results from returning

### 4.0.8
- **[Fix]** Issue where taxonomy Rules for Media were not applied correctly in some cases

### 4.0.7
- **[Fix]** Mod `WHERE` clauses not restricted to `Source` when defined

### 4.0.6
- **[Change]** Post is now returned when parent weight transfer is enabled but Post has no `post_parent`
- **[Improvement]** Excerpt handling for native results
- **[Improvement]** Additional prevention of invalid `WP_Post` results being returned in one case

### 4.0.5
- **[New]** Filter to control stemmer locale `searchwp\stemmer\locale`
- **[Improvement]** Token stems/partial matches are considered during `AND` logic pass
- **[Fix]** String not sent to `searchwp\stemmer\custom`
- **[Change]** `searchwp\query\partial_matches\buoy` is now opt-in

### 4.0.4
- **[Fix]** Issue where `AND` logic would not apply in some cases
- **[Fix]** Issue where additional unnecessary query clauses are added in some cases
- **[Fix]** Issue with delta updates not processing when HTTP Basic Auth is active
- **[Fix]** Minimum PHP version requirement check (which is 7.2)

### 4.0.3
- **[Fix]** Issue where tokens table was not reset during index rebuild

### 4.0.2
- **[New]** Support for `BETWEEN`, `NOT BETWEEN`, `LIKE`, and `NOT LIKE` compare operators for `Mod` `WHERE` clauses
- **[Fix]** Handling of `Mod` `WHERE` clauses in some cases
- **[Fix]** Handling of REST parameters when returning search results

### 4.0.1
- **[New]** Check for remnants of SearchWP 3 that were not removed as per the Migration Guide
- **[New]** `searchwp\source\post\attributes\comments` action when retrieving Post comments
- **[Fix]** Handling of empty search strings in some cases

### 4.0.0
- **[New]** Complete rewrite of SearchWP

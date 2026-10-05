# Imports and scheduling

## Scheduled imports

The plugin uses WP-Cron. It registers the event `interq_rss_pi_cron`, and the **Frequency** setting controls how often it runs. Each run goes through the feeds that are enabled, in order.

- WP-Cron runs when someone visits the site. On a quiet site, imports may run late. If you need exact timing, disable WP-Cron's visitor trigger and call `wp-cron.php` from a real system cron or an external pinger.
- **Custom frequency** takes minutes only.

## Fetch Now

**Fetch Now** (side box) runs an import for all enabled feeds immediately. Use it to test a new feed. It is only available to users who can manage options (administrators).

## What happens to each item

For every feed item the importer:

1. Skips it if it was imported before.
2. Builds the post content from the template.
3. Cleans the HTML (see [Third-party content and security](third-party-content-and-security.md)).
4. Applies the nofollow option if it is on.
5. Optionally saves images locally.
6. Creates the post with the chosen status, author, categories and tags.
7. Sets the featured image, if enabled.

An item that fails does not stop the run. The error is written to the log if logging is on.

## Duplicates

The source link of every imported post is stored in the post meta (`rss_pi_source_url`, plus an MD5 hash in `rss_pi_source_md5`). An item is skipped when its link was already imported, or when a published post with the same title and the same source domain exists.

## Pause and resume

Pause a single feed with **Pause** on its row. Paused feeds are not imported until you click **Enable Feed**.

## The log

Switch on **Enable logging**, run **Fetch Now**, then click **View the log**. The log file is `wp-content/uploads/interq-rss-posts-importer/log.txt`. It is useful for finding out why a feed or an image did not import. Turn logging off when you are done; the file can grow.

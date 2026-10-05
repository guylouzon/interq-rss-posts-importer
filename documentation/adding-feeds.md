# Adding feeds

1. On the plugin screen click **Add new feed**.
2. Fill in the feed's fields (below).
3. Click **Save All**.

Use the **Edit** link on a feed row to open its options, **Pause** / **Enable Feed** to stop or restart importing from one feed, and **Delete** to remove it.

## Feed options

| Option | What it does |
| --- | --- |
| Feed name | A label for you. It is also available as `{$feed_title}` in the post template. |
| Feed url | The address of the RSS or Atom feed, for example `https://example.com/feed/`. Only http and https addresses on public hosts work (see [Third-party content and security](third-party-content-and-security.md)). |
| Max posts / import | The most items taken from the feed in one run (default 10). Items already imported are skipped. |
| Nofollow option for all outbound links | Per-feed setting: add `rel="nofollow"` and `target="_blank"` to links that point away from your site. |
| SEO canonical URLs | "My Blog URLs" or "Source Blog URLs". Stored with each imported post (`rss_pi_canonical_url`) so a theme or SEO plugin can use it. |
| Automatic import of Authors | Assign the post to an existing WordPress user whose name matches the feed item's author. No user accounts are created. If nothing matches, the feed's Author is used. |
| Automatic import of Categories | Use the categories listed on the feed item. Missing categories are created. |
| Strip html tags | Remove all HTML from the imported content and keep plain text. |
| Categories | Tick the categories imported posts go into (used when automatic categories are off). |
| Tags | Tags added to every post from this feed. |

## Tips

- Open the feed URL in your browser first. If you see XML, WordPress can read it.
- Start with a low "Max posts / import" and Post status set to Draft, then check a few imported posts before going live.
- Pause a feed instead of deleting it if you may want it back.

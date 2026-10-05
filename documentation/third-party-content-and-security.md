# Third-party content and security

This page explains what the plugin does with content from outside your site, and what you are responsible for.

## You need the right to use the content

The plugin copies text and images from other websites into yours. Having a public feed does not by itself give you the right to republish it. Only import feeds that:

- you own, or
- the owner allows you to republish (a license, a syndication agreement, or written permission).

Check the source site's terms. Keep the link to the original (the template tag `{$permalink}` and the stored source URL do this), and use the nofollow, canonical and noindex options where they fit. The plugin does not check permissions for you. The site owner using the plugin is responsible for what is imported.

## Imported content is untrusted

Anything inside a feed can be written by someone else, including a site that was hacked. The plugin treats feed content as untrusted:

- **HTML is cleaned before it is saved.** The imported HTML is filtered with WordPress's `wp_kses` using the same tag and attribute list as WordPress post content (`wp_kses_post`). Scripts, event handlers such as `onclick`, and `javascript:` links are removed. To change what is allowed, use the filter `interq_rss_pi_allowed_html`.
- **Strip html tags** (per feed) goes further and keeps plain text only.
- **Links** can be marked `nofollow` and open in a new tab.
- **Authors** are never created from feed data. A feed can only pick an existing user by name.
- **Categories** are only created from the feed when you switch on "Automatic import of Categories".

## Requests the plugin makes

The plugin only contacts addresses that you put in the Feed url field, plus the image addresses found inside those feeds.

- Feeds are fetched with WordPress's own feed functions, which use WordPress's safe HTTP requests.
- Images are fetched with WordPress's safe request functions: private, loopback and internal addresses are refused, only normal web ports are allowed, and redirects are checked the same way.
- Only `http` and `https` are accepted. Downloads are limited in size (10 MB by default, filter `interq_rss_pi_max_image_bytes`) and the file must be an image type WordPress accepts.
- The plugin does not send any data about your site to the feed owners beyond what any web request includes (your server's IP address and a user-agent string).

## Auto-publishing risk

Scheduled imports publish content without anyone looking at it. If a source feed is hijacked or just posts something you do not want, it will appear on your site.

To reduce the risk:

1. Set **Post status** to Draft or Pending review for feeds you do not fully control, and publish after reading.
2. Import only feeds you trust, with a small **Max posts / import**.
3. Pause or delete a feed as soon as it misbehaves.
4. Keep WordPress, your theme and this plugin up to date.
5. Keep "Download and save images locally" off unless you need it.

## Reporting a problem

Open an issue at https://github.com/guylouzon/interq-rss-posts-importer/issues. For a security problem, please contact the author privately first instead of posting details in public.

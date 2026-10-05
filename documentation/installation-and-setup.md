# Installation and setup

## Install

1. Download `interq-rss-posts-importer.zip` from the repository.
2. In WordPress go to **Plugins > Add New > Upload Plugin**, choose the zip and click **Install Now**.
   Or unzip it into `wp-content/plugins/`.
3. Click **Activate**.

The plugin registers its import job (a WP-Cron event named `interq_rss_pi_cron`, hourly by default) the first time a page loads after activation, and keeps its log file under `wp-content/uploads/interq-rss-posts-importer/`.

## First look

Open **Settings > InterQ Rss Post Importer** in the admin menu. It has:

- A **Settings** button that opens the global settings (see below).
- The feed list, with **Add new feed**.
- A side box with the plugin version, the time of the latest import, **View the log**, **Fetch Now** and **Save All**.

A fresh install contains one example feed, "interQ Trending". It is **paused**, so nothing is imported until you enable it or add your own feeds.

## Global settings

These apply to every feed.

| Setting | What it does |
| --- | --- |
| Frequency | How often the import runs. Pick one of the WordPress schedules, or "Custom frequency" and type a number of minutes. |
| Template | How each post is built. See [Templates and general usage](templates-and-usage.md). |
| Post status | Status given to imported posts (Published, Draft, Pending review...). The default is **Published**. For feeds you do not fully trust, choose Draft or Pending review. |
| Author | The WordPress user imported posts are assigned to. |
| Allow comments | Open or close comments on imported posts. |
| Block search indexing | Adds `<meta name="robots" content="noindex">` to single imported posts. |
| Nofollow option for all outbound links | Adds `rel="nofollow"` to outbound links in imported posts. |
| Enable logging | Writes import activity to a log file you can view from the plugin screen. |
| Download and save images locally | Copies images found in feed content into the Media Library. See [Featured images and media](featured-images-and-media.md). |
| Disable the featured image | Do not set a featured image on imported posts. |
| Social Media Optimization and Open Graph | Optional X (Twitter) card and Facebook Open Graph tags on imported posts. |

Click **Save All** after changing anything.

## Uninstall

Deleting the plugin from the Plugins screen runs `uninstall.php`, which removes the plugin's options. Posts and media that were already imported stay in your site.

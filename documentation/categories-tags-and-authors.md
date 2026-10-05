# Categories, tags and authors

## Categories

Each feed has a category checklist. Imported posts from that feed go into the ticked categories. If none is ticked, WordPress's default category (ID 1) is used.

With **Automatic import of Categories** set to Yes, the categories named on the feed item are used instead. A category that does not exist yet is created. Use this only for feeds you trust, because the feed decides which categories appear on your site.

## Tags

In the feed's Tags section, tick the tags to add to every post from that feed. Tags are chosen from the tags that already exist on your site.

## Authors

Every feed has an Author, taken from the global **Author** setting unless you change it on the feed.

With **Automatic import of Authors** set to Yes, the importer looks at the feed item's author name and, if a WordPress user with that username exists, assigns the post to that user. It never creates users. If no user matches, the feed's Author is used.

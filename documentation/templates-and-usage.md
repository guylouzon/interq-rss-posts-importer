# Templates and general usage

## The post template

The **Template** setting decides what goes into each post. It is plain text and HTML with tags in curly braces.

| Tag | Replaced with |
| --- | --- |
| `{$content}` | The item's content (the description if there is one, otherwise the full content) |
| `{$title}` | The item's title |
| `{$permalink}` | A link to the original item, titled with the item's title |
| `{$feed_title}` | The Feed name you gave the feed |
| `{$excerpt:n}` | The first `n` words of the item as plain text, for example `{$excerpt:55}` |
| `{$inline_image}` | The featured image, inserted into the content |

The default template is:

```
{$content}
Source: {$feed_title}
```

Example with a link back to the source and a short intro:

```
<p>{$excerpt:40}</p>
<p>Read the original: {$permalink}</p>
```

The template is saved with WordPress's post-HTML filter, so scripts and other unsafe tags are removed from it.

## General usage

- Keep **Max posts / import** small and the **Frequency** reasonable. A feed rarely adds more than a few items per hour.
- Use **Block search indexing** if you do not want imported posts competing with the original in search results.
- Use **SEO canonical URLs** and the **nofollow** options when you republish content from other sites.
- Review imported posts at least at first. Set **Post status** to Draft or Pending review for feeds you do not control.
- Read [Third-party content and security](third-party-content-and-security.md) before importing feeds you do not own.

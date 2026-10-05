# Featured images and media

## Featured image

By default each imported post gets a featured image:

1. The importer takes the **first image** (`<img>`) found in the feed item's content.
2. If the image address is relative, it is completed using the first link found in the item.
3. The image is downloaded and added to the Media Library, then set as the post's featured image.

If the item has no image, or the download fails, the post is still created without one.

**Disable the featured image** (global setting): the post gets no featured image. The first image is still saved to the Media Library, which is what `{$inline_image}` in the template uses.

## Inline image

Add `{$inline_image}` to the Template to put that image inside the post content. See [Templates and general usage](templates-and-usage.md).

## Download and save images locally

When this global setting is on, every external image in the imported content is downloaded into the Media Library and the post points to your copy. Images already on your site are left alone, as are addresses that are not http or https.

Why use it: posts keep their pictures if the source site removes them, and visitors load images from your own site.
Why not: it uses disk space and time during the import. Only do it for images you are allowed to copy.

## Safety rules for downloads

Image addresses come from the feed, so they are treated as untrusted:

- Only `http` and `https` addresses are fetched.
- Addresses that point to private or internal hosts are refused (WordPress "safe request" rules, also when the server redirects).
- Downloads are limited to 10 MB. You can change the limit with the filter `interq_rss_pi_max_image_bytes`.
- The file must be an image type WordPress accepts before it is added to the Media Library.

If an image does not import, turn on logging and run **Fetch Now**; the log says why.

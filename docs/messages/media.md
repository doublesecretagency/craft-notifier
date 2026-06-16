---
description: Attach images to posts with the `setMedia` tag. Images can be Assets or public URLs.
---

# Image Attachments

Several message types can attach one or more images to a post. Images are collected via the **`{% setMedia %}`** tag.

If the selected [message type](/messages/types/) supports images, you can add a dynamic snippet to the **Image Attachment** field  to determine which Assets or URLs will be collected.

## Syntax

Pass an Asset or Asset ID, or a URL string to `{% setMedia %}`:

```twig
{% setMedia entry.featureImage.one() %}
```

```twig
{% setMedia 'https://example.com/photo.jpg' %}
```

Or set an array of multiple items:

```twig
{% setMedia entry.photos.all() %}
```

Multiple calls accumulate, so you can combine sources:

```twig
{% setMedia entry.featureImage.one() %}
{% setMedia entry.photos.all() %}
```

### The `{% setMedia %}` tag is required

It's critical that the **Image Attachment** field include an instance of `{% setMedia %}`. If the tag is omitted, no images will be attached to the message.

- **Instagram** messages will fail, because an image is required for posting.
- **Other** message types will be sent without an image, and a warning will be logged when appropriate.

## Accepted values

| Item           | Notes                         | Example              |
|:---------------|:------------------------------|:---------------------|
| **URL string** | Any public image URL.         | `https://....jpg`    |
| **Asset**      | A native Craft Asset.         | `entry.photos.one()` |
| **Asset ID**   | The ID of an Asset.           | `asset.id`           |
| **Array**      | An array of any of the above. | `entry.photos.all()` |

## Maximum permitted images

Each platform allows a certain number of images to be uploaded:

| Message Type    | Max Images   |
|:----------------|:-------------|
| **Facebook**    | 1            |
| **Instagram**   | 1 (required) |
| **X (Twitter)** | up to 4      |
| **Bluesky**     | up to 4      |
| **Mastodon**    | up to 4      |

## Instagram exceptions

Because an image is **required** to post on [Instagram](/messages/types/instagram), it behaves a little differently from the rest.

Images posted to Instagram must resolve to a **publicly-accessible URL**. Unlike other message types, it's not possible to upload an image by transmitting bytes directly. This means that images stored in private volumes, or in local development environments, cannot be shared to Instagram.

:::warning Instagram Image Requirements:
- **JPEG format only.** No PNGs, GIFs, WebP, etc.
- Max 8 MB filesize.
- Width between 320px - 1440px.
- Aspect ratio between 4:5 - 1.91:1.
- Must resolve to a **publicly-accessible URL**.
  :::

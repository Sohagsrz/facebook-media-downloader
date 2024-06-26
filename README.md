# Facebook Media Downloader

## Description

This is a PHP library for downloading media from Facebook. It allows you to easily download videos and reels from Facebook.

## Installation

To install the Facebook Media Downloader, follow these steps:

```bash
composer require sohagsrz/fbmediadownloader
```

```php
<?php
require 'vendor/autoload.php';
use FbMediaDownloader\Downloader;
$downloader = new Downloader();
//set idurl
$downloader->set_url('https://www.facebook.com/sohagsrz/videos/277183161103537');
$datas = $downloader->generate_data();
var_dump($datas);
?>
```

# Preview

```json
{
  "title": "",
  "dl_urls": {
    "low": "https://video.fdac7-1.fna.fbcdn.net/v/t42.1790-2/273515319_640783503829950_9149715574191626612_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=55d0d3&efg=eyJybHIiOjMzNCwicmxhIjo1MTIsInZlbmNvZGVfdGFnIjoic3ZlX3NkIiwidmlkZW9faWQiOjI3NzE4MzE2MTEwMzUzN30%3D&_nc_ohc=liZyYb2BPtQQ7kNvgEl6X68&rl=334&vabr=186&_nc_ht=video.fdac7-1.fna&oh=00_AYDTX7_zzbLdtqFGZ04d3sYXYbCbATeDun6gQm_ldDqqNw&oe=66588B79&dl=1",
    "lowData": {
      "size": "1836881",
      "sizeHuman": "1.75 MB",
      "type": "video/mp4"
    },
    "high": "https://video.fdac7-1.fna.fbcdn.net/o1/v/t2/f2/m69/An_LXwcXLs40mLZWLUCzsg5VLsTGk4Mo3axbJAaTZBWQVnQdTdoNBSDPV01Yme2OBcEkaBLvcJYhBMQSF1KreGZL.mp4?efg=eyJ2ZW5jb2RlX3RhZyI6Im9lcF9oZCJ9&_nc_ht=video.fdac7-1.fna.fbcdn.net&_nc_cat=103&strext=1&vs=1a197f40e74c2561&_nc_vs=HBksFQIYOnBhc3N0aHJvdWdoX2V2ZXJzdG9yZS9HTnpxWHhwMzdfU3Z4dE1HQUQzUGYybzVlTlFZYm1kakFBQUYVAALIAQAVAhg6cGFzc3Rocm91Z2hfZXZlcnN0b3JlL0dLQU5UeEF0bkl5WlBxY0VBTXlkQ1NUMm9tVm9idjRHQUFBRhUCAsgBAEsHiBJwcm9ncmVzc2l2ZV9yZWNpcGUBMQ1zdWJzYW1wbGVfZnBzABB2bWFmX2VuYWJsZV9uc3ViACBtZWFzdXJlX29yaWdpbmFsX3Jlc29sdXRpb25fc3NpbQAoY29tcHV0ZV9zc2ltX29ubHlfYXRfb3JpZ2luYWxfcmVzb2x1dGlvbgAddXNlX2xhbmN6b3NfZm9yX3ZxbV91cHNjYWxpbmcAEWRpc2FibGVfcG9zdF9wdnFzABUAJQAcjBdAAAAAAAAAABERAAAAJt75oL3k17gDFQIoAkMzGAt2dHNfcHJldmlldxwXQFOxBiTdLxsYGWRhc2hfaDI2NC1iYXNpYy1nZW4yXzcyMHASABgYdmlkZW9zLnZ0cy5jYWxsYmFjay5wcm9kOBJWSURFT19WSUVXX1JFUVVFU1QbCogVb2VtX3RhcmdldF9lbmNvZGVfdGFnBm9lcF9oZBNvZW1fcmVxdWVzdF90aW1lX21zATAMb2VtX2NmZ19ydWxlB3VubXV0ZWQTb2VtX3JvaV9yZWFjaF9jb3VudAQ4MzA5EW9lbV9pc19leHBlcmltZW50AAxvZW1fdmlkZW9faWQPMjc3MTgzMTYxMTAzNTM3Em9lbV92aWRlb19hc3NldF9pZA8zNDcyODgxMDM5MTg2OTIVb2VtX3ZpZGVvX3Jlc291cmNlX2lkDzk2OTA3ODM2NzA2Nzc1ORxvZW1fc291cmNlX3ZpZGVvX2VuY29kaW5nX2lkDzQ2NjI4NTAwOTQxMzY1Ng52dHNfcmVxdWVzdF9pZAAlAhwAJcQBGweIAXMENTY0NAJjZAoyMDIyLTAyLTEwA3JjYgQ4MzAwA2FwcAVWaWRlbwJjdBlDT05UQUlORURfUE9TVF9BVFRBQ0hNRU5UE29yaWdpbmFsX2R1cmF0aW9uX3MGNzguNzU4AnRzFXByb2dyZXNzaXZlX2VuY29kaW5ncwA%3D&ccb=9-4&oh=00_AYCsauzzshpN0Iw4INDk71yy2feqacchIvDx55zFomJiYQ&oe=66546CF2&_nc_sid=1d576d&_nc_rid=511844004881258&_nc_store_type=1&dl=1",
    "highData": {
      "size": "8778480",
      "sizeHuman": "8.37 MB",
      "type": "video/mp4"
    }
  },
  "status": 200,
  "id": "277183161103537",
  "url": "https://www.facebook.com/sohagsrz/videos/277183161103537"
}
```

## Contributing

If you would like to contribute to the Facebook Media Downloader project, follow these steps:

1. Fork the repository on GitHub.
2. Clone the forked repository to your local machine.
3. Make the necessary changes or additions to the code.
4. Commit your changes and push them to your forked repository.
5. Create a pull request to the original repository.

# Facebook Media Downloader

## Description

This is a PHP library for downloading media from Facebook. It allows you to easily download videos and images from Facebook posts.

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

## Contributing

If you would like to contribute to the Facebook Media Downloader project, follow these steps:

1. Fork the repository on GitHub.
2. Clone the forked repository to your local machine.
3. Make the necessary changes or additions to the code.
4. Commit your changes and push them to your forked repository.
5. Create a pull request to the original repository.

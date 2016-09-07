# Safe WP URL Request

Include the file in your `functions.php` and use the function to get the `<body>` content, WP Error message, or Error Code (400+) and the Error Mesage.

[Get the file](/safe-wp-url-request.php)

## Usage
```
$response = safe_wp_url_request( 'http://some.site.com' );
echo $response;
```

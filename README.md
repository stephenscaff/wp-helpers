# Wp Helpers
A ongoing collection of Wordpress helpers and utlities.

### Note on Organization
I like to organize by Wp projects with an inc folder that houses all my custom classes, functions and what not.
I then include the individual files in the functions.php like so:

```php
# Post Helpers
require_once('inc/utils/post-helpers.php');

# Paths
require_once('inc/utils/paths.php');

```# wp-helpers

# Wp Helpers
A ongoing collection of Wordpress helpers and utlities, classes and functions.

### Note on Organization
I like to organize by Wp projects with an inc folder that houses all my custom classes, functions and what not.
I then include the individual files in the functions.php like so:

```php
# Post Helpers
require_once('inc/utils/post-helpers.php');

# Paths
require_once('inc/utils/paths.php');

```

This helps to structre a Wp project like any other project. 
Kick rocks with that child theme, bloated premium theme, mad plugins, nonesense. 
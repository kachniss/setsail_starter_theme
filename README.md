# Setsail Wordpress Starter Theme

## Usage
* Download and unpack to themes folder
* Search and replace `edit_theme Theme` with custom theme name (package name)
* Search and replace `edit_theme` by custom theme name (function names)
* Search and replace `localhost/Setsail_projects/edit_theme/` in `gulpfile.js`. Use your custom path.
* Search and replace `Custom name` in `extras.php` to change the email sender name
* run `npm init`
* run `gulp`
* edit variables & styles

## Input structure
* CSS & Sass files in `/sass`
* JS files in `/js`
* minified vendor files in `/build`

* assets
    * fonts
    * images
        * bg
        * icons
        * logos
    * videos

## Output
* minified CSS in `/build/css`
* minified JS in `/build/js`

## Deployment
When uploading to server, DO NOT upload folders/files used only for development!
Those folders/files are the following:
* js
* node_modules
* sass
* .babelrc
* .eslintrc
* gulpfile.js
* package.json
* package-lock.json
* phpcs.xml.dist
* yarn.lock

## Adding multiple CSS files
* create new Sass file with imports
* make sure all imports are in style.css
* conditionaly enqueue file in `/inc/equeues.php`

## Adding multiple JS files
* create new subfolder in `/js`
* change gulpfile - merge tasks in scripts
* conditionaly enqueue file in `/inc/equeues.php`

## WooCommerce
Contains folders for WooCommerce templates and hooks.
Add WooCoommerce support by uncommenting function in `/inc/extras.php`

## CSS Grid for IE
The `sass` folder contains a mixin for creating CSS Grids that are supported in IE.
* Use `@include is-ie` to conditionally apply styles only for IE
* Use `@include ie-grid` inside of `@include is-ie` to add CSS Grid styles that are working in IE

The mixin requires following parameters:
* Number of columns
* Max number of rows
* Grid gap for rows
* Grid gap for collumns

## Author
* Katerina Vopalkova - Setsail Interactive Inc.
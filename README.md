# Setsail Wordpress Starter Theme

## Usage
* download and unpack to themes folder
* search and replace `edit_theme` by custom theme name (package name, gulp path, function names)
* run `npm init`
* check gulpfile
* run `gulp`
* edit variables & styles

## Input
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

## Author
* Katerina Vopalkova - Setsail Interactive Inc.
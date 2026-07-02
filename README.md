# keweb

keweb repository

TO START THE PROJECT:

1. Rename theme name in .env file to your desired name
2. Navigate to project folder in your terminal
3. run "docker-compose up" in your terminal
4. navigate to localhost:8000 to install Wordpress
5. install dependencies.
   'npm init'
   'npm install'
   'npm run watch' to watch for changes
   'npm run sync' to run browsersync

// FOLDERS AND FILES

## ACF Blocks Folder

The `acf-blocks` folder contains the Advanced Custom Fields (ACF) blocks for your WordPress project. ACF blocks are reusable components that allow you to create custom layouts for your website's content.

## Assets Folder

The `assets` folder is used to store various static assets such as images, CSS stylesheets, JavaScript files, fonts, or any other files required for the visual presentation and functionality of your WordPress project.

### Dist Folder

The `dist` folder contains compiled and optimized files ready for deployment to a live WordPress site. These files are typically generated using build tools like webpack or gulp.

### Fonts Folder

The `fonts` folder is used to store font files that are utilized in your WordPress project. These font files can be referenced and applied to different elements of your website's design.

### Img Folder

The `img` folder is where you can store image files used in your WordPress project. It is recommended to organize the images based on their purpose or category for easier management.

### JS Folder

The `js` folder holds JavaScript files used for adding interactivity and dynamic behavior to your WordPress project. You can store custom JavaScript files or include third-party libraries within this folder.

### SCSS Folder

The `scss` folder is used for managing your project's Sass (Syntactically Awesome Style Sheets) files, which allow for more efficient and modular CSS development.

// SCSS FOLDER SUBFOLDERS

#### Abstracts Folder

The `abstracts` folder within the `scss` directory holds Sass partials that typically store variables, mixins, and functions used throughout your project. These partials help maintain consistency and reusability of styles across different components.

#### Base Folder

The `base` folder contains Sass partials that define foundational styles for your WordPress project. This includes styles for typography, resets, global styles, and other base-level styles that form the core appearance of your website.

#### Blocks Folder

The `blocks` folder within the `scss` directory is used for creating styles specific to the Advanced Custom Fields (ACF) blocks in your WordPress project. It allows you to customize the appearance of individual blocks or groups of blocks, providing visual consistency and tailored styles.

#### Layout Folder

The `layout` folder holds Sass partials that define the overall layout structure of your WordPress project. It typically includes styles for the header, footer, sidebar, and other layout-related components. This folder helps you organize and maintain consistent layout styles throughout your website.

## Functions Folder

The `functions` folder holds PHP files that contain custom functions, hooks, or filters specific to your WordPress project. This folder serves as a centralized location to manage and organize the custom functionality of your website.

## Includes Folder

The `include` folder is used to store PHP files that are included or required by other files within your WordPress project. These files often contain reusable code snippets or utility functions that can be shared across multiple templates or components.

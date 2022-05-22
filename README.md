# Theme guide

-   Startup theme
-   Get GIT repo
-   Theme structure
-   NPM setup
-   Compilation
-   CSS: Foundation settings
-   CSS: Add foundation modules
-   CSS: Edit existing custom modules
-   CCS: Add custom modules
-   JS: Add foundation modules
-   JS: Edit existing custom modules
-   JS: Add custom modules
-   Problem -> Solution

## Startup theme

To start with the startup theme just download the zip version of `sqe-starter-legal-foundation` repo and install it on the website. Do the following steps right after the initial installation:

1. Rename theme folder and edit `style.css` (change theme name);
2. Edit `functions.php`: change `WEBSITE_NAME` and `WEBSITE_SLUG` definitions at the top of the file;
3. Skip **Get GIT repo** step and set up NPM and files compilation (guides below);
4. Develop the theme (you can start with editing `src\css\_settings.scss` to set default theme styling);

Before pushing this theme to a new client-related repo, delete this **Startup theme** step from the **README.md** file, rename **sqe-starter-legal-foundation** to the actual theme slug and change git repo links.

## Get GIT repo (in case you want to change starter theme itself)

To install the theme from git within a command line navigate to `\theme\` folder in your WordPress installation and execute the following command:

```
git clone https://github.com/SquareEyeLtd/sqe-starter-legal-foundation.git
```

Or you can create theme folder manually right away, navigate to the created folder within a command line and execute the following command:

```
git clone https://github.com/SquareEyeLtd/sqe-starter-legal-foundation.git .
```

## Theme structure

### Source files

Source files are used for compilation and are located in `src` folder in the theme root:

```
\THEME_NAME\src\
|-- js
|   |-- theme.js # import foundation modules and custom modules here
|   |-- modules
|   |   |-- ... # custom JS modules
|-- css
|   |-- theme.scss # import foundation modules and custom modules here
|   |-- _settings.scss # foundation settings
|   |-- modules
|   |   |-- ... # custom CSS modules
```

### Compiled files

Compiled files are used in the actual theme and are located in `assets` folder in the theme root:

```
\THEME_NAME\assets\
|-- js
|   |-- theme.min.js # final JS file for enqueueing
|-- css
|   |-- theme.min.css # final CSS file for enqueueing
```

You can add any additional CSS or JS files you need for the project inside `\assets\css\` or `\assets\js\` folders and then enqueue them in `\functions\enqueue-scripts.php` file.

### Foundation

Foundation source files are added with NPM package, so they will be located within `node_modules` folder once you set NPM.

## NPM setup

Once you get the theme from the git you need to install all dependencies.

First, make sure that you have NPM installed on your computer:

-   [Windows](https://phoenixnap.com/kb/install-node-js-npm-on-windows)
-   [Mac](https://treehouse.github.io/installation-guides/mac/node-mac.html)

Once you got NPM installed, use command line to navigate to the theme folder and run the following command:

```
npm install # (installing all dependencies from package.json)
```

## Compilation

The compilation is handled by [Prepros](https://prepros.io/). Download free version. Don't need to buy any license, just prepare to be bothered by popup from time to time.

Once Prepros is installed, just drag theme folder to the app screen. That's it. There is `prepros.config` file in the theme folder that got all required settings. You can just start to edit the files.

## CSS: Foundation settings

`\src\css\_settings.scss` - use this file to change Foundation SASS settings like default colors, fonts, spacings etc.

## CSS: Add foundation modules

Initially, only necessary Foundation CSS(SASS) modules are added to the project. You can add any additional Foundation module by following those steps:

1. Navigate to `\src\css\theme.scss` file.
2. Just uncomment required module.
3. That's it. No more steps. It's pretty straightforward. Do we really need steps here in the first place?...

For example, you want to add a Foundation Card module. Then look for:

```
//@include foundation-card;
```

And just uncomment it and save the file. Prepros will handle the rest.

```
@include foundation-card;
```

## CCS: Edit existing custom modules

All custom CSS modules are located in `\src\css\modules\` folder. Those are [SASS](https://sass-lang.com/documentation) files (hence **.scss** extension), but you can write simple CSS there as well. Though it's better to use [SASS](https://sass-lang.com/documentation), as it's more compact and readable. Prepros then will convert it to minified CSS.

## CCS: Add custom modules

Add your custom CSS/SASS parts within `\src\css\modules\` folder as well. Then add those modules in `\src\css\theme.scss`.

For example, you want to add new CSS rules for pagination:

1. Create new file with **.scss** extension in `\src\css\modules\` folder like `\src\css\modules\pagination.scss`
2. Open `\src\css\theme.scss` and under `CUSTOM MODULES` title add the following line:

```
import 'modules/pagination'
```

_There is a list of different modules already, so you can add your module to the end of this list. Besides, note that no extension is required for **import** expression._

## JS: Add foundation modules

Initially, only necessary Foundation JS modules are added to the project. You can add any additional Foundation module by following those steps:

1. Navigate to `\src\js\theme.js` file.
2. Look for `// Require Foundation modules` line under which you'll see a list of "require"s. Those require modules from the Foundation NPM package.
3. Copy one of the "require" lines and replace the name of the module

Example:

```
...
require('foundation-sites/dist/js/plugins/foundation.sticky.min.js');
require('foundation-sites/dist/js/plugins/foundation.tabs.min.js');
require('foundation-sites/dist/js/plugins/foundation.dropdownMenu.min.js');
require('foundation-sites/dist/js/plugins/foundation.NEW_FOUNDATION_MODULE_NAME.min.js');
```

You can use [Foundation Docs](https://get.foundation/sites/docs/index.html) for reference. There is a **JavaScript Reference** section for modules that need JS to work.

**!!! Make sure that you require utility modules first.**

## JS: Edit existing custom modules

All custom JS modules are located in `\src\js\modules\` folder. You can just open any of them, edit and save. Prepros will handle the rest.

Classish structure was used for initial theme JS files:

```
import $ from 'jquery';

class ModuleName {
    constructor() {
        // Declare all variables below
        this.filter = $('#filters');
        this.secondVar;

        // Call all events
        this.events();
    }

    events() {
        this.filter.on('click', this.doSomethingWithFilter.bind(this)); // Bind Class (ModuleName) to the function
        $(document).on('click', '#filters select', e => this.selectDisplay(e)); // Don't bind Class, but event data instead.
    }

    // Methods below
    doSomethingWithFilter() {
        console.log('Filter is clicked!');
    }

    selectDisplay(e) {
        let target = $(e.target);
        ...
    }

    ...
}

export default ModuleName
```

## JS: Add custom modules

Add your custom JS modules within `\src\js\modules\` folder. Then require those modules in `\src\js\theme.js`.

1. Create file `ModuleName.js` in `\src\js\modules\`.
2. Open `\src\js\theme.js` file and under `// Import custom modules` line add the following code:

```
import ModuleName from "./modules/ModuleName" // Importing ModuleName Class from ModuleName.js file
```

3. Then in the same file look for `// Launch custom modules` line and add under it the following code:

```
var moduleName = new ModuleName(); // Initialize ModuleName class and keep result in moduleName variable.
```

**!!! Note how the variable's first letter isn't capitalized to differentiate it from the Class name.**

## Problem -> Solution

### "error: invalid path... warning: Clone succeeded, but checkout failed." in the command line while cloning the repo.

Try following commands to finilize the cloning:

```
git config --global core.protectNTFS false
git checkout -f HEAD
```

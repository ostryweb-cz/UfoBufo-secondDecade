# UFO BUFO WordPress Theme

## Overview
UFO BUFO is a modern, optimized WordPress theme for the UFO BUFO psychedelic music and art festival. The theme features a professional build system, clean architecture, and is optimized for performance with conditional asset loading.

## Key Features
- **Legacy JavaScript Architecture**: jQuery-based component system with webpack bundling
- **Professional Build System**: Separate development and distribution workflows
- **Pre-compiled Assets**: Single front.js bundle (7.2MB) built with webpack/babel
- **Clean Distribution**: Production-ready builds exclude source files and dev tools
- **SASS Architecture**: Component-based styling with BEM methodology
- **Mobile Responsive**: Mobile-first design with adaptive quality
- **Festival-Specific**: Gallery system, lineup display, multilingual (CS/EN)

## Project Structure
```
UfoBufo-secondDecade/
├── js/                      # JavaScript files (legacy structure)
│   ├── front.js            # Pre-compiled bundle (7.2MB) - loaded in header
│   ├── ostryweb.js         # Additional script (161B) - loaded in footer
│   └── src/                # JavaScript source files
│       ├── app.js          # Main entry point
│       ├── components/     # jQuery-based components (10 files)
│       │   ├── fractal.js           # Homepage lens animation
│       │   ├── gallerySwiper.js     # Gallery carousel with Swiper
│       │   ├── modal.js             # Video modal with iziModal
│       │   ├── move-items.js        # Lineup date organization
│       │   ├── replace-dates.js     # Date localization
│       │   ├── responsiveMenu.js    # Mobile menu toggle
│       │   ├── toggle-lineup.js     # Lineup view switcher
│       │   ├── toggle-search.js     # Search form toggle
│       │   ├── tooltipster.js       # Tooltip functionality
│       │   └── trim-items.js        # Text manipulation
│       └── vendor/
│           └── iziModal.js  # iziModal library source
│
├── css/                     # Compiled CSS and SASS sources
│   ├── sass/               # SASS source files (development)
│   ├── front.min.css       # Main compiled stylesheet
│   └── 2025.css            # Year-specific styles
│
├── template-parts/          # PHP template partials
│   ├── boxes/              # Content box components
│   ├── stages/             # Festival stage templates
│   └── *.php               # Other template parts
│
├── inc/                     # PHP includes and helpers
│   ├── webpack-assets.php  # Smart asset loading
│   └── customizer.php      # WordPress customizer
│
├── fonts/                   # Web fonts
├── img/                     # Theme images and assets
├── languages/               # Translation files (CS/EN)
│
├── dist/                    # Distribution builds (generated)
│   └── UfoBufo-secondDecade/ # Clean WordPress theme
│
├── *.php                    # WordPress template files
├── functions.php            # Main theme functionality
├── style.css                # Theme metadata
├── package.json             # Build configuration
├── webpack.config.*.js      # Webpack configurations
├── README.md                # Development documentation
├── DEPLOY.md                # Deployment guide
└── .gitignore               # Version control rules
```

## Technical Stack

### Core
- **WordPress**: 5.9+
- **JavaScript**: jQuery-based with ES6 imports, Webpack 5, Babel
- **CSS**: SASS with BEM methodology
- **Build System**: Webpack (legacy) and Gulp for building

### JavaScript Libraries (Bundled)
- **jQuery** (via WordPress) - Core framework
- **Swiper** - Gallery carousel (imported in gallerySwiper.js)
- **iziModal** - Image lightbox (from vendor/)
- **GSAP** - Homepage lens/fractal animations (imported in fractal.js)
- **BasicScroll** - Parallax effects (imported in app.js)

**Library Loading Architecture:**
- All libraries and components are **bundled into front.js** (7.2MB)
- Single pre-compiled bundle approach
- Loaded via `<script>` tag in header.php
- External libraries copied to `dist/js/libs/` during distribution build
- Uses require/import statements in source files

### Removed Libraries (Oct 2025)
- ~~VideoJS~~ (684KB) - Commented out code removed
- ~~Tooltipster~~ (56KB) - Commented out code removed
- ~~Moment.js~~ - Not used
- ~~svg4everybody~~ - Not needed

### Build Tools
- Webpack 5 (legacy config) for JS bundling
- Babel for ES6+ transpilation
- Gulp for task automation
- SASS compiler for CSS
- Copy Webpack Plugin for distribution

## Development Workflow

### Initial Setup
```bash
cd ~/projects/UfoBufo-secondDecade
npm install
npm run build
```

### Development Commands
```bash
npm run dev          # Watch and rebuild automatically (webpack)
npm run build        # Build production JS to /js/ using webpack
npm run clean        # Protected - legacy JS files preserved

# Alternative: Use Gulp
gulp webpack         # Compile JS with webpack
gulp watch           # Watch files and rebuild
```

### Distribution Commands
```bash
npm run dist         # Build complete WordPress theme to /dist/
npm run dist:clean   # Remove /dist/ folder
npm run dist:package # Create .tar.gz archive
npm run deploy       # Build and show deployment message
```

### CSS Compilation
```bash
sass css/sass/front.sass css/front.min.css --style=compressed
```

## Development Guidelines

### Code Structure
- Use component-based architecture for JS and CSS
- Follow mobile-first responsive design principles
- Maintain clean separation of concerns (MVC-like pattern)
- The submenu should always be shown on mobile devices

### Performance
- Lazy load components based on page content
- Use code splitting for large libraries
- Implement preload/prefetch hints
- Optimize images and assets
- Enable conditional script loading

### Accessibility
- Maintain WCAG 2.1 AA standards
- Use semantic HTML5 elements
- Provide proper ARIA labels
- Ensure keyboard navigation works

### Version Control
- Commit source files (js/src, css/sass, *.php)
- **DO commit** legacy compiled JS (js/front.js, js/ostryweb.js)
- Never commit node_modules/ or dist/
- Use .gitignore properly

## Asset Loading Strategy

The theme uses simple script tag loading:

### Main JavaScript Bundle
- **front.js** (7.2MB) - Pre-compiled bundle with all components and libraries
- Loaded in `<head>` via `<script>` tag in header.php
- Contains: All components, Swiper, iziModal, GSAP, BasicScroll
- Single bundle approach for simplicity

### Additional Scripts
- **ostryweb.js** (161B) - Additional utility script
- Loaded in footer via `<script>` tag in footer.php

### Distribution Library Files
During distribution build, external library files are copied to `dist/js/libs/` for reference:
- swiper.min.js (151KB)
- izimodal.min.js (26KB)  
- gsap.min.js (71KB)
- basicscroll.min.js (10KB)

Note: These are included for potential future optimization but currently not used (all bundled in front.js)

## Distribution Build

### What Gets Included
✅ **Production Files**
- All PHP template files (*.php, template-parts/, inc/)
- Compiled JavaScript bundles (js/)
- Compiled CSS (css/front.min.css, css/2025.css)
- Fonts (fonts/)
- Images (img/)
- Theme metadata (style.css, screenshot.png)
- Languages (languages/)

❌ **Excluded from Distribution**
- JavaScript source files (js/src/)
- SASS source files (css/sass/)
- node_modules/
- Build configurations (webpack.config.*.js, package.json)
- Development files (.gitignore, README.md)
- .git/ directory

### Building Distribution
```bash
npm run dist
# Output: dist/UfoBufo-secondDecade/
```

The distribution folder contains a complete, production-ready WordPress theme:
- No source files or build tools
- Only compiled assets
- Ready to copy to `/wp-content/themes/`
- Can be packaged as .tar.gz for server upload

## Deployment Process

### Local/Staging Deployment
```bash
npm run dist
cp -r dist/UfoBufo-secondDecade /path/to/wordpress/wp-content/themes/
```

### Production Server Deployment
```bash
npm run dist:package
# Creates: dist/UfoBufo-secondDecade-YYYYMMDD.tar.gz
# Upload to server and extract
```

### Post-Deployment Checklist
- [ ] Clear WordPress cache
- [ ] Hard refresh browser
- [ ] Test JavaScript functionality
- [ ] Verify gallery works
- [ ] Check homepage animations
- [ ] Test mobile responsive design
- [ ] Verify multilingual switching (CS/EN)

## Browser Support
- **Modern browsers**: Chrome, Firefox, Safari, Edge (latest 2 versions)
- **Mobile**: iOS Safari, Chrome Mobile, Samsung Internet
- **Target**: > 0.25% market share, not dead browsers
- **IE11**: Not supported (uses ES6+ features)
- **Approach**: Mobile-first responsive design with progressive enhancement

## File Sizes

### JavaScript
**Core Application:**
- front.js: 7.2MB (includes all components and libraries)
- ostryweb.js: 161B

**External Libraries (in dist for reference, not loaded separately):**
- swiper.min.js: 151KB
- izimodal.min.js: 26KB
- gsap.min.js: 71KB
- basicscroll.min.js: 10KB

**Total JS Loaded:**
- All pages: 7.2MB (single front.js bundle)

### CSS
- front.min.css: ~150KB (compressed)
- 2025.css: ~5KB

### Distribution Package
- Total theme: ~33MB (mostly images)
- PHP files: ~200KB
- JavaScript: ~7.5MB (front.js + ostryweb.js + libs)
- CSS: ~155KB
- Fonts: ~140KB
- Images: ~23MB

## Recent Changes (October 2025)

### JS Architecture Restoration
- ✅ Restored legacy jQuery-based JS architecture from backup
- ✅ Removed modern ES6 class-based architecture from /assets/js/
- ✅ Restored jQuery-based components from backup
- ✅ JS structure restored:
  - /js/front.js - compiled bundle (7.2MB)
  - /js/ostryweb.js - additional script
  - /js/src/app.js - main entry point
  - /js/src/components/ - all component files
  - /js/src/vendor/iziModal.js
- ✅ Updated build configuration:
  - webpack.config.js - old webpack config pointing to /js/src/app.js
  - gulpfile.js - gulp tasks for build process
- ✅ Updated PHP files:
  - functions.php - removed webpack-assets.php include
  - header.php - added front.js script tag
  - footer.php - added ostryweb.js script tag
- ✅ Updated dist build to copy legacy files
- ✅ Distribution ready in /dist/ (33MB)

### Documentation Added
- README.md - Development guide
- DEPLOY.md - Deployment procedures
- This WARP.md - Technical overview updated for legacy architecture

## Known Issues
- Location page area plan tooltips commented out (not in use)
- Homepage video modal commented out (YouTube embed used instead)

## Future Improvements
- Consider implementing lazy loading for images
- Add WebP image format support
- Implement service worker for offline capability
- Add critical CSS inlining
- Consider moving to WordPress block editor

## Author
**Hynek Šťavík** - [ostryweb.cz](http://ostryweb.cz/)  
**Technical Support**: [Jan Boruta](https://github.com/borutak)

## License
GNU General Public License v3.0

---

## Additional Documentation

For detailed documentation on specific parts of the theme:

- **README.md** - Complete development and build guide
- **DEPLOY.md** - Deployment procedures and troubleshooting
- **css/WARP.md** - SASS architecture and styling guidelines
- **inc/WARP.md** - PHP functionality and WordPress integration

## Quick Reference

### Common Tasks

**Start Development:**
```bash
npm run dev
```

**Build for Testing:**
```bash
npm run build
```

**Create Distribution:**
```bash
npm run deploy
```

**Package for Upload:**
```bash
npm run dist:package
```

### File Locations

- JavaScript source: `js/src/`
- Compiled JS: `js/`
- SASS source: `css/sass/`
- Compiled CSS: `css/`
- Templates: `*.php` and `template-parts/`
- Distribution: `dist/UfoBufo-secondDecade/`

---

**Last Updated**: October 2025  
**Theme Version**: 1.0.1  
**WordPress Version**: 5.9+

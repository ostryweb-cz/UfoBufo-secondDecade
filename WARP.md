# UFO BUFO WordPress Theme

## Overview
UFO BUFO is a modern, optimized WordPress theme for the UFO BUFO psychedelic music and art festival. The theme features a professional build system, clean architecture, and is optimized for performance with conditional asset loading.

## Key Features
- **Legacy JavaScript Architecture**: jQuery-based component system with webpack bundling
- **Professional Build System**: Separate development and distribution workflows
- **Optimized Assets**: Single front.js bundle (148KB) built with webpack/babel
- **External jQuery**: Uses WordPress-provided jQuery instead of bundling
- **Clean Distribution**: Production-ready builds exclude source files and dev tools
- **SASS Architecture**: Component-based styling with BEM methodology
- **Mobile Responsive**: Mobile-first design with adaptive quality
- **Festival-Specific**: Gallery system, lineup display, multilingual (CS/EN)

## Project Structure
```
UfoBufo-secondDecade/
├── js/                      # JavaScript files (legacy structure)
│   ├── front.js            # Optimized bundle (148KB) - loaded in header
│   ├── ostryweb.js         # Additional script (161B) - loaded in footer
│   └── src/                # JavaScript source files
│       ├── app.js          # Main entry point
│       ├── components/     # jQuery-based components (8 files)
│       │   ├── fractal.js           # Homepage lens animation
│       │   ├── gallerySwiper.js     # Gallery carousel with Swiper
│       │   ├── modal.js             # Modal with iziModal
│       │   ├── move-items.js        # Lineup date organization
│       │   ├── replace-dates.js     # Date localization
│       │   ├── responsiveMenu.js    # Mobile menu toggle
│       │   ├── toggle-lineup.js     # Lineup view switcher
│       │   ├── toggle-search.js     # Search form toggle
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

### JavaScript Libraries
- **jQuery 3.7.1** (via WordPress) - Core framework, loaded externally
- **Swiper 12.0.2** - Gallery carousel (bundled)
- **iziModal 1.6.1** - Image lightbox (bundled from vendor/)
- **GSAP 3.13.0** - Homepage lens/fractal animations (bundled)
- **BasicScroll 3.0.4** - Parallax effects (bundled)

**Library Loading Architecture:**
- **jQuery**: External dependency - uses WordPress-provided jQuery (not bundled)
- **Other libraries**: Bundled into front.js (148KB optimized)
- Single pre-compiled bundle approach
- Loaded via `<script>` tag in header.php
- Webpack externals configuration prevents jQuery from being bundled

### Removed Libraries (Oct 2025)
- ~~VideoJS~~ - Not used (homepage uses YouTube iframe embed)
- ~~Tooltipster~~ - Not used (location.php tooltips are commented out)
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
- **front.js** (148KB) - Optimized bundle with components and libraries
- Loaded in `<head>` via `<script>` tag in header.php
- Contains: All components, Swiper, iziModal, GSAP, BasicScroll
- Uses WordPress jQuery as external dependency (not bundled)
- 98% size reduction from original 7.2MB bundle

### Additional Scripts
- **ostryweb.js** (161B) - Additional utility script
- Loaded in footer via `<script>` tag in footer.php

### Distribution Library Files
During distribution build, external library files are copied to `dist/js/vendor/` for reference:
- jquery.min.js (85KB) - jQuery 3.7.1
- swiper.min.js (151KB) - Swiper 12.0.2
- izimodal.min.js (26KB) - iziModal 1.6.1
- gsap.min.js (71KB) - GSAP 3.13.0
- basicscroll.min.js (10KB) - BasicScroll 3.0.4

Additional CSS files in `dist/css/`:
- swiper.min.css (14KB) - Swiper styles
- izimodal.min.css (88KB) - iziModal styles

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
- front.js: 148KB (optimized bundle with components and libraries)
- ostryweb.js: 161B
- jQuery: 85KB (loaded from WordPress, not bundled)

**Bundled Libraries (inside front.js):**
- swiper: 151KB (v12.0.2)
- izimodal: 26KB (v1.6.1)
- gsap: 71KB (v3.13.0)
- basicscroll: 10KB (v3.0.4)

**Total JS Loaded:**
- All pages: ~233KB (front.js + WordPress jQuery + ostryweb.js)
- 98% reduction from original 7.2MB bundle

### CSS
- front.min.css: ~150KB (compressed)
- 2025.css: ~5KB

### Distribution Package
- Total theme: ~25MB (mostly images)
- PHP files: ~200KB
- JavaScript: ~148KB (front.js optimized bundle)
- CSS: ~155KB
- Fonts: ~140KB
- Images: ~23MB

## Recent Changes (October 2025)

### Bundle Optimization (October 3, 2025)
- ✅ Removed unused video.js import from modal.js (homepage uses YouTube iframe)
- ✅ Removed tooltipster component and imports (location.php tooltips commented out)
- ✅ Configured webpack to use WordPress jQuery as external dependency
- ✅ Updated webpack.config.modern.js to point to legacy JS structure
- ✅ Rebuilt front.js bundle: **7.2MB → 148KB (98% reduction)**
- ✅ Total JS loaded reduced from 7.2MB to ~233KB (including WordPress jQuery)
- ✅ Updated documentation to reflect optimized architecture

### Library Updates (October 3, 2025)
- ✅ Updated iziModal from 1.6.0 to 1.6.1
- ✅ Verified all other libraries are at latest versions:
  - jQuery 3.7.1
  - Swiper 12.0.2
  - GSAP 3.13.0
  - BasicScroll 3.0.4
- ✅ Changed distribution build to place libraries in `js/vendor/` instead of `js/libs/`
- ✅ Added jQuery to distribution vendor files
- ✅ Added Swiper CSS to distribution build

### JS Architecture Restoration
- ✅ Restored legacy jQuery-based JS architecture from backup
- ✅ Removed modern ES6 class-based architecture from /assets/js/
- ✅ Restored jQuery-based components from backup
- ✅ JS structure restored:
  - /js/front.js - compiled bundle (now optimized to 148KB)
  - /js/ostryweb.js - additional script
  - /js/src/app.js - main entry point
  - /js/src/components/ - 8 active component files
  - /js/src/vendor/iziModal.js
- ✅ Updated build configuration:
  - webpack.config.js - old webpack config pointing to /js/src/app.js
  - gulpfile.js - gulp tasks for build process
- ✅ Updated PHP files:
  - functions.php - removed webpack-assets.php include
  - header.php - added front.js script tag
  - footer.php - added ostryweb.js script tag
- ✅ Updated dist build to copy legacy files
- ✅ Distribution ready in /dist/ (now ~25MB after optimization)

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

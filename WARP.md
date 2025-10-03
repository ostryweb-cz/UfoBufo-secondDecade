# UFO BUFO WordPress Theme

## Overview
UFO BUFO is a modern, optimized WordPress theme for the UFO BUFO psychedelic music and art festival. The theme features a professional build system, clean architecture, and is optimized for performance with conditional asset loading.

## Key Features
- **Modular JavaScript Architecture**: jQuery-based component system with external libraries
- **Professional Build System**: Separate development and distribution workflows
- **Highly Optimized**: Theme code only 39.4KB, all libraries external
- **External Libraries**: All JS libraries loaded separately from /js/vendor/ (not bundled)
- **Clean Distribution**: Production-ready builds exclude source files and dev tools
- **SASS Architecture**: Component-based styling with BEM methodology
- **Mobile Responsive**: Mobile-first design with adaptive quality
- **Festival-Specific**: Gallery system, lineup display, multilingual (CS/EN)

## Project Structure
```
UfoBufo-secondDecade/
├── js/                      # JavaScript files
│   ├── front.js            # Theme code bundle (39.4KB) - loaded via WordPress
│   ├── ostryweb.js         # Additional script (137B) - loaded via WordPress
│   ├── vendor/             # External libraries (loaded separately)
│   │   ├── swiper.min.js   # Swiper 12.0.2 (150KB)
│   │   ├── gsap.min.js     # GSAP 3.13.0 (68KB)
│   │   ├── iziModal.min.js # iziModal 1.6.1 (25KB)
│   │   └── basicscroll.min.js # BasicScroll 3.0.4 (10KB)
│   └── src/                # JavaScript source files
│       ├── app.js          # Main entry point
│       ├── components/     # jQuery-based components (7 files)
│       │   ├── fractal.js           # Homepage lens animation (GSAP)
│       │   ├── gallerySwiper.js     # Gallery carousel with Swiper
│       │   ├── modal.js             # Modal with iziModal
│       │   ├── move-items.js        # Lineup date organization
│       │   ├── replace-dates.js     # Date localization
│       │   ├── responsiveMenu.js    # Mobile menu toggle
│       │   ├── toggle-lineup.js     # Lineup view switcher
│       │   ├── toggle-search.js     # Search form toggle
│       │   └── trim-items.js        # Text manipulation
│       └── vendor/
│           └── iziModal.js  # iziModal library source (for reference)
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
- **Swiper 12.0.2** - Gallery carousel with Navigation/Pagination modules
- **iziModal 1.6.1** - Image lightbox (jQuery plugin)
- **GSAP 3.13.0** - Homepage lens/fractal animations (v3.x API)
- **BasicScroll 3.0.4** - Parallax effects (available for future use)

**Library Loading Architecture:**
- **All libraries external** - No libraries bundled in front.js
- **Loaded via WordPress** - wp_enqueue_script() in functions.php
- **Loading order**: jQuery → Swiper → GSAP → iziModal → BasicScroll → front.js
- **front.js**: 39.4KB (theme code only, 81% reduction from 211KB)
- **Total JS**: 293KB (all files separate for better caching)

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
npm run build:dev    # Build development JS (human-readable)
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

The theme uses WordPress wp_enqueue_script() system:

### Main JavaScript Bundle
- **front.js** (39.4KB) - Optimized bundle with theme code only
- Loaded via wp_enqueue_script() in functions.php
- Contains: All components and theme logic
- Uses WordPress jQuery as external dependency
- 81% size reduction from bundled version

### Vendor Libraries (External)
All libraries loaded separately from /js/vendor/ via wp_enqueue_script():
- **swiper.min.js** (150KB) - Swiper 12.0.2
- **gsap.min.js** (68KB) - GSAP 3.13.0
- **iziModal.min.js** (25KB) - iziModal 1.6.1 (jQuery plugin)
- **basicscroll.min.js** (10KB) - BasicScroll 3.0.4

### Additional Scripts
- **ostryweb.js** (137B) - Additional utility script
- Loaded via wp_enqueue_script() in functions.php

### Loading Order
1. jQuery (WordPress)
2. Swiper
3. GSAP
4. iziModal
5. BasicScroll
6. front.js (theme code)

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
- front.js: 39.4KB (optimized theme code only)
- ostryweb.js: 137B
- jQuery: ~85KB (loaded from WordPress, not bundled)

**External Libraries (in /js/vendor/):**
- swiper.min.js: 150KB (v12.0.2)
- gsap.min.js: 68KB (v3.13.0)
- iziModal.min.js: 25KB (v1.6.1)
- basicscroll.min.js: 10KB (v3.0.4)

**Total JS Loaded:**
- All pages: ~293KB (all files separate for better caching)
- front.js is 81% smaller (39.4KB vs 211KB bundled version)
- 98% reduction from original 7.2MB bundle

### CSS
- front.min.css: ~150KB (compressed)
- 2025.css: ~5KB

### Distribution Package
- Total theme: ~22.5MB (mostly images)
- PHP files: ~144KB
- JavaScript: ~293KB (front.js + vendor libraries)
- CSS: ~123KB
- Fonts: ~141KB
- Images: ~23MB

## Recent Changes (October 2025)

### Library Externalization (October 3, 2025)
- ✅ **Externalized all JS libraries** - Moved from bundled to separate files in /js/vendor/
- ✅ **Reduced front.js**: 211KB → 39.4KB (81% reduction)
- ✅ **Total JS**: 293KB across 6 files (better caching)
- ✅ **Libraries now external**:
  - Swiper 12.0.2 (150KB)
  - GSAP 3.13.0 (68KB)
  - iziModal 1.6.1 (25KB)
  - BasicScroll 3.0.4 (10KB)

### JavaScript Fixes (October 3, 2025)
- ✅ Fixed jQuery loading order in WordPress (wp_enqueue_script)
- ✅ Fixed iziModal initialization check for missing elements
- ✅ Updated GSAP to v3.x API (gsap.to, window.gsap)
- ✅ Fixed Swiper gallery with Navigation and Pagination modules
- ✅ Fixed GSAP parallax to only run on homepage
- ✅ Removed all library imports (now loaded as globals)

### UI/UX Improvements (October 3, 2025)
- ✅ Updated Swiper button styles: white background default
- ✅ Rotated prev button icon 180 degrees
- ✅ Compiled SASS with updated styles
- ✅ Updated functions.php to load libraries in correct order

### Build System Cleanup (October 3, 2025)
- ✅ Simplified webpack configs (removed webpack.config.modern.js)
- ✅ Renamed to webpack.config.js (main) and webpack.config.dist.js
- ✅ Cleaned up package.json scripts
- ✅ Updated bundlesize config
- ✅ Removed unused documentation files

### Documentation
- ✅ Updated WARP.md to reflect current architecture
- ✅ Removed old README.md, DEPLOY.md, FIXES_APPLIED.md, WEBPACK-ANALYSIS.md

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

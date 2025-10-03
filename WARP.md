# UFO BUFO WordPress Theme

## Overview
UFO BUFO is a modern, optimized WordPress theme for the UFO BUFO psychedelic music and art festival. The theme features a professional build system, clean architecture, and is optimized for performance with conditional asset loading.

## Key Features
- **Modern JavaScript Architecture**: Modular ES6+ component system with lazy loading
- **Professional Build System**: Separate development and distribution workflows
- **Optimized Asset Loading**: Conditional script loading based on page content (321KB total JS)
- **Clean Distribution**: Production-ready builds exclude source files and dev tools
- **SASS Architecture**: Component-based styling with BEM methodology
- **Performance Focused**: Code splitting, preload hints, lazy loading
- **Mobile Responsive**: Mobile-first design with adaptive quality
- **Festival-Specific**: Gallery system, lineup display, multilingual (CS/EN)

## Project Structure
```
UfoBufo-secondDecade/
├── assets/                   # Source files (development only)
│   └── js/                  # JavaScript source files
│       ├── components/      # UI and animation components
│       │   ├── ui/         # Menu, Search, Gallery, Navigation
│       │   └── animation/  # Parallax, Fractal
│       ├── core/           # App, ComponentLoader, EventBus, BaseComponent
│       ├── utils/          # Utils, Performance
│       ├── config.js       # Application configuration
│       └── main.js         # Entry point
│
├── css/                     # Compiled CSS and SASS sources
│   ├── sass/               # SASS source files (development)
│   ├── front.min.css       # Main compiled stylesheet
│   └── 2025.css            # Year-specific styles
│
├── js/                      # Compiled JavaScript bundles (generated)
│   ├── app.js              # Core application bundle (~1MB)
│   └── libs/               # External libraries (not bundled)
│       ├── swiper.min.js   # Gallery carousel (151KB)
│       ├── izimodal.min.js # Image lightbox (26KB)
│       ├── gsap.min.js     # Homepage animations (71KB)
│       └── basicscroll.min.js # Parallax effects (10KB)
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
- **JavaScript**: ES6+ modules, Webpack 5, Babel
- **CSS**: SASS with BEM methodology
- **Build System**: Webpack with separate dev/dist configs

### JavaScript Libraries (Active)
- **Swiper 12.0.2** (151KB) - Gallery carousel
- **iziModal 1.6.0** (26KB) - Image lightbox
- **GSAP 3.13.0** (71KB) - Homepage animations (conditional)
- **BasicScroll 3.0.4** (10KB) - Parallax effects
- **jQuery** (via WordPress) - Used for compatibility

**Library Loading Architecture:**
- Libraries are **NOT bundled** with app.js
- Copied from node_modules to `js/libs/` during distribution build
- Loaded separately by PHP (`inc/webpack-assets.php`)
- Accessed via global objects (`window.Swiper`, `window.gsap`, etc.)
- Allows conditional loading and better caching

### Removed Libraries (Oct 2025)
- ~~VideoJS~~ (684KB) - Commented out code removed
- ~~Tooltipster~~ (56KB) - Commented out code removed
- ~~Moment.js~~ - Not used
- ~~svg4everybody~~ - Not needed

### Build Tools
- Webpack 5 with code splitting
- Babel for browser compatibility
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
npm run dev          # Watch and rebuild automatically
npm run build        # Build production JS to /js/
npm run build:dev    # Build development JS
npm run clean        # Remove generated JS files
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
- Commit only source files (assets/js, css/sass, *.php)
- Never commit compiled assets (js/*.js, css/*.css)
- Never commit node_modules/ or dist/
- Use .gitignore properly

## Asset Loading Strategy

The theme uses intelligent asset loading via `inc/webpack-assets.php`:

### Core Application Bundle
- **app.js** (~1MB) - Main application logic
- Loaded in `<head>` with preload hint
- Contains: ComponentLoader, EventBus, all UI/animation components, core utilities
- Single bundle approach for simplicity (no code splitting)

### External Libraries (Loaded Separately)
Libraries are **NOT included in app.js** but loaded as separate files:

1. **Swiper** (151KB) - Gallery carousel
   - Location: `js/libs/swiper.min.js`
   - Loaded: Always (used on multiple pages)
   - Global: `window.Swiper`

2. **iziModal** (26KB) - Image lightbox
   - Location: `js/libs/izimodal.min.js`
   - Loaded: Always (with gallery)
   - Global: `window.jQuery.fn.iziModal`

3. **GSAP** (71KB) - Homepage animations
   - Location: `js/libs/gsap.min.js`
   - Loaded: **Conditionally** - only on homepage (`is_front_page()`)
   - Global: `window.gsap`

4. **BasicScroll** (10KB) - Parallax effects
   - Location: `js/libs/basicscroll.min.js`
   - Loaded: Always (small, widely used)
   - Global: `window.basicScroll`

### Loading Optimization
- **Preload**: Core app bundle (critical path)
- **Prefetch**: Library hints for faster loading
- **Footer Loading**: All libraries load in footer (non-blocking)
- **Conditional**: GSAP only loads on homepage
- **Separate Files**: Libraries cached independently from app code
- **No Bundling**: Keeps app.js from growing with library updates

### Performance Monitoring
- Debug mode shows loaded chunks in console
- Performance reports in development mode
- Automatic optimization for poor performance

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
- JavaScript source files (assets/js/)
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
- app.js: ~1MB (includes all components and utilities)

**External Libraries (Total: ~258KB, not bundled):**
- swiper.min.js: 151KB
- izimodal.min.js: 26KB
- gsap.min.js: 71KB (homepage only)
- basicscroll.min.js: 10KB

**Total JS Loaded:**
- Homepage: ~1.3MB (app + all libs)
- Other pages: ~1.2MB (app + libs except GSAP)

### CSS
- front.min.css: ~150KB (compressed)
- 2025.css: ~5KB

### Distribution Package
- Total theme: ~27MB (mostly images)
- PHP files: ~200KB
- JavaScript: ~1.5MB (app.js + libraries)
- CSS: ~220KB
- Fonts: ~140KB
- Images: ~23MB

## Recent Changes (October 2025)

### Code Cleanup
- ✅ Removed 23 unused PHP template files
- ✅ Removed 2 unused JavaScript source files (FormHandler, performance-test)
- ✅ Removed 335 lines of commented-out code
- ✅ Removed VideoJS library (684KB) - unused
- ✅ Removed Tooltipster library (56KB) - unused
- ✅ Updated ComponentLoader to remove missing components (Toggle, Tooltips, HomepageAnimations)
- ✅ Total savings: ~968KB JavaScript + source maps

### Structure Improvements
- ✅ Created professional build system with separate dev/dist configs
- ✅ Separated development and distribution workflows
- ✅ Added .gitignore for proper version control
- ✅ Created comprehensive documentation (README, DEPLOY, WARP)
- ✅ Improved asset loading strategy with library separation
- ✅ Updated package.json dependencies

### Library Loading Architecture (Latest)
- ✅ Libraries extracted from webpack bundle
- ✅ Moved to separate files in `js/libs/`
- ✅ PHP handles library enqueueing with proper dependencies
- ✅ JavaScript components access via global objects
- ✅ Removed dynamic script loading from Gallery.js
- ✅ Updated webpack configs to exclude library bundling
- ✅ Added output configuration to webpack.config.modern.js
- ✅ Benefits: smaller bundle, better caching, conditional loading

### Documentation Added
- README.md - Development guide
- DEPLOY.md - Deployment procedures
- This WARP.md - Updated technical overview

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
- **assets/js/WARP.md** - JavaScript architecture and components  
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

- JavaScript source: `assets/js/`
- Compiled JS: `js/`
- SASS source: `css/sass/`
- Compiled CSS: `css/`
- Templates: `*.php` and `template-parts/`
- Distribution: `dist/UfoBufo-secondDecade/`

---

**Last Updated**: October 2025  
**Theme Version**: 1.0.1  
**WordPress Version**: 5.9+

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
│       ├── components/     # jQuery-based components (9 files)
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
│   ├── 2025.css            # Year-specific styles (2025)
│   └── 2026.css            # Year-specific styles (2026)
│
├── template-parts/          # PHP template partials
│   ├── boxes/              # Content box components
│   ├── stages/             # Festival stage templates
│   └── *.php               # Other template parts
│
├── inc/                     # PHP includes and helpers
│   └── customizer.php      # WordPress customizer
│
├── fonts/                   # Web fonts
├── img/                     # Theme images and assets
│   ├── 2024/               # 2024 stage images
│   ├── 2026/               # 2026 stage images
│   └── ufobufo-festival-logo-2026.svg  # 2026 festival logo
├── languages/               # Translation files (CS/EN)
│
├── dist/                    # Distribution builds (generated)
│   └── UfoBufo-secondDecade/ # Clean WordPress theme
│
├── *.php                    # WordPress template files
├── functions.php            # Main theme functionality
├── tickets.php              # Tickets page template (legacy)
├── tickets-2026.php         # Tickets page template (Customizer-driven)
├── style.css                # Theme metadata
├── package.json             # Build configuration
├── webpack.config.*.js      # Webpack configurations
└── .gitignore               # Version control rules
```

## Technical Stack

### Core
- **WordPress**: 5.9+
- **WooCommerce**: Theme-compatible templates included (`woocommerce.php`, `archive-product.php`, `single-product.php`)
- **Polylang**
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

### Build Tools
- Webpack 5 (legacy config) for JS bundling
- Babel for ES6+ transpilation
- Gulp for task automation
- SASS compiler for CSS
- Copy Webpack Plugin for distribution

## Development Workflow

### Festival Settings (Customizer)
- Homepage festival header (welcome text, main text, name, date range, location) and stage edition label are configured in **Appearance → Customize → Festival Settings**.
- Festival lifecycle is controlled by the **Festival Phase** select (Phase 1–4) which drives lineup behaviour and stage subtexts.
- **Programme shows year** (Customizer): controls which lineup year is shown by default on the Program page. This can be set to the current year or a **future** edition (e.g. 2026); internally, the theme auto-generates allowed lineup years from 2013 up to the higher of the current calendar year and this setting, skipping non-festival years (2020, 2021, 2023).
- Program page also supports a `lineup_year` query parameter (e.g. `?lineup_year=2018`) to view specific old editions.
- Legacy ACF fields on the Homepage template are still read as fallback when no Customizer values are set.
- **Meta descriptions & og:image** (Customizer):
  - `Meta popis stránky (CS/EN)` - Meta descriptions for pages (cca 155 characters each) used in both `<meta name="description">` and `<meta property="og:description">` tags
  - `Obrázek pro sociální sítě (og:image)` - Image upload for social sharing (recommended 1200x630px), used in og:image tags with fallback to legacy `/img/og-img.jpg`

### Tickets & Pricing (Customizer)
- Tickets page behaviour is controlled in **Appearance → Customize → Tickets & Pricing**.
- The Customizer-driven tickets UI is implemented in the page template: `tickets-2026.php` (**Template Name: Tickets 2026**).
- `tickets.php` (**Template Name: Tickets**) is a legacy, hard-coded tickets template.
- **Tickets Phase** select:
  - Phase 1: "Tickets not available yet" – only intro text is shown, no price table.
  - Phase 2: "Presale – ticket waves table" – presale waves and legend are shown.
  - Phase 3: "Presale sold out – gate only" – same table structure, but intro text explains presale sold out / gate-only sales.
- **Intro texts per phase**: `Phase 1/2/3 Intro (CS/EN)` control the paragraphs at the top of the Tickets page for Czech and English mutations.
- **Fixed waves**: Early Bird, 1st wave, 2nd wave, Christmas gift ticket, 3rd wave, Final wave:
  - Each wave has a "show row" checkbox and a **state**: Upcoming, On sale, Sold out.
  - CZK prices (full and shorter tickets) are configured per wave for the Czech mutation.
  - EUR prices (full and shorter tickets) are shared for both mutations.
  - Optional BookTickets URLs per wave and language control the "Buy" button when state is set to **On sale**.
- **Camping & parking legend**:
  - "Parking text (CS/EN)" is injected under the `**** 🅿️ PARKING:` legend line and supports basic HTML.
  - "Camping text (CS/EN)" is injected below the "STANOVÁNÍ V KEMPU" / "TENT CAMPING" lines for each language.

### Program Page Lineup & Stage Images
- Program template: `category-template.php` includes all stage templates from `template-parts/stages/`.
- The visible lineup year is resolved by `ufobufo_get_requested_lineup_year()` using this priority:
  1. `lineup_year` query parameter (if present and allowed)
  2. Customizer setting **Programme shows year**
  3. Newest allowed year from `ufobufo_get_lineup_years()`.
- Stage list subtext under the "stage-style" line is computed by `ufobufo_get_stage_list_subtext()`:
  - Phase 1 & 2: shows `[festival name] [newest year]`.
  - Phase 3: shows localized "More artists TBA" / "Další vystupující později".
  - Phase 4: no subtext.
  - When a specific `lineup_year` is requested and it is **older than the newest year**, subtext always behaves like Phase 1/2 and shows `[festival name] [requested year]` regardless of current phase.
- Stage images per edition are handled by `ufobufo_get_stage_image_html( $stage_key, $year )` in `functions.php`:
  - `$stage_key` values correspond to stage templates: `main`, `groovy`, `chill`, `tribal`.
  - Images are configured via **featured images** on posts tagged with `stage-{stage_key}-{year}` (e.g. `stage-main-2025`).
  - When viewing edition *N*, the helper walks **backwards** through earlier lineup years and uses the most recent previous edition that has an image (e.g. 2026 edition will use `stage-main-2025`; if missing, it will fall back to older years).
  - If no previous edition has a tagged image, no stage image is rendered.

### Initial Setup
```bash
cd ~/projects/UfoBufo-secondDecade
npm install
npm run build
```

### Development Commands
```bash
npm run dev          # Watch and rebuild automatically (webpack)
npm run build        # Build production JS and auto-update version
npm run build:dev    # Build development JS and auto-update version
```

**Version Management:** Build commands automatically update `style.css` version using dmY format (e.g., 28012026). Multiple builds on the same day increment a suffix (28012026.1, 28012026.2, etc.). This is handled by `update-version.js` which runs before webpack.

### Distribution Commands
```bash
npm run dist         # Build complete WordPress theme to /dist/
npm run dist:clean   # Remove /dist/ folder
npm run deploy       # Build and show deployment message
```

**Note:** `npm run dist:package` creates a `.tar.gz` archive; do not use it in this workflow.

### CSS Compilation
```bash
npm run css:build
```

`npm run dist` also runs this automatically before assembling `dist/UfoBufo-secondDecade/`.

**SASS architecture note:** The SASS sources use the modern module system (`@use`/`@forward`) instead of deprecated `@import`. Shared variables + mixins are exposed via `css/sass/core/globals.sass`.

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
- Development files (.gitignore)
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

## Deployment Process

### Local/Staging Deployment
```bash
npm run dist
cp -r dist/UfoBufo-secondDecade /path/to/wordpress/wp-content/themes/
```

### Production Server Deployment
```bash
npm run dist
# Upload/copy: dist/UfoBufo-secondDecade/ to the server and place into /wp-content/themes/
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

## Recent Changes (February 2026)

### Cleaned Up Unused WordPress Image Sizes (February 9, 2026)
- ✅ **Removed all custom image sizes** - Deleted `gallery-thumb` (280x190), `card-thumb-2x` (660x500), `card-thumb` (330x250), and `gallery-big` (1400x939)
- ✅ **Removed index.php** - Deleted unused fallback template that only referenced `card-thumb` size
- ✅ **Using WordPress defaults only** - All image display now uses `'medium'` size (300x300 by default)
- ✅ **Stage images use medium** - Replaced `gallery-big` with `'medium'` size in `ufobufo_get_stage_image_html()` function

### Gallery Layout Refinement & Admin Improvements (February 9, 2026)
- ✅ **Fixed image zoom behavior** - Default no zoom (scale 1), hover zoom to 1.02
- ✅ **Reversed hover border effect** - Border frame shows on hover only with proper styling
- ✅ **Removed fixed image heights** - Images display at natural full height without cropping
- ✅ **Improved image flexibility** - Uses flexbox container for proper alignment and sizing
- ✅ **Enhanced SEO** - Added alt text (from post title) and title attributes to all images
- ✅ **Admin thumbnail column** - Added thumbnail preview column to WP posts list (80x80px)
- ✅ **Simplified box markup** - Removed `.Img` wrapper while keeping CSS styles

### Gallery Masonry Layout (February 8, 2026)
- ✅ **Converted gallery to true masonry** - Switched from CSS columns to CSS Grid with `grid-auto-flow: dense`
- ✅ **Zero gaps between images** - Set `gap: 0` and fixed `grid-auto-rows: 200px`
- ✅ **Image cropping** - Applied `object-fit: cover` to fill grid cells uniformly
- ✅ **Responsive grid** - Uses `repeat(auto-fill, minmax(200px, 1fr))` for automatic column adjustments
- ✅ **Intelligent gap-filling** - CSS Grid's dense packing algorithm fills gaps when images have different aspect ratios
- ✅ **Removed legacy CSS columns** - Eliminated old column-based layout and media queries

### Meta Tags Moved to Customizer (February 5, 2026)
- ✅ **Moved meta descriptions** - Hardcoded text in header.php now moved to customizer settings
- ✅ **Added og:image customizer field** - Image upload control for social sharing (with fallback to legacy image)
- ✅ **Language-aware meta tags** - Both Czech and English variants now configurable via customizer
- ✅ **Removed unused file** - Deleted `inc/webpack-assets.php` (was not being used)
- ✅ **Updated header.php** - Now uses customizer values with automatic language detection via Polylang

### 2026 Festival Assets (February 2, 2026)
- ✅ **Added 2026 assets** - New stage images in `img/2026/` directory
- ✅ **Added festival logo** - 2026 UFO BUFO logo (SVG format)
- ✅ **Updated parallax images** - New parallax backgrounds for 2026 edition
- ✅ **Updated stage images** - New imagery for all stages (main, groovy, chill, tribal)
- ✅ **Added 2026 CSS** - Year-specific styling file `css/2026.css`
- ✅ **Updated header and homepage** - Modified for 2026 edition
- ✅ **Updated theme screenshot** - Reflects 2026 design

### Assets Added
- `img/2026/WEB_A_pozadi.jpg` - Background image
- `img/2026/WEB_B_5meo_ring.png` - Stage visual element
- `img/2026/WEB_C_radiowaves.png` - Stage visual element
- `img/2026/WEB_D_shaman.png` - Stage visual element
- `img/2026/WEB_E_synth.png` - Stage visual element
- `img/2026/WEB_F_synth.png` - Stage visual element
- `img/2026/WEB_G_flares.png` - Stage visual element
- `img/ufobufo-festival-logo-2026.svg` - Festival logo

## Previous Changes (October 2025)

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


### File Locations

- JavaScript source: `js/src/`
- Compiled JS: `js/`
- SASS source: `css/sass/`
- Compiled CSS: `css/`
- Templates: `*.php` and `template-parts/`
- Distribution: `dist/UfoBufo-secondDecade/`

---

**Last Updated**: February 2026  
**Theme Version**: 1.0.4  
**WordPress Version**: 5.9+

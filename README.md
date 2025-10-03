# UFO BUFO WordPress Theme

Modern, optimized WordPress theme for the UFO BUFO psychedelic festival website.

## 🏗️ Project Structure

```
UfoBufo-secondDecade/
├── assets/                 # Source files for development
│   └── js/                # JavaScript source files
│       ├── components/    # UI and animation components
│       ├── core/         # Core application logic
│       ├── utils/        # Utility functions
│       ├── config.js     # Configuration
│       └── main.js       # Entry point
│
├── css/                   # Styles
│   ├── sass/             # SASS source files (development)
│   └── *.css             # Compiled CSS (generated)
│
├── js/                    # Compiled JavaScript (generated)
│   └── *.js              # Webpack bundles
│
├── template-parts/        # PHP template partials
│   ├── boxes/            # Box/card components
│   └── stages/           # Festival stage templates
│
├── inc/                   # PHP includes
│   ├── customizer.php    # WordPress customizer
│   └── webpack-assets.php # Asset loading
│
├── fonts/                 # Web fonts
├── img/                   # Images and icons
├── languages/             # Translation files
│
├── dist/                  # Distribution build (generated)
│   └── UfoBufo-secondDecade/ # Ready for WordPress
│
├── *.php                  # WordPress template files
├── style.css             # Theme metadata
├── functions.php         # Theme functions
├── package.json          # NPM dependencies
├── webpack.config.*.js   # Build configurations
└── .gitignore            # Git ignore rules
```

## 🚀 Getting Started

### Prerequisites

- Node.js >= 14.0.0
- NPM >= 6.0.0
- WordPress installation (for testing)

### Installation

1. **Clone the repository**
   ```bash
   cd ~/projects
   git clone <repository-url> UfoBufo-secondDecade
   cd UfoBufo-secondDecade
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Build JavaScript assets**
   ```bash
   npm run build
   ```

## 📦 Development Workflow

### Development Mode

Work directly in this directory and build assets as needed:

```bash
# Watch for changes and rebuild automatically
npm run dev

# Or build once
npm run build:dev
```

### Building for Production

Build optimized assets for the current directory:

```bash
npm run build
```

### Creating Distribution Package

Build a clean, production-ready WordPress theme:

```bash
# Build distribution in /dist/ folder
npm run dist

# Or create a .tar.gz package
npm run dist:package

# Or build and show deployment message
npm run deploy
```

The distribution build creates a complete WordPress theme in `dist/UfoBufo-secondDecade/` with:
- ✅ All PHP templates
- ✅ Optimized JavaScript bundles
- ✅ Compiled CSS
- ✅ Fonts and images
- ✅ Theme metadata
- ❌ No source files (assets/js source, sass files)
- ❌ No development files (node_modules, configs)

## 📋 Available NPM Scripts

| Script | Description |
|--------|-------------|
| `npm run build` | Build production JavaScript to /js/ |
| `npm run build:dev` | Build development JavaScript |
| `npm run dev` | Watch and rebuild on changes |
| `npm run clean` | Remove generated JS files |
| `npm run dist` | Build complete WordPress theme for distribution |
| `npm run dist:clean` | Remove /dist/ folder |
| `npm run dist:package` | Create .tar.gz archive of theme |
| `npm run deploy` | Build and show deployment instructions |

## 🎨 Theme Development

### JavaScript Components

Located in `assets/js/components/`:

**UI Components:**
- `Menu.js` - Mobile/desktop menu
- `Search.js` - Search functionality
- `Gallery.js` - Image gallery with Swiper
- `Navigation.js` - Navigation helpers

**Animation Components:**
- `Parallax.js` - Scroll-based parallax effects
- `Fractal.js` - Mouse-based fractal animations

### Adding New Components

1. Create component in `assets/js/components/`
2. Register in `core/ComponentLoader.js`
3. Add detection logic in `core/App.js`
4. Rebuild with `npm run build`

### CSS/SASS

SASS files are located in `css/sass/`. To recompile:
```bash
sass css/sass/front.sass css/front.min.css --style=compressed
```

## 🚢 Deployment

### Option 1: Copy Dist Folder

```bash
npm run dist
cp -r dist/UfoBufo-secondDecade /path/to/wordpress/wp-content/themes/
```

### Option 2: Create Package

```bash
npm run dist:package
# Upload dist/UfoBufo-secondDecade-YYYYMMDD.tar.gz to server
```

### Option 3: Direct Development (Not Recommended)

You can develop directly in WordPress themes folder, but:
- Keep backup of node_modules elsewhere
- Run builds from project directory
- Don't commit node_modules to WordPress

## 🗂️ Files Included in Distribution

**PHP Files:**
- All root-level .php template files
- template-parts/ directory
- inc/ directory with helpers

**Assets:**
- js/ - Compiled JavaScript bundles
- css/ - Compiled stylesheets
- fonts/ - Web fonts
- img/ - Images and icons

**Metadata:**
- style.css - Theme information
- screenshot.png - Theme preview
- THEME_DOCS.md - Documentation

**NOT Included:**
- assets/js source files
- css/sass source files
- node_modules/
- package.json
- webpack configs
- .git/

## 🔧 Configuration

### Theme Version

Update version in:
1. `inc/webpack-assets.php` - `$theme_version`
2. `style.css` - Version header
3. `webpack.config.*.js` - Output filenames

### JavaScript Libraries

Active libraries (in package.json):
- **Swiper** (145KB) - Gallery carousel
- **iziModal** (60KB) - Modal/lightbox  
- **GSAP** (69KB) - Homepage animations
- **BasicScroll** (10KB) - Parallax effects
- **jQuery** (via WordPress)

**Library Loading Architecture:**
- Libraries are **NOT bundled** with the main app.js
- They are copied from node_modules to `js/libs/` during distribution build
- PHP (`inc/webpack-assets.php`) loads them separately with proper dependencies
- JavaScript components access them via global objects (`window.Swiper`, `window.gsap`, etc.)
- This approach reduces bundle size and allows conditional loading (e.g., GSAP only on homepage)

## 🐛 Troubleshooting

### JavaScript not loading
```bash
npm run clean
npm run build
```

### Distribution build fails
```bash
npm run dist:clean
npm install
npm run dist
```

### CSS changes not appearing
Rebuild CSS from SASS:
```bash
sass css/sass/front.sass css/front.min.css --style=compressed
```

## 📝 Notes

- The theme uses WordPress's built-in jQuery (not bundled)
- JavaScript is loaded conditionally based on page content
- Source maps are generated for debugging
- GSAP only loads on homepage
- All compiled assets are gitignored

## 🤝 Contributing

1. Make changes in source files (assets/js, css/sass, *.php)
2. Test with `npm run dev`
3. Build production: `npm run build`
4. Test distribution: `npm run dist`
5. Commit only source files (not compiled assets)

## 📄 License

Copyright © UFO BUFO Festival

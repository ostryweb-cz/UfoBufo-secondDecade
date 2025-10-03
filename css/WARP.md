# CSS/SASS Architecture - UFO BUFO Theme

## Overview
The UFO BUFO theme uses a modular SASS architecture with component-based styling. The build system compiles SASS files into optimized CSS with proper vendor prefixing and minification.

## File Structure
```
css/
├── front.min.css              # Compiled main stylesheet
├── front.min.css.map          # Source map for development
├── 2024.css                   # Legacy year-specific styles
├── 2025.css                   # Current year-specific styles
└── sass/                      # SASS source files
    ├── front.sass             # Main SASS entry point
    ├── core/                  # Core styling foundation
    ├── components/            # UI components
    └── vendor/                # Third-party library styles
```

## SASS Architecture

### Core Foundation (`sass/core/`)
- `variables.sass` - Global variables (colors, breakpoints, spacing)
- `mixins.sass` - Reusable SASS mixins and functions
- `reset.sass` - CSS reset and normalization
- `typography.sass` - Font definitions and text styling
- `grid.sass` - Layout grid system
- `helpers.sass` - Utility classes
- `icons.sass` - Icon fonts and SVG styling

### Component System (`sass/components/`)
- `header.sass` - Site header and navigation
- `footer.sass` - Site footer styling
- `buttons.sass` - Button variations and states
- `modal.sass` - Modal dialog styling
- `loader.sass` - Loading animations
- `search.sass` - Search functionality styling
- `gallery.sass` - Image gallery components
- `ticket.sass` - Ticket booking interface
- `lineup.sass` - Festival lineup display
- `plan.sass` - Site plan and schedule
- `boxes.sass` - Content boxes and cards
- `breadcrumbs.sass` - Navigation breadcrumbs
- `mosaic.sass` - Mosaic layouts
- `video-bg.sass` - Video background components
- `swiper.sass` - Swiper carousel styling
- `front-paralax.sass` - Parallax effects
- `detail.sass` - Detail page layouts

### Vendor Styles (`sass/vendor/`)
- `swiper-vendor.sass` - Swiper.js customizations
- `modal.sass` - Modal library styling
- `tooltipster.sass` - Tooltip styling
- `video.sass` - Video.js player styling

## Styling Methodology

### BEM-like Approach
Components follow a modified BEM (Block Element Modifier) methodology:
```sass
.component
  // Block styles

  &__element
    // Element styles

  &--modifier
    // Modifier styles
```

### Mobile-First Responsive Design
All components are designed mobile-first with progressive enhancement:
```sass
.component
  // Mobile styles (base)

  @media (min-width: $tablet)
    // Tablet styles

  @media (min-width: $desktop)
    // Desktop styles
```

### Component Architecture
Each component is self-contained with:
- Base styling
- Responsive behavior
- State variations
- Interaction styles

## Key Features

### Design System Variables
- **Colors**: Festival-themed color palette
- **Typography**: Responsive type scale
- **Spacing**: Consistent spacing units
- **Breakpoints**: Mobile-first breakpoint system

### Performance Optimizations
- CSS minification and compression
- Autoprefixer for browser compatibility
- Source maps for development debugging
- Critical CSS inlining (for above-fold content)

### Mobile-First Guidelines
- The submenu should always be shown on mobile devices
- Touch-friendly interface elements
- Optimized for small screens first
- Progressive enhancement for larger screens

## Build Process
1. SASS compilation with node-sass
2. Autoprefixer for vendor prefixes
3. CSS minification
4. Source map generation
5. File versioning for cache busting

## Browser Compatibility
- Modern browsers (> 1%, last 2 versions)
- Graceful degradation for older browsers
- CSS Grid with Flexbox fallbacks
- Progressive enhancement approach

## Development Guidelines
- Use SASS variables for all values
- Follow component-based organization
- Maintain consistent naming conventions
- Optimize for performance
- Test responsive behavior across devices

## Year-Specific Styles
- `2024.css` - Previous year branding and features
- `2025.css` - Current year theme and updates
- Conditional loading based on admin preferences
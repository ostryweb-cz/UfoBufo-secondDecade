# PHP Theme Structure - UFO BUFO WordPress Theme

## Overview
The UFO BUFO theme follows WordPress best practices with modular PHP architecture. The `/inc/` directory contains core theme functionality separated from template files for better organization and maintainability.

## File Structure
```
inc/
├── webpack-assets.php         # Asset loading optimization
├── customizer.php            # WordPress Customizer settings
├── template-tags.php         # Custom template functions
└── back-compat.php          # Backward compatibility
```

## Core PHP Files

### Main Functions (`functions.php`)
Central theme functionality:
- Theme setup and configuration
- WordPress feature support
- Custom post types and fields
- Enqueue scripts and styles
- Custom functions and filters

### Asset Management (`webpack-assets.php`)
Advanced asset loading system:
- **Optimized Loading**: Conditional script loading
- **Performance**: Preload/prefetch hints
- **Version Management**: Automatic file versioning
- **Debug Support**: Development monitoring

```php
class UfoBufo_Webpack_Assets {
    // Singleton pattern for asset management
    // Smart file detection with version hashing
    // Conditional loading based on page content
}
```

### WordPress Customizer (`customizer.php`)
Theme customization interface:
- Custom theme options
- Live preview functionality
- Settings API integration
- Sanitization and validation

### Template Functions (`template-tags.php`)
Reusable template functions:
- Navigation helpers
- Content formatting
- Meta data display
- Social sharing functions

### Compatibility (`back-compat.php`)
Backward compatibility handling:
- WordPress version checks
- PHP version requirements
- Feature fallbacks

## WordPress Template Hierarchy

### Main Templates
- `index.php` - Default template
- `home.php` - Blog homepage (if exists)
- `front-page.php` - Static front page (if exists)
- `single.php` - Single post template
- `page.php` - Single page template
- `archive.php` - Archive template
- `category.php` - Category archive
- `tag.php` - Tag archive
- `search.php` - Search results
- `404.php` - Not found page

### Template Parts
- `header.php` - Site header
- `footer.php` - Site footer
- `sidebar.php` - Sidebar content
- `entry.php` - Post/page entry
- `entry-meta.php` - Post metadata
- `entry-content.php` - Post content
- `entry-footer.php` - Post footer
- `nav-below.php` - Post navigation
- `comments.php` - Comments template

### Special Templates
- `gallery.php` - Gallery display
- `tickets.php` - Ticket booking
- `category-template.php` - Category-specific layout

## WordPress Features Support

### Theme Features
```php
add_theme_support('title-tag');           // Document title
add_theme_support('post-thumbnails');     // Featured images
add_theme_support('automatic-feed-links'); // RSS feeds
add_theme_support('html5', [              // HTML5 markup
    'search-form', 'comment-form', 'gallery', 'caption'
]);
```

### Custom Image Sizes
```php
add_image_size('gallery-big', 1400, 939, true);    // Large gallery
add_image_size('gallery-thumb', 280, 190, true);   // Gallery thumbnails
add_image_size('card-thumb', 330, 250, true);      // Card images
add_image_size('card-thumb-2x', 660, 500, true);   // Retina cards
```

### Navigation Menus
```php
register_nav_menus([
    'main-menu' => __('Main Menu', 'ufobufo')
]);
```

## Custom Functions

### Title Optimization
Advanced title generation:
- SEO-optimized titles
- Category hierarchies
- Dynamic title construction
- Social media optimization

### Search Enhancement
```php
function search_excerpt_highlight() {
    // Highlights search terms in results
    // Escapes output for security
    // Supports multiple search terms
}
```

### Performance Optimizations
- Removed unnecessary WordPress headers
- Optimized query performance
- Conditional asset loading
- Caching-friendly functions

## Security Features
- Input sanitization
- Output escaping
- Nonce verification
- SQL injection prevention
- XSS protection

## Localization Support
- Text domain: `ufobufo`
- Translation-ready strings
- RTL language support
- WordPress translation functions

## Custom Post Types & Fields
The theme supports:
- Standard WordPress posts and pages
- Custom fields through ACF (if installed)
- Featured images and galleries
- Custom taxonomies for events

## Database Optimization
- Efficient database queries
- Proper use of WordPress APIs
- Caching integration
- Query optimization

## Development Guidelines

### Coding Standards
- Follow WordPress Coding Standards
- Use proper sanitization and escaping
- Implement proper error handling
- Document functions with DocBlocks

### Performance Best Practices
- Use WordPress transients for caching
- Optimize database queries
- Minimize HTTP requests
- Implement lazy loading

### Security Best Practices
- Validate all inputs
- Escape all outputs
- Use WordPress nonces
- Check user capabilities

## WordPress Integration Features

### Admin Integration
- Custom admin styles
- Dashboard widgets (if implemented)
- User role management
- Plugin compatibility

### Frontend Features
- Responsive design
- Accessibility compliance
- SEO optimization
- Performance optimization

### Third-Party Integration
- Google Analytics tracking
- Facebook Pixel integration
- Social media APIs
- Payment gateways (for tickets)

## Deployment Considerations
- Environment-specific configurations
- Database migrations
- Asset optimization
- Caching strategies

## Maintenance
- Regular WordPress updates
- Plugin compatibility checks
- Security monitoring
- Performance optimization

## Debug and Logging
- WP_DEBUG integration
- Error logging
- Performance monitoring
- Asset loading debug info
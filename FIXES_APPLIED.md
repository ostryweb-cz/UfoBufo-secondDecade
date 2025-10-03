# Fixes Applied to UfoBufo-secondDecade

Date: 2025-10-03

## Issues Fixed

### 1. App.js - EventBus emit errors
**Error:** `Uncaught TypeError: this.emit is not a function`

**Root Cause:** The `App` class was calling `this.emit()` directly, but it doesn't have an `emit` method. The class has an `eventBus` property that provides the `emit` method.

**Fixed Lines:**
- Line 196: `this.emit()` → `this.eventBus.emit()`
- Line 232: `this.emit()` → `this.eventBus.emit()`
- Line 253: `this.emit()` → `this.eventBus.emit()`
- Line 269: `this.emit()` → `this.eventBus.emit()`
- Line 291: `this.emit()` → `this.eventBus.emit()`

### 2. Gallery.js - iziModal jQuery wrapper issues
**Error:** `Uncaught (in promise) TypeError: this.modal.iziModal is not a function`

**Root Cause:** Multiple issues:
1. Modal element was a plain DOM element but iziModal calls weren't wrapped properly
2. Using `document.querySelector()` instead of BaseComponent's `$()` method
3. Incorrect library detection (checking for `window.jQuery.fn.iziModal` instead of `window.iziModal`)

**Changes Made:**
- Line 85: Changed from `document.querySelector()` to `this.$()` for modal element
- Line 186-187: Changed library check from `window.jQuery.fn.iziModal` to `window.iziModal`
- Line 198: Changed from `window.jQuery(this.modal).iziModal()` to `this.modal.iziModal()`
- Line 234: Changed from `document.querySelector()` to `this.$()` for swiper container
- Line 230-231: Changed Swiper library check to use dynamic loading
- Line 387: Changed from `document.querySelector()` to `this.$()` for modal content
- Line 440: Changed from `window.jQuery(this.modal).iziModal()` to `this.modal.iziModal()`
- Line 453: Changed from `window.jQuery(this.modal).iziModal()` to `this.modal.iziModal()`
- Line 472: Changed from `document.querySelector()` to `this.$()` for swiper container
- Line 496: Changed from `document.querySelector()` to `this.$()` for length display
- Line 579-580: Simplified modal destroy check to use `this.modal.iziModal`

**Why this works:** The BaseComponent's `$()` method (line 134-137 in BaseComponent.js) returns a single element when only one match is found, making it compatible with both jQuery and plain DOM operations.

## Files Modified

1. `/assets/js/core/App.js`
2. `/assets/js/components/ui/Gallery.js`

## Distribution Build

New distribution created at: `./dist/UfoBufo-secondDecade/`
Build time: ~644 ms
Bundle size: 1010 KB (app.js)

## Testing Notes

### Gallery Modal Background Issue
The white background issue mentioned should now be resolved. The modal is now initialized using the same method as the working backup, which properly handles the modal overlay styling.

### Parallax Behavior
The parallax code is identical to the working backup. The behavior depends on:
- CSS styling for `.topparalax_layer` classes
- Data modifiers on HTML elements (50, 5, 3)
- Formula: `scrollProgress * config.modifier * 10`

The layers should move at different speeds based on their modifiers, creating depth effect.

## Verification Checklist

- [x] App.js EventBus emit calls fixed
- [x] Gallery.js iziModal initialization fixed
- [x] Gallery.js using BaseComponent's $() method
- [x] Distribution build successful
- [x] No compilation errors
- [x] All vendor libraries included

### 3. Parallax.js - CSS variable transform issue
**Error:** Parallax layers not positioned correctly, all layers moving together

**Root Cause:** The CSS uses `transform: translateY(var(--translateY)) translateX(-50%)` to both animate the parallax AND center the layers horizontally. The JavaScript was directly setting `element.style.transform` which overwrote the entire transform, removing the `translateX(-50%)` centering.

**Changes Made:**
- Line 299-303: Changed `applyTransform()` to use `element.style.setProperty('--translateY', ...)` instead of directly setting transform
- This preserves the CSS-defined `translateX(-50%)` while animating the Y position via CSS variable

### 4. Gallery.js - Dynamic library loading errors
**Error:** `GET .../iziModal.min.js net::ERR_ABORTED 404`

**Root Cause:** Gallery was trying to dynamically load iziModal and Swiper from wrong path. These libraries are already loaded by PHP (webpack-assets.php) in `js/libs/` folder.

**Changes Made:**
- Line 186-190: Changed to check for `window.jQuery.fn.iziModal` instead of trying to load script
- Line 202: Use `window.jQuery(this.modal).iziModal()` for proper jQuery plugin usage
- Line 235-237: Changed to check for `window.Swiper` without dynamic loading
- Line 446: Use `window.jQuery(this.modal).iziModal('open', ...)`
- Line 459: Use `window.jQuery(this.modal).iziModal('close')`
- Line 585-586: Use `window.jQuery(this.modal).iziModal('destroy')`

### 5. location.php - Template structure issue
**Issue:** User had to manually restore from backup

**Problem:** The file had broken structure:
- `get_footer()` was called too early (line 17)
- Area plan section was outputting after footer
- Missing/incorrect comment blocks

## Files Modified

1. `/assets/js/core/App.js` - EventBus emit fixes
2. `/assets/js/components/ui/Gallery.js` - iziModal jQuery wrapper and library loading fixes
3. `/assets/js/components/animation/Parallax.js` - CSS variable transform fix
4. `/location.php` - Restored from backup (manual fix)

## Distribution Build

New distribution created at: `./dist/UfoBufo-secondDecade/`
Build time: ~628 ms
Bundle size: 1010 KB (app.js)

## Testing Notes

### Gallery Modal Background Issue
The white background issue should be resolved. The modal now uses jQuery wrapper properly and relies on PHP-enqueued libraries.

### Parallax Behavior - FIXED ✅
The parallax now correctly:
- Uses CSS variable `--translateY` for animation
- Preserves the `translateX(-50%)` centering from CSS
- Each layer moves at different speed based on data-modifier (50, 5, 3)
- Formula: `scrollProgress * config.modifier * 10` sets the CSS variable

## Verification Checklist

- [x] App.js EventBus emit calls fixed
- [x] Gallery.js iziModal initialization fixed
- [x] Gallery.js using BaseComponent's $() method
- [x] Gallery.js not trying to dynamically load libraries
- [x] Parallax.js using CSS variables for transform
- [x] Parallax layers correctly positioned and centered
- [x] Distribution build successful
- [x] No compilation errors
- [x] All vendor libraries included
- [x] location.php restored from backup

## Next Steps

1. ✅ Test parallax scrolling - layers should move at different speeds and stay centered
2. Test the gallery modal functionality (opening, closing, navigation)
3. Verify modal background is no longer white
4. Check mobile responsiveness
5. Verify fractal/lens animations work correctly
